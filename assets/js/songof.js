    $(function()
    {
        setTimeout("displaytime()",1000);
    })
    function displaytime()
    {
        var dt = new Date();
        $('#time').html(dt.toLocaleTimeString('en-GB'));
        setTimeout("displaytime()",1000);       
    }
    $( function() {
        $( "#datepicker1" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
          
        });
      });
    
    
   

  