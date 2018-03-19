<?php
$links = array(
    "Bootstrap" => "https://getbootstrap.com/",
    "Project on GitHub" => "https://github.com/A-Arndt/comp3512-assignment2",
    "Fundamentals of Web Development textbook" => "http://funwebdev.com/",
    "Bootstrap Customizer" => "http://bootstrap-live-customizer.com",
    "Google Maps (Static and Dynamic)" => "https://developers.google.com");
function outputLinks($link, $title){
    echo "<a href='$link' class='gold resourceLink'>$title</a>";
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <div class="panel panel-default">
                <div class='panel-heading'>
                    <h2>About Us</h2>
                    <p>This site was created as an assignment by Maxwell Tyson & Austin Arndt. It was the second assignment for COMP 3512 at Mount Royal University taught by Randy Connolly.</p>
                </div>
                <div class='panel-body inverse-color'>
                    <h4>External Resources Used</h4>
                    <ul class="resource-list list-group">
                        <?php foreach($links as $key => $value) { ?>
                            <li class="list-group-item">
                                <?php outputLinks($value, $key); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>