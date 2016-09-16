<body onload="autoUpdateInit()">

<script>
    function autoUpdateInit(){

        setInterval(function() {requestOrderUpdate()}, 5000);
    }
    function requestOrderUpdate()
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
        var timeStamp = document.getElementById("submitted_order").getAttribute("timeStamp");
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
                    // evaluate the submitted_order_list in JSON
                    var submitted_order_list = JSON.parse(xhr.responseText);
                    var submitted_orders = submitted_order_list.submitted_orders;

                    for (i = 0; i<submitted_orders.length; i++ ){
                        var timeStamp = submitted_orders[i].time_stamp;
                        var customer_name = submitted_orders[i].name;
                        var customer_number = submitted_orders[i].phone_number;

                        var table = document.createElement("table");
                        var row = table.insertRow(0);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);                       
                        cell1.innerHTML = "<b>" + customer_name +"</b>";
                        cell2.innerHTML = "<b>" + customer_number +"</b>";
                        document.getElementById("submitted_order").setAttribute("timeStamp", timeStamp)
                        // parse the submitted_order_list

                        var total_price = 0; 
                        var ordered_items = submitted_orders[i].ordered_items;                
                        for (var j = 0; j < ordered_items.length; j++) {
                            var item_name=ordered_items[j].item_name;
                            var item_price=ordered_items[j].item_price;
                            var item_options=ordered_items[j].item_options;
                            var row = table.insertRow(j+1);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            cell1.innerHTML = item_name;
                            cell2.innerHTML = item_options;
                            cell3.innerHTML = "$" + item_price;
                            total_price += Number(item_price);
                        }
                        var footer = table.createTFoot();
                        var row = footer.insertRow(0);
                        var cell = row.insertCell(0);
                        cell.innerHTML = "<b>The total is $" + total_price.toFixed(2) + "</b>";
                        document.getElementById("submitted_order").appendChild(table);
                    }
;
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

<div class="container-fluid" >
    <div id="submitted_order" timeStamp="0"></div>
    <button onclick="requestOrderUpdate()">please work...</button>
</div>
