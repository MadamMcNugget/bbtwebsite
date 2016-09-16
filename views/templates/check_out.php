<body onload="retrieveCart()">

<script>
    function retrieveCart()
    {
        try
        {
            xhr = new XMLHttpRequest();
        }
        catch (e)
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        // handle old browsers
        if (xhr == null)
        {
            alert("Ajax not supported by your browser!");
            return;
        }

        // construct URL
        var url = "ajax/cart.php?task=get";

        // get quote
        xhr.onreadystatechange =
        function()
        {
            // only handle loaded requests
            if (xhr.readyState == 4)
            {
                if (xhr.status == 200)
                {
                    // evaluate the cart in JSON
                    var cart = eval("("+ xhr.responseText + ")");

                    // insert cart items into cart
                    var text = "";
                    var total_price = 0;
                    
                    for ( i=0 ; i<cart.length ; i++)
                    {
                        text += "<li>" + cart[i].item_name + ": $" + cart[i].item_price;
                        text += "<ul><li>" + cart[i].item_options + "</li></ul>";
                        total_price += Number(cart[i].item_price);
                    }
                    text += '<br><br>';
                    text += '<li><h3>Your total is: $' + total_price.toFixed(2) + '</h3></li>'; 

                    document.getElementById("cart_items").innerHTML = text;
                }
                else
                    alert("Error with Ajax call!");
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
    }

    function validate_form()
    {
        var order_name = document.forms["order_form"]["name"].value;
        var order_phone = document.forms["order_form"]["phone_number"].value;
        var isValid = true;

        if (order_name == null || order_name == "") {
            document.getElementById("name_input").innerHTML = "Name must be filled out.";
            isValid = false;
        } else 
            document.getElementById("name_input").innerHTML = "";
        
        if (order_phone == null || order_phone == "") {
            document.getElementById("phone_input").innerHTML = "Phone number must be filled out.";
            isValid = false;
        } else if (order_phone.length < 7) {
            document.getElementById("phone_input").innerHTML = "Phone number must be valid.";
            isValid = false;
        } else 
            document.getElementById("phone_input").innerHTML = "";

        if (isValid)
            submit_order();
        else
            return isValid;
    }
</script>

<div class="container-fluid">
    <br>
	<ul id="cart_items">

	</ul>
    <form name="order_form" onsubmit="validate_form(); return false;">
		<table>
    		<tr>
            	<td>Name: </td><td><input type="text" id="name"></td>
                <td><span id="name_input" class="bg-danger text-danger"></span></td>
            </tr>
            <tr>
        		<td>Phone Number: </td><td><input type="text" id="phone_number"></td>
                <td><span id="phone_input" class="bg-danger text-danger"></span></td>
			</tr>
		</table><br>
        <span class="bg-success text-success" id="confirmation"></span><br>
        <!-- This button does not go anywhere yet -->
		<input id="order_form_buttom" type="submit" class="btn btn-info" style="position:relative;left:300px;" value="Confirm and Send Order">
	</form>
</div>
