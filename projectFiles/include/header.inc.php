<header>

        <nav class="navbar navbar-inverse center">

            <div class="container container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a class='navbar-brand' href="index.php">Share Your Travels</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav navbar-left">    
                        <li class='dropdown'>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-justify"></span></a>
                            <ul class="dropdown-menu">
                                <?php 
                                if(session_id() == '') {
                                     session_start();
                                }
                                if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])){
                                     echo '<li><a href="login.php?state=logout"><span class="glyphicon glyphicon-log-out"> Log-Out</span></a></li>';
                                } else {
                                    echo '<li><a href="login.php?state=logout"><span class="glyphicon glyphicon-log-in"> Log-In</span></a></li>';

                                    }
                                ?>
                                <li><a href="user-profile.php"><span class="glyphicon glyphicon-user"> User-Profile</span></a></li>
                                <li><a href="favorites.php"><span class="glyphicon glyphicon-star"> Favorites</span></a></li>
                            </ul>
                        <li>
                    </ul>  
                    
                    
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.php">About</a></li>
                        <li><a href="aboutus.php">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="browse-countries.php">Countries</a></li>
                                <li><a href="browse-images.php">Images</a></li>
                                <li><a href="browse-users.php">Users</a></li>
                                <li><a href="browse-posts.php">Posts</a></li>
                            </ul>
                        </li>
                    </ul>  
                    <form action="browse-images.php" method='GET' class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input id='title-main' type="text" name="title" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-warning glyphicon glyphicon-search" id='title-main-submit'></button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>