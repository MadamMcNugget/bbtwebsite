<body onload="autoUpdateInit()">

<script>
    function autoUpdateInit(){
        var timeStamp = 0;

        setInterval(requestOrderUpdate(timeStamp), 5000);
    }
    function requestOrderUpdate(timeStamp)
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
        var url = "ajax/cart.php?task=update&timeStamp=" + timeStamp;

        // get quote
        xhr.onreadystatechange =
        function()
        {
            // only handle loaded requests
            if (xhr.readyState == 4)
            {
                if (xhr.status == 200)
                {
                    /*
                    // evaluate the submitted_order_list in JSON
                    var submitted_order_list = eval("("+ xhr.responseText + ")");

                    // parse the submitted_order_list
                    var text = "";
                    var total_price = 0;                    
                    for (i = 0; i < submitted_order_list.length; i++) {
                        
                    };

                    
                    for ( i=0 ; i<cart.length ; i++)
                    {
                        text += "<li>" + cart[i].item_name + ": $" + cart[i].item_price;
                        text += "<ul><li>" + cart[i].item_options + "</li></ul>";
                        total_price += Number(cart[i].item_price);
                    }
                    text += '<br><br>';
                    text += '<li><h3>Your total is: $' + total_price.toFixed(2) + '</h3></li>'; 

                    document.getElementById("cart_items").innerHTML = text;
                    */
                    document.getElementById("response").innerHTML = xhr.responseText;
                }
                else if (xhr.status == 304){}

                else
                    alert("Error with Ajax call!");
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
    }
</script>

<div class="container-fluid">
    <span id="response"></span>
    <button onclick="requestOrderUpdate(0)">please work...</button>
</div>
