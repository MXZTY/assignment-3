$(function(){
        var url = `print-services.php`;
        $.get(url).done(function(data){
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
           
           $('#standard').text(data.shipping[0].name);
           console.log($('#standard'));
           $('#shipcost').text('$'+data.shipping[0].rules.none);
           $('#secondary').text(data.shipping[1].name);
           console.log($('#secondary'));
           calulateTotal();
           
           
           $('#order-form').on('change', function(e){
               if(e.target.tagName.toUpperCase() == "SELECT" || e.target.getAttribute('type').toUpperCase() == 'NUMBER') {
                   let key = e.target.getAttribute('name').replace(e.target.className, '');
                   let total = document.querySelector('#total'+key);
                   let totalCost = calculateRowTotal(key, data);
                   $(total).text("$"+ totalCost);
               } 
               calulateTotal();
               let shippingID = $('input[name=shipping]:checked').val();
               updateShipping(data.shipping[shippingID], data.freeThresholds[shippingID], 10);
               
               
               
           });
        }).fail(function(xhr, status, error){
            alert(`Failed loading data! Status = ` + status + ` Error =` + error);
        }).always(function(data){
                
        });
        
        function makeOption(info, a) {
            for(let i = 0; i < info.length; i++) {
                let item = $(`<option></option>`).attr('name', info[i].name).html(info[i].name);
                item.attr('value', info[i].id);
                  a.append(item);
            }
        }
        
        function calculateRowTotal(key, data) {
            let sizeID = $( '#size' + key + ' option:selected').attr('value');
            let paperID = $('#paper' + key + ' option:selected').attr('value');
            let frameID = $('#frame' + key + ' option:selected').attr('value');
            let quant = $('#quantity'+key).val();
            if(quant === '' || quant === undefined) {
                quant = 0;
            }
            
            let paperCost = data.stock[paperID].large_cost;
            if(sizeID < 2){
                paperCost = data.stock[paperID].small_cost;
            } 
            
            return calculatePrice(data.sizes[sizeID].cost, paperCost, data.frame[frameID].costs[sizeID], quant);        
            
        }
        
        function calulateTotal(){
            let totals = document.querySelectorAll('.total');
            let sum = 0;
            for(let i = 0; i < totals.length; i++){
                let cost = totals[i].textContent.split('$')[1];
                if(cost === '' || cost === undefined) {
                    cost = 0;
                }
                sum += Number(cost);
            }
            document.querySelector('#subtotal').innerHTML = '$'+sum;
            setGrandTotal(sum);
        }
        
        function calculatePrice(size, paper, frame, quantity){
            let itemPrice = size + paper + frame;
            return itemPrice * quantity;
        }
        function setGrandTotal(subTotal) {
            let grandTotal = Number(subTotal) + Number($('#shipcost').text().split('$')[1]);
            document.querySelector('#grandtotal').innerHTML =  '$' + grandTotal;
        }
        function updateShipping(shipping, free, frames) {
            let subTotal = $('#subtotal').text().split('$')[1];
            let shippingCost = 0;
            
            if(Number(free.amount) <= Number(subTotal)) {
                shippingCost = 0;
            } else if(frames == 0){
                shippingCost = shipping.rules.none;
            } else if(frames >= 10){
                shippingCost = shipping.rules.over10;
            } else {
                shippingCost = shipping.rules.under10;
            }
            $('#shipcost').text('$'+shippingCost);
            setGrandTotal(subTotal);
        }
});