<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | HMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylej.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2fc6ba5c8f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">

          <a href="#" class="navbar-brand">
            <h2><b>HMS</b></h2>
          </a>

          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarid">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarid">
              <ul class="navbar-nav text-center ml-auto">
                  <li class="nav-item px-2">
                      <a class="nav-link" href="aboutus.php">About Us</a>
                  </li>
                  <li class="nav-item px-2">
                      <a class="nav-link" href="./contactus.php">Contact Us</a>
                  </li>
                  <li class="nav-item px-4">
                  <button type="button" class="btn btn-outline-primary">Login</button>
              </ul>

      </div>
  </nav>

  <div class="hero-image">
    <div class="bgimg">

        <div class="container text-center content">
          <h1 class="container text-center" style="margin-bottom: 15%; margin-top: 10%;">Welcome to Hospital Management System</h1>

            <button type="button" class="btn btn-outline-danger Button" id="apt">Book Appointment</button>
        </div>

    </div>

  </div>
    <div class="container text-center mt-5">
        <h1>Features</h1>

    <div class="row mt-2 ml-0" style="width: 100%;">

      <div class="col-lg-4 p-3">
      <div class="card">
        <i class="fas fa-hospital-user fa-3x"></i>
        <div class="card-body">
          <h4 class="card-title">HMS Service</h4>
          <p class="card-text">Welcome to you in HMS! This system provide all the hopital's related service on online.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-4 p-3">
      <div class="card">
        <i class="fas fa-user-lock fa-3x"></i>
        <div class="card-body">
          <h4 class="card-title">Data Secure</h4>
          <p class="card-text">Welcome to you in HMS! This system provide all the hopital's related service on online.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-4 p-3">
      <div class="card">
        <i class="fas fa-user-clock fa-3x"></i>
        <div class="card-body">
          <h4 class="card-title">Time Efficient</h4>
          <p class="card-text">Welcome to you in HMS! This system provide all the hopital's related service on online.</p>
        </div>
      </div>
    </div>

    </div>
    </div>

</div>
<?php include 'footer.html' ?>

<script>
  $('#apt').on('click', function() {
    window.location.href = "./bookAppointment.php";
  })
</script>
</body>

</html>
