<div class="container-fluid">
	<div class="row">
		<ul class="nav nav-pills nav-stacked  tabbable tabs-left col-sm-3">	
			<?php foreach ($dom->category as $category) {
				$category_name = $category->name;
				print "<h3>$category_name</h3>";
				foreach ($category->sub_category as $sub_category) {
					$sub_category_name = $sub_category->name;
					$n = $sub_category['sub_id'];
					if ($n == $active){
					echo "<li class=\"active\"><a href=\"#$n\" data-toggle=\"tab\">$sub_category_name</a></li>";
					}
					else
					echo "<li><a href=\"#$n\" data-toggle=\"tab\">$sub_category_name</a></li>";
					unset($n);
				}
				unset($sub_category);
			}
			unset($category);
			?>
		</ul>
		<div class="col-sm-9 tab-content">
			<style type="text/css">
				table {
				    font-family: arial, sans-serif;
				    border-collapse: collapse;
				    width: 100%}
				td, th {
				    border: 1px solid #dddddd;
				    text-align: left;
				    padding: 8px}
				tr:nth-child(even) {
				    background-color: #dddddd}
			</style>

		<?php foreach ($dom->category as $category) {
			foreach ($category->sub_category as $sub_category) {
				$sub_category_name = $sub_category->name;
				$n = $sub_category['sub_id'];
				if ($n == $active)
				echo "<div class=\"tab-pane fade in active\" id=\"$n\"><h3>$sub_category_name</h3>";
				else
				echo "<div class=\"tab-pane fade\" id=\"$n\"><h3>$sub_category_name</h3>";
				echo "<table>";				
					foreach ($sub_category->item as $item) {
						$item_name = $item->name;
						$item_price = $item->price;
						$item_id = $item['item_id'];
						echo "<tr><td><h4>$item_name</h4>".'$'."$item_price<br>";
						// Here is the way to handle nodes that might or might not exist.
						if (!empty($item->description)){
							$description=$item->description;
							echo "$description</td>";
						}
						if (!empty($sub_category->option_category)){
							echo "<form onsubmit=\"add_to_cart($item_id); return false;\">";
							echo "<td><div class=\"dropdown\">";
							echo "<button class=\"btn btn-info dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Add to Cart</button>";
							echo "<ul id =\"$item_id\" item_name=\"$item_name\" item_price =\"$item_price\" class=\"dropdown-menu\">";

							/*
							foreach ($sub_category->option as $sub_category_option) {
								echo "<form action=\"index.php\" method=post>";
								echo "<li><button class=\"btn btn-info\" name=\"order\" value=\"$item_name,$sub_category_option,$item_price,$n\" type=\"submit\">$sub_category_option</button></li>";
								echo "</form>";
							}
							*/


							foreach ($sub_category->option_category as $sub_category_option_category)
							{
								$input_type = $sub_category_option_category['input_type'];
								foreach ($sub_category_option_category->option as $sub_category_option)
								{
									echo "<li><input type=\"$input_type\" name=\"$sub_category_option\">$sub_category_option</input></li>";						
								}
								echo "<li class=\"divider\"></li>";

							}
							echo "<li><button class=\"btn btn-info\" type=\"submit\">Add to your cart</button></li>";

							echo "</form>";
							echo "</ul></div></td>";
						}
						else{
							echo "<form onsubmit=\"add_to_cart($item_id); return false;\">";
							echo "<td><button id =\"$item_id\" item_name=\"$item_name\" item_price =\"$item_price\"class=\"btn btn-info\" type=\"submit\">Add to Cart</button></td>";
							echo "</form>";
						}
						echo "</tr>";
					}
				echo "</table>";
				echo "</div>";
				unset($n);
				unset($item);
			}
			unset($sub_category);
		}
		unset($category);
		?>
	</div>
</div>
<?php /*
      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li><a href="#a" data-toggle="tab">One</a></li>
          <li class="active"><a href="#b" data-toggle="tab">Two</a></li>
          <li><a href="#c" data-toggle="tab">Twee</a></li>
        </ul>
        <div class="tab-content">
         <div class="tab-pane active" id="a">Lorem ipsum dolor sit amet, charetra varius quam sit amet vulputate. 
         Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero.</div>
         <div class="tab-pane" id="b">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
         Aliquam in felis sit amet augue.</div>
         <div class="tab-pane" id="c">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
         Quisque mauris augue, molestie tincidunt condimentum vitae. </div>
        </div>
      </div>
      */
?>