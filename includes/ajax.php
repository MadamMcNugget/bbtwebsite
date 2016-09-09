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
 /*   	var options = "";

    	if (item.children[i].checked){
    		if (options == ""){
    			options = item.children[i].innerHTML;
    		}
    		else
    		{
    			options = options + "," + item.children[i].innerHTML;
    			}
    		}
*/

        // construct URL
        var url = "ajax/cart.php?item_name=" + item_name + "&item_price=" + item_price;// + "&options=" + options;

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

                    // insert cart items into DOM?
                    var text = "";
                    
                    for ( i=0 ; i<cart.length ; i++)
                    {
                        text += "<li>" + cart[i].item_name + ": " + cart[i].item_price + "</li>";
                    }


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

</script>