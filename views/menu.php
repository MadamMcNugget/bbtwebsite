<div class="container-fluid">
	<div class="row">
		<ul class="nav nav-pills nav-stacked  tabbable tabs-left col-sm-3">	
			<?php foreach ($dom->catagory as $catagory) {
				$catagory_name = $catagory->name;
				print "<h3>$catagory_name</h3>";
				foreach ($catagory->sub_catagory as $sub_catagory) {
					$sub_catagory_name = $sub_catagory->name;
					$n = $sub_catagory['sub_id'];
					if ($n == $active){
					echo "<li class=\"active\"><a href=\"#$n\" data-toggle=\"tab\">$sub_catagory_name</a></li>";
					}
					else
					echo "<li><a href=\"#$n\" data-toggle=\"tab\">$sub_catagory_name</a></li>";
					unset($n);
				}
				unset($sub_catagory);
			}
			unset($catagory);
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

		<?php foreach ($dom->catagory as $catagory) {
			foreach ($catagory->sub_catagory as $sub_catagory) {
				$sub_catagory_name = $sub_catagory->name;
				$n = $sub_catagory['sub_id'];
				if ($n == $active)
				echo "<div class=\"tab-pane fade in active\" id=\"$n\"><h3>$sub_catagory_name</h3>";
				else
				echo "<div class=\"tab-pane fade\" id=\"$n\"><h3>$sub_catagory_name</h3>";
				echo "<table>";				
					foreach ($sub_catagory->item as $item) {
						$item_name = $item->name;
						$item_price = $item->price;
						$item_id = $item['item_id'];
						echo "<tr><td><h4>$item_name</h3>".'$'."$item_price<br>";
						// Here is the way to handle nodes that might or might not exist.
						if (!empty($item->descirption)){
							$descirption=$item->descirption;
							echo "$descirption</td>";
						}
						if (!empty($sub_catagory->option)){
							echo "<td><div class=\"dropdown\">";
							echo "<button class=\"btn btn-info dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Add to Cart</button>";
							echo "<ul class=\"dropdown-menu\">";
							foreach ($sub_catagory->option as $sub_catagory_option) {
								echo "<form action=\"index.php\" method=post>";
								echo "<li><button class=\"btn btn-info\" name=\"order\" value=\"$item_name,$sub_catagory_option,$item_price,$n\" type=\"submit\">$sub_catagory_option</button></li>";
								echo "</form>";
							}
							echo "</ul></div></td>";

						}
						else{
							echo "<form action=\"index.php\" method=post>";
							echo "<td><button class=\"btn btn-info\" name=\"order\" value=\"$item_name,NULL,$item_price,$n\" type=\"submit\">Add to Cart</button></td>";
							echo "</form>";
						}
						echo "</tr>";
					}
				echo "</table>";
				echo "</div>";
				unset($n);
				unset($item);
			}
			unset($sub_catagory);
		}
		unset($catagory);
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