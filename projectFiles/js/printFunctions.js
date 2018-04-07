$(function(){
        
        //check to see if the images panel contains any favorites. 
        if($(`#favoriteImagesPanel`).children().length > 0 ){
            
            // if panel contains a favorited image, set the toggle and target for the printing button and make it visible. 
            $(`#print-button`).attr({'data-toggle': `modal`,'data-target':`#printModal`});
            $(`#print-button`).toggleClass(`visible`);
            
        } else {
            
            //if the panel is empty, hide the print button and append a message with the option to browse images. 
            $(`#print-button`).toggleClass('invisible');
            var noImages = $(`<p class='center-text gold'>No favorite images saved!</br><a href='browse-images.php' class='btn btn-warning'>Start Browsing</a></p>`);
            $(`#favoriteImagesPanel`).append(noImages);
            
        }
        
        //if the Posts Panel is empty, append a message with the option to browse images. 
        if($(`#favoritePostsPanel`).children().length == 0 ){
            var noPosts = $(`<p class='center-text gold'>No favorite posts saved!</br><a href='browse-posts.php' class='btn btn-warning'>Start Browsing</a></p>`);
            $(`#favoritePostsPanel`).append(noPosts);
        }

        // create a variable for print services    
        var url = `print-services.php`;
        
        //perform ajax request on the url with the provided data
        $.get(url).done(function(data){
            
            //Create an option for each of the json array items returned. 
            $('.size').each( function(index, item) {
               makeOption(data.sizes, $(this));
            });
           
            $('.paper').each(function(index, item) {
               makeOption(data.stock, $(this));
            });
            
            $('.frame').each( function(index, item) {
               makeOption(data.frame, $(this));
            });
           
            $('.total').each( function(index, item){
               var key = index + 1;
               let totalCost = calculateRowTotal(key, data);
               $(this).text("$"+totalCost);
            });
           
           //fill the options with the returned shipping options
           $('#standard').text(data.shipping[0].name);
           $('#shipcost').text('$'+data.shipping[0].rules.none);
           $('#secondary').text(data.shipping[1].name);

            // Call the calculateTotal function to generate base total. 
           calulateTotal();
           
           // Add an event listener to refresh the row total as well as the total cost whenever a form value is changed. 
           $('#order-form').on('change', function(e){
               
               //if its select element or number input, retrieve the rows key, and add recalculate the row total.  
               if(e.target.tagName.toUpperCase() == "SELECT" || e.target.getAttribute('type').toUpperCase() == 'NUMBER') {
                   let key = e.target.getAttribute('name').replace(e.target.className, '');
                   let total = document.querySelector('#total'+key);
                   let totalCost = calculateRowTotal(key, data);
                   $(total).text("$"+ totalCost);
               } 
               
               // recalculate the total order amount
               calulateTotal();
               
               // save the selected shipping method into shippingID and update shipping method. 
               let shippingID = $('input[name=shipping]:checked').val();
               updateShipping(data.shipping[shippingID], data.freeThresholds[shippingID]);
           });
           
           // On failure when requesting data from print-services.php display the status and the error. 
        }).fail(function(xhr, status, error){
            
            alert(`Failed loading data! Status = ` + status + ` Error =` + error);
        
        }).always(function(data){});
        
        
        /*
            Function for creating the options for an associated select element. 
            @PARAMS: list of options to be created, and their parent select element to append them to. 
        */
        function makeOption(info, a) {
            
            // loop through the info object containing the options requiring creation.
            for(let i = 0; i < info.length; i++) {
                
                // create the option element and set its name attribute, and html to the name of the array item. 
                let item = $(`<option></option>`).attr('name', info[i].name).html(info[i].name);
                
                //set the value of the option to the array items associated id value
                item.attr('value', info[i].id);
                
                // add the created option to the select element passed in. 
                a.append(item);
            }
        }
        
        
        
        /*
            Function for calculating the row total based on the values selected by the user. 
            @PARAMS: in the key for the associated row, and the data contained within it. 
            @RETURN: the calculated price based on the selected options. 
        */
        function calculateRowTotal(key, data) {
            
            // get the value attributes for each of the row items.
            let sizeID = $( '#size' + key + ' option:selected').val();
            let paperID = $('#paper' + key + ' option:selected').val();
            let frameID = $('#frame' + key + ' option:selected').val();
            let quant = $('#quantity'+key).val();
            
            // if quantity is blank or is undefined, force a 0 value for it. 
            if(quant === '' || quant === undefined) {
                quant = 0;
            }
            
            //set the paper cost based on the selected value.
            let paperCost = data.stock[paperID].large_cost;
            if(sizeID < 2){
                paperCost = data.stock[paperID].small_cost;
            } 
            
            // return the new calculated price of the row passed in.
            return calculatePrice(data.sizes[sizeID].cost, paperCost, data.frame[frameID].costs[sizeID], quant);        
            
        }
        
        
        
        /*
            Function for calculating the sub total for the order
            After calculating the sub total this function will call the setGrandTotal function.
        */
        function calulateTotal(){
            
            //Retrieve all of the elements with the class total. 
            let totals = $('.total');
            let sum = 0;
            
            // loop through each total, strip the $ from its value, and add it to the sum. 
            for(let i = 0; i < totals.length; i++){
                let cost = totals[i].textContent.split('$')[1];
                if(cost === '' || cost === undefined) {
                    cost = 0;
                }
                sum += Number(cost);
            }
            
            //set the text of the sub total to the new calculated sub total. 
            $('#subtotal').text('$'+sum);
            
            // recalculate the grand total. 
            setGrandTotal(sum);
        }
        
        
        
        /*
            Function for calculating the price. 
            @PARAMS: size, paper, frame option values, and the quantity specified by the user. 
            @RETURN: row items price based on the quantity specified by the user. 
        */
        function calculatePrice(size, paper, frame, quantity){
            
            // add the items costs' up and multiply the result by the quantity then return it. 
            let itemPrice = size + paper + frame;
            return itemPrice * quantity;
        }
        
        
        
        /* 
            Function for setting the new grand total price
            @PARAMS: the subtotal of all the rows costs. 
        */
        function setGrandTotal(subTotal) {
            
            // cast the passed in subTotal, and the shipping cost to numbers and add them together.  
            let grandTotal = Number(subTotal) + Number($('#shipcost').text().split('$')[1]);
            
            // set the grand total to the new total and prepend the $ sign to it. 
            $('#grandtotal').text('$' + grandTotal);
        }
        
        
        
        /*
            Function for updating the shipping cost
            @PARAMS: the shipping object, and the object holding the rules associated with free shipping
        */
        function updateShipping(shipping, free) {
            
            // retrieve the subtotal text and strip the $ sign from it. 
            let subTotal = $('#subtotal').text().split('$')[1];
            let shippingCost = 0;
            
            // call the getFrames function to retrieve the frames value. 
            let frames = getFrames();
            
            // if the free amount specified is less than the subtotal, set the shipping cost to 0. 
            if(Number(free.amount) <= Number(subTotal)) {
                shippingCost = 0;
            
            // if the frames value returned is 0, get shipping rules for 'none'.
            } else if(frames == 0){
                shippingCost = shipping.rules.none;
                
            // if the frames value is over 10, get shipping rule for 'over10'.
            } else if(frames >= 10){
                shippingCost = shipping.rules.over10;
                
            // the frames rule will be under 10.     
            } else {
                shippingCost = shipping.rules.under10;
            }
            
            //update the shipping cost on the form and update the grand total. 
            $('#shipcost').text('$'+shippingCost);
            setGrandTotal(subTotal);
        }
        
        
        
        /*
            Function for retrieving each frames associated cost value. 
        */
        function getFrames(){
            let frames = Number(0);
            // loop through each element with the class 'frame'
            $('.frame').each( function(index, item) {
               
            // if the value is not 0, then update the elements id to quantity for recalculating.
              if($(this).val() != 0) {
                  let quant = $(this).attr('id').replace('frame', 'quantity');
                  frames += Number($('#'+quant).val());
              }
            });
            
            //return the frames value. 
            return frames;
        }
});