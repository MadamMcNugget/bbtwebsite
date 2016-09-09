	<title><?php echo htmlspecialchars($title) ?></title>
	<h1><?php echo htmlspecialchars($title)?> </h1>
	<?php // header starts here ?>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#"><img style="max-height:50px;" src="images/logo.png"></a>
	      
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	    	<style type="text/css">
			    .badge-notify{
			       background:red;
			       position:relative;
			       top: -25px;
			       left: -10px;
			       font-size: 10px;
			    }
 		   </style>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#"><h4>HOME</h4></a></li>
	        <li><a href="?page=menu"><h4>MENU</h4></a></li>
	        <li><a href="#contact"><h4>CONTACT</h4></a></li>
	        <li><div class="dropdown">
	         <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
		        <span class="glyphicon glyphicon-shopping-cart" style="font-size:35px"></span>
		        <span id="cart_count" class="badge badge-notify">0</span></button>
			<ul id="cart" class="dropdown-menu" style= "width:500px;">
	        	<?php if ($cart != 0){			        


	        		$total = 0;
		        	foreach ($_SESSION['cart'] as $cart_entry){
		        		$ordered_item = explode(",", $cart_entry);
		        		// ordered item become an array in the format of (item name, item option (NULL if null), price)
		        		echo "<li>$ordered_item[0] ($ordered_item[1]).....".'$'."$ordered_item[2]</li>";
		        		$total = $total + $ordered_item[2];

		        	}
		        	echo "<li class=\"divider\"></li>";
		        	echo "<li><h4>Your total is ".'$'."$total</h4></li>";
					echo "<a href=\"?page=check_out\"class=\"btn btn-primary dropdown-toggle\" type=\"button\" style=\"position:relative;left:300px;\", >Proceed to checkout</a>";
	        	}
	        	else{
	        		echo "There is nothing in your cart yet";
	        	}
	        	?>
	        	</ul></div></li>
	        	

	      </ul>
	    </div>
	  </div>
	</nav>
