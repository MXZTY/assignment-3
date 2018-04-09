<!--Modal Dialog-->
            <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Modal Content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn btn-warning close glyphicon glyphicon-remove" data-dismiss="modal" aria-label="Close"></button>
                            <h4 class="modal-title">Print Favourites</h4>
                        </div>
                        
                        <div class="modal-body">
                          <form id="order-form" class='form-horizontal' method='post' action='order.php'>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th> <!--Blank For image-->
                                        <th>Sizes</th>
                                        <th>Paper</th>
                                        <th>Frame</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                </tr>
                                </thead>
                                <?php 
                                    $index = 1;
                                    foreach($images as $key => $image) {
                                        echo outPutItem($image[0], $index);
                                        $index++;
                                    }
                                ?>
                                    
                            </table>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class='col-md-2 col-md-offset-9'>Subtotal: </div>
                                    <div id='subtotal' class='col-md-1'>$0</div>
                                </div>
                                <div class='row '>
                                    <div class="col-md-4 col-md-offset-5">
                                        <label  class="radio-inline"><input  type='radio' name='shipping' value='0' checked/><div id='standard'></div></label>
                                        <label   class="radio-inline"> <input type='radio' name='shipping' value='1'/><div id='secondary'></div></label>
                                    </div>
                                    <div class='col-md-2'> Shipping:</div>
                                    <div class='col-md-1'><p id='shipcost'>$0</p></div>
                                </div>
                                <div class="row ">
                                    <div class='col-md-2 col-md-offset-9'>Grandtotal: </div>
                                    <div id='grandtotal' class='col-md-1 '>$0</div>
                                </div>
                            </div>
                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="order-form" id='orderButton'>Order</button>
                        </div>
                    </div> <!--End Modal Content-->
                </div> 
            <div id="hover"></div> 
            </div> <!--End Modal-->
        
        