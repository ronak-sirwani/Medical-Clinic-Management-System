<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="D:/xampp/htdocs/PROJECT/fontawesome-free-5.15.2-web/css/all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="D:/xampp/htdocs/PROJECT/js/bootstrap.min.js">
    <script src="D:/xampp/htdocs/PROJECT/js/jquery.min.js"></script>
    <script src="D:/xampp/htdocs/PROJECT/css/bootstrap.min.css"></script>-->
    <link rel="stylesheet" href="aboutus.css">
    <title>Document</title>
    <style>
        footer{
            padding: 10px;
        }
        footer a{
            padding: 20px;
            font-size: 20px;
            color: white;
        }
        .new{
            margin:10px;
        }
        #hms{
            padding: 5px !important;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">

        <a href="#" class="navbar-brand">
            <b>HMS</b>
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarid">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarid">
            <ul class="navbar-nav text-center ml-auto">
                <li class="nav-item px-2">
                    <a class="nav-link text-white" href="#">About Us</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link text-white" href="#">Contact Us</a>
                </li>
                <li class="nav-item px-4">
                    <button type="button" class="btn btn-outline-primary">Log in</button>
            </ul>
        </div>

    </nav>

    <div class="">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">About us</a></li>
        </ul>
    </div>

    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    Why HMS
                </a>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                    Features at Glance
                </a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                    History
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </div>
            </div>
        </div>
    </div>
    </div>

    <section class="portfolio bg-secondary">
        <div class="container text-center">
            <h2>DEVELOPERS</h2>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-10 d-block m-auto">
                    <div class="card">
                        <img src="two.jpg" class="card-img img-fluid">
                        <div class="card-body">
                            <p class="card-text">
                                <center>
                                    <h4>Shrey Shah</h4>
                                </center>HMS will provide a notice board on which you can see latest news
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-10 d-block m-auto">
                    <div class="card">
                        <img src="two.jpg" class="card-img img-fluid">
                        <div class="card-body">
                            <p class="card-text">
                                <center>
                                    <h4>Ronak Sirwani</h4>
                                </center>HMS will provide a notice board on which you can see latest news
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-10 d-block m-auto">
                    <div class="card">
                        <img src="two.jpg" class="card-img img-fluid">
                        <div class="card-body">
                            <p class="card-text">
                                <center>
                                    <h4>Jay Prajapati</h4>
                                </center>HMS will provide a notice board on which you can see latest news
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-10 d-block m-auto">
                    <div class="card">
                        <img src="two.jpg" class="card-img img-fluid">
                        <div class="card-body">
                            <p class="card-text">
                                <center>
                                    <h4>Durgesh Singh</h4>
                                </center>HMS will provide a notice board on which you can see latest news
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.html' ?>
</body>

</html>