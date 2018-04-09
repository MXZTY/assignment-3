$(function(){
   
   // create a variable for print services    
        var url = `print-services.php`;
        
        //perform ajax request on the url with the provided data
        $.get(url).done(function(data){
            $('.itemRow').each(function(index, item){
               let key = index +1;
                $('#size' + key).html("<b>Size: </b>" + data.sizes[$('#size' + key).attr('value')].name);
                $('#paper' + key).html("<b>Paper: </b>" + data.stock[$('#paper' + key).attr('value')].name);
                $('#frame' + key).html("<b>Frame: </b>" + data.frame[$('#frame' + key).attr('value')].name);
                $('#shipping').html('<b>Shipping Method: </b>' + data.shipping[$('#shipping').attr('value')].name);
                
            });

            
        }).fail(function(xhr, status, error){
            
            alert(`Failed loading data! Status = ` + status + ` Error =` + error);
        
        }).always(function(data){});

});