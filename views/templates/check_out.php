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
    <form action="index.php" method="post">
		<table>
    		<tr>
    	<td>Name: </td><td><input type="text" name="name"></td></tr>

		<td>Phone Number: </td><td><input type="text" name="phone_number"></td>
			</tr>
		</table><br>
		<button class="btn btn-primary dropdown-toggle" type="submit" style="position:relative;left:300px;", >Submit your order</button>
	</form>
</div>
