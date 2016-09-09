<?
    session_start();
    // defines a stock
    class order
    {
        public $item_name;
        public $item_price;
//        public $options;
    }

    // set MIME type
    header("Content-type: application/json");
    $ordered_item = new order();
    $ordered_item->item_name=$_GET['item_name'];
    $ordered_item->item_price=$_GET['item_price'];
//    $ordered_item->options=$_GET['options'];
    if(!isset($_SESSION['shopping_cart'])){
        $_SESSION['shopping_cart']= array();
    }

    $_SESSION['shopping_cart'][] = $ordered_item;

    // output JSON
    $response = json_encode($_SESSION['shopping_cart']);
    print $response;
?>