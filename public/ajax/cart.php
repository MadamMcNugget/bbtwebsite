<?php
    session_start();
    // defines a order_item
    class Item        
    {
            public $item_name;
            public $item_price;
            public $item_options;
    }
    class Submitted_Order
    {
        public $name;
        Public $phone_number;
        public $ordered_items = array();
        public $time_stamp;
    }
    class Submitted_Order_List
    {
        public $submitted_orders = array();
    }
    $submitted_order_list = new Submitted_Order_List();

switch ($_GET['task']) {
    // adding items to the shopping cart
    case 'add':

        // set MIME type
        header("Content-type: application/json");
        $ordered_item = new Item();
        $ordered_item->item_name=$_GET['item_name'];
        $ordered_item->item_price=$_GET['item_price'];
        $ordered_item->item_options=$_GET['item_options'];
        if(!isset($_SESSION['shopping_cart'])){
            $_SESSION['shopping_cart']= array();
        }

        $_SESSION['shopping_cart'][] = $ordered_item;

        // output JSON
        $response = json_encode($_SESSION['shopping_cart']);
        print $response;
        break;


    // remove items from the shopping cart
    case 'remove':
        $index = $_GET['index'];
        array_splice($_SESSION['shopping_cart'], $index, 1);

        // output JSON
        $response = json_encode($_SESSION['shopping_cart']); 
        print $response;
        break;

    // retrieve shopping cart to checkout page
    case 'get':
        $response = json_encode($_SESSION['shopping_cart']);
        print $response;
        break;

    // submitting order to the store page
    case 'submit':

        // set MIME type
        header("Content-type: application/json");

        if (!isset($submitted_order))
            $submitted_order = new Submitted_Order();

        $submitted_order->name = $_GET['customer_name'];
        $submitted_order->phone_number = $_GET['customer_number'];
        $submitted_order->ordered_items = $_SESSION['shopping_cart'];
        $submitted_order->time_stamp = time();

        // load from file
        if (!file_exists("submitted_order_list.txt"))
            file_put_contents("submitted_order_list.txt", "");

        $file_contents = file_get_contents("submitted_order_list.txt");

        if ($file_contents == "")
            $submitted_order_list = new Submitted_Order_List();
        else
            $submitted_order_list = json_decode($file_contents);

        $submitted_order_list->submitted_orders[] = $submitted_order;
        file_put_contents("submitted_order_list.txt", json_encode($submitted_order_list));

        echo "Your order has been received. Thank you.";
        break;
        


    // store page checking to see if there are new orders
    case 'update':
    // load and decode 
        if (!file_exists("submitted_order_list.txt")){
            Header("HTTP/1.1 304 Not Modified");
            break;
        }

        $file_contents = file_get_contents("submitted_order_list.txt");
        if ($file_contents == ""){
            Header("HTTP/1.1 304 Not Modified");
            break;
        }
        else
            $submitted_order_list = json_decode($file_contents);

        if (empty($submitted_order_list->submitted_orders)){
           Header("HTTP/1.1 304 Not Modified");
        }
        else{
            $last_order_sent = $_GET['timeStamp'];
            $outdated_order = NULL;
            for ( $i =0, $size = count($submitted_order_list->submitted_orders); $i<$size; ++$i) {
                if ($submitted_order_list->submitted_orders[$i]->time_stamp <= $last_order_sent){
                    $outdated_order= $i;
                }
                else{
                    break;
                }
            }
            if (is_numeric($outdated_order)){
                array_splice($submitted_order_list->submitted_orders, 0, $outdated_order+1);
            }
            if (empty($submitted_order_list->submitted_orders)){
            }
//                Header("HTTP/1.1 304 Not Modified");
            
            $response = json_encode($submitted_order_list);
            file_put_contents("submitted_order_list.txt", $response);
            print($response);

        }
        break;
}

?>