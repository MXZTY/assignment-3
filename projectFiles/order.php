<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    function outputLineItem(){
        
    }

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/assignment-css.css" /> 

    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container-fluid" style='max-width:70%;'>
            <h1>Order Summary</h1>
        <table class="table orderTable">
            <!--<thead>-->
            <!--    <tr><th></th><th>Size</th><th>Paper</th><th>Frame</th><th>Quantity</th></tr>-->
            <!--</thead>-->
            
            <thead>
                <tr><th class='center-text'>Image</th><th class='col-md-3'>Details</th><th class='col-md-3'>Quantity</th>
            </thead>
            <tbody>
                
                
                <?php foreach ($_POST as $key => $value) {
                    if(strpos($key, 'shipping') !== false) {
                        echo "<tr><td/><td class='text-center' id='shipping' value='$value'></td></tr>";
                    } else {
                        if (strpos($key, 'image') !== false) {
                            echo "<tr class='itemRow'><td class='col-md-5 center-text' id='$key' value='$value'><img width=250px height='auto' src=images/medium/$value></td><td class='col-md-3'><table class='detailsTable'>";
                            continue;
                        } 
                        
                        if (strpos($key, 'size' !== false)){
                            echo"<tr class='detailsRow' id='$key' value='$value'></tr>";
                            
                        } else if (strpos($key, 'frame' !== false)) {
                            echo "<tr class='detailsRow' id='$key' value='$value'> </tr>";

                        } else if (strpos($key, 'quantity') !== false) {
                                echo "</table><td class='col-md-1' id='$key' value='$value'></br></br></br>X $value</td></tr>";
                                
                        } else {
                             echo "<tr class='detailsRow' id='$key' value='$value' ></br></tr></td>";
                        }
                        
                    }
                } ?>
               
            </tbody>
        </table>

        </main>
        
        </br></br>
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    
    <script type="text/javascript" language="javascript" src="js/printFunctions.js"></script>   
    <script type="text/javascript" language="javascript" src="js/orderFunctions.js"></script>   
        

</html>