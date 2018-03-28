$(function(){
    
    $(`#print-button`).on(`click`, getPrintDialogData)
     function getPrintDialogData (e) {
        var url = `print-services.php`;
        var data = [];
        $.get(url).done(function(data){
            document.dialogData = data;
            $(document).trigger(`buildDialog`, document.dialogData);
        }).fail(function(xhr, status, error){
            alert(`Faild loading data! Status = ` + status + ` Error =` + error);
        }).always(function(data){
                
        });
    };
    
    document.dialog = 
    `<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Print Favourites
        <button type="button" class="btn btn-warning close glyphicon glyphicon-remove" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class='form-horizontal' method='post' action='favorites.php'>
        <table>
            <tr id='labels'>
                <td>Sizes</td>
                <td>Paper</td>
                <td>Frame</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
            <tr id='content'>
            </tr>
            </br>
             
        </table>
        </br>
            <div class='container float-right' id='totals'>
            
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Order</button>
      </div>
    </div>
    </div>
    </div>`;
    $(`body`).append(document.dialog);
    
    
    $(document).on(`buildDialog`, function(){
         var shipping = document.dialogData[`shipping`];
         var freeThresholds = document.dialogData[`freeThresholds`];
         

         $.each(document.dialogData, function(index, value){
            if(index == `shipping`){
                var input = $(`<input type='radio' name='shipping' value=`+value[0].name+`> `+value[0].name+` </input></br>`);
                var input1 = $(`<input type='radio' name='shipping' value=`+value[1].name+`> `+value[1].name+` </input>`);
                var td = $(`<td/>`).append($(input));
                var td1 = $(`<td/>`).append($(input1));
                $(`#totals`).append($(td), $(td1));
                
            } else if(index == `freeThresholds`){
                //do nothing
            }else {
                var id = `#` + index;
                var select = $(`<select id='`+id+`' name='`+index+`'>` + `</select>`);
                var td = $(`<td/>`).append($(select));
                td.appendTo(`#content`);
                $.each(value, function(ind, val){
                    if(value !== `shipping` && value !== `freeThresholds`){
                        $(select).append($(`<option name='`+index+`' value='`+val.cost+`'>`+val.name+`</option>`));
                    }
                });
            }
            
            
            
        });
        var quantInput = $(`<td><input class='inputsm' style='width:50px;' type='number' name='quantity' value=0></td>`);
        var total = $(`<td><p>$100.90</p></td>`);
        $(`#content`).append($(quantInput), $(total)); 
        
         $(`#printModal`).attr(`aria-hidden`, `false`);
         $(`#printModal`).toggle(`model`);
         
    });
    
    
    
});