<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    $images = $favorites->getImage();
    $posts = $favorites->getPost();
    
    function outPutItem($pic, $id) {
        $image = "<td> <img src=images/square-small/$pic> </td>";
        $row = "<tr> $image <td><select id='size$id' class='size' name='size$id'></td> 
                            <td><select id='paper$id' class='paper' name='paper$id'></select></td> 
                            <td><select id='frame$id' class='frame' name='frame$id'></select></td>
                            <td><input id='quantity$id' type='number' class='quantity' name='quantity$id' min='0' value='1'></td>
                            <td><p id='total$id' class='total' name='total$id'>\$0</p></td>";
        return $row;
    }
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>


    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main >
            <div class="container">
            <h2>Favorites</h2>
              <!--Favorite Posts-->
            <div class="panel panel-default col-md-6">
                <div class="panel-heading head">
                    Favorite Posts 
                    <a href="unfavorite.php?type=post"><span class="btn btn-warning glyphicon glyphicon-trash" aria-hidden="true"></span></a> 
                    
                
                </div>
                <div class="panel-body inverse-color" id='favoritePostsPanel'>
                    <?php foreach($posts as $key => $post){ ?>
                        <div class="col-md-4">
                            <?php outputLink("single-post.php?id=$key", generateImage("square-small", $post[0], $post[1], 'img-thumbnail'), ""); ?>
                            
                            <a href="unfavorite.php?type=post&id=<?php echo $key?>" class="btn btn-warning"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            
                            <p><?php echo $post[1];?></p>
                            
                        </div>
                    <?php }?>
                    

                </div>
            </div>  <!--End of Favorite Posts-->

            
            <!--Favorite Image-->
            <div class="panel panel-default col-md-6">
                <div class="panel-heading head">
                     Favorite Images 
                     <a href="unfavorite.php?type=img"><span class=" btn btn-warning glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    <button class='btn btn-warning glyphicon glyphicon-print' id='print-button' aria-hidden='true'></button> 
                </div>
                <div class="panel-body inverse-color" id='favoriteImagesPanel'>
                    <?php
                    foreach($images as $key => $image) { 
                    
                    ?>
                    <div class="col-md-4">
                        <?php outputLink("single-image.php?id=$key", generateImage("square-small", $image[0], $image[1], 'img-thumbnail'), ""); ?>
                        
                        <a href="unfavorite.php?type=image&id=<?php echo $key?>" class="btn btn-warning"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        <p class=""><?php echo $image[1];?></p>
                        </div>
                    <?php }?>
                </div>
            </div>  <!--End of Favorite Images-->
            
            </div>
            
            
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
                            <button type="submit" class="btn btn-primary" form="order-form">Order</button>
                        </div>
                    </div> <!--End Modal Content-->
                </div> 
            </div> <!--End Modal-->
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?>
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    
    <script type="text/javascript" language="javascript" src="js/printFunctions.js"></script>   
</html>
