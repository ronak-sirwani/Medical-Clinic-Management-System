<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS :: Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="nav.css">
    <style>
        .path{
            padding-top:10px;
        }
        i{
            margin: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a href="./" class="navbar-brand">
            <b>HMS</b>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarid">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarid">
            <ul class="navbar-nav text-center ml-auto">
                <li class="nav-item px-2">
                    <a class="nav-link text-white" href="./aboutus.php">About Us</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link text-white" href="./contactus.php">Contact Us</a>
                </li>
                <li class="nav-item px-4">
                    <button type="button" class="btn btn-outline-primary">Log in</button>
            </ul>
        </div>
    </nav>
    <div class="">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Contact us</a></li>
        </ul>
        <center><h1>Contact us</h1></center>
<div class="container">
  <div class="card-columns">
    <div class="card bg-dark">
      <div class="card-body text-center text-white">
          <h3><i class="fas fa-map-marker-alt"></i>Address</h3>
        <p class="card-text">1 Sarita Park Society, Vatva, Ahmedabad, Gujarat</p>
      </div>
    </div>
    <div class="card bg-dark">
      <div class="card-body text-center text-white">
          <h3><i class="fas fa-phone-alt"></i>Phone No</h3>
        <p class="card-text">8722546291<br>6578902451</p>
      </div>
    </div>
    <div class="card bg-dark">
      <div class="card-body text-center text-white">
          <h3><i class="far fa-envelope"></i>Email</h3>
        <p class="card-text">degroup2020@gmail.com<br>durgesh1999@gmail.com</p>
      </div>
    </div>
  </div>
</div>
    </div>
    <?php include 'footer.html'; ?>
</body>

</html>