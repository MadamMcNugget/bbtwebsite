<script>

    // an XMLHttpRequest
    var xhr = null;

    /*
     * void
     * quote()
     *
     * Gets a quote.
     */
    function add_to_cart(item_id)
    {
        // instantiate XMLHttpRequest object
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

        // get ordered_item
        var item = document.getElementById(item_id);
        // parce the name and price
        var item_name = item.getAttribute("item_name");
        var item_price = item.getAttribute("item_price");

    	// get the options
        var item_options = item.getAttribute("item_options");
        if (item_options == "nooptions")
        {
            item_options = "no options";
        }
        else
        {
            item_options = "";
            for ( i=0 ; i<item.children.length ; i++) 
            {
                if (item.children[i].children[0] != null){
                    if (item.children[i].children[0].checked){
                        if (item_options == ""){
                            item_options = item.children[i].children[0].getAttribute("value");
                        }
                        else
                        {
                            item_options += ", " + item.children[i].children[0].getAttribute("value");
                        }
                    }
                }
            }
        }

        // construct URL
        var url = "ajax/cart.php?task=add&item_name=" + item_name + "&item_price=" + item_price + "&item_options=" + item_options;

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
                        text += '<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove" cart_item_index='+ i + ' onclick = "remove_from_cart(' + i + ')"></span></button></li>';
                        text += "<ul><li>" + cart[i].item_options + "</li></ul>";
                        total_price += Number(cart[i].item_price);
                    }
                    text += '<li class="divider"></li>';
                    text += '<li><h3>Your total is: $' + total_price.toFixed(2) + '</h3></li>'; 

                    text += "<a href=\"?page=check_out\" class=\"btn btn-info\" type=\"button\" style=\"position:relative;left:300px;\" >Proceed to checkout</a>";


                    document.getElementById("cart").innerHTML = text;
                    // update cart_count
                    document.getElementById("cart_count").innerHTML = cart.length;
                }
                else
                    alert("Error with Ajax call!");
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
    }

    function remove_from_cart(cart_item_index)
    {
        // instantiate XMLHttpRequest object
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
        var url = 'ajax/cart.php?task=remove&index=' + cart_item_index;

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
                        text += '<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove" cart_item_index='+ i + ' onclick = "remove_from_cart(' + i + ')"></span></button></li>';
                        text += "<ul><li>" + cart[i].item_options + "</li></ul>";
                        total_price += Number(cart[i].item_price);
                    }
                    text += '<li class="divider"></li>';
                    text += '<li><h3>Your total is: $' + total_price.toFixed(2) + '</h3></li>'; 

                    text += "<a href=\"?page=check_out\" class=\"btn btn-info\" type=\"button\" style=\"position:relative;left:300px;\" >Proceed to checkout</a>";


                    document.getElementById("cart").innerHTML = text;
                    // update cart_count
                    document.getElementById("cart_count").innerHTML = cart.length;
                }
                else
                    alert("Error with Ajax call!");
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
    }

    function submit_order()
    {
        // instantiate XMLHttpRequest object
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


        var customer_name = document.getElementById("name").value;
        var customer_number = document.getElementById("phone_number").value;

        // construct URL
        var url = 'ajax/cart.php?task=submit&customer_name=' + customer_name + '&customer_number=' + customer_number;

        // get quote
        xhr.onreadystatechange =
        function()
        {
            // only handle loaded requests
            if (xhr.readyState == 4)
            {
                if (xhr.status == 200)
                {
                    document.getElementById("confirmation").innerHTML = xhr.responseText;
                    document.getElementById("order_form_buttom").style.display = 'none';
                }
                else
                    alert("Error with Ajax call!");
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
    }
</script>