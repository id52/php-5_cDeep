		
		
		
		
		
		{literal}
    <script>
    function addmsg(type, msg){
        $("#messages").html(
			msg
        );
    }

    function waitForMsg(){

        $.ajax({
            type: "GET",
            url: "/catalog/cart/cartserver",

            async: true, 
            cache: false,
            timeout:50000,

            success: function(data){ 
                addmsg("new", data); 
                setTimeout(
                    'waitForMsg()', 
                    1000 
                );
            },
			

        });
    };

    $(document).ready(function(){
        waitForMsg(); /* Start the inital request */
    });
    </script>
{/literal}
		
    <!--div id="messages">
    </div-->


