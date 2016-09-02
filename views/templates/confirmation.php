<div class="container-fluid">
    <br>
	<ul>
	<?php			        


		$total = 0;
    	foreach ($_SESSION['cart'] as $cart_entry){
    		$ordered_item = explode(",", $cart_entry);
    		// ordered item become an array in the format of (item name, item option (NULL if null), price)
    		echo "<li>$ordered_item[0] ($ordered_item[1]).....".'$'."$ordered_item[2]</li>";
    		$total = $total + $ordered_item[2];

    	}
    	echo '<li><h4>Your total is $'."$total</h4></li>";
    ?>
    	<br>
	</ul>

    <?php
        echo "Name: $name <br>";
        echo "Phone: $phone <br>";
    ?>

    <h4 class="text-success">Thank you for choosing BlossomTea. Your order has been received.</h4>

</div>
