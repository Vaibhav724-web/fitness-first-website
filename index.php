<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Fitness first the way to the healthier life starts now.</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  .<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container"> 
      <a class="navbar-brand mr-auto" href="index.php">
        <img src="images/logo.png" alt="FitnessFirst" />
      </a>     
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> 
        <span class="navbar-toggler-icon"></span> 
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="index.php">Home</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#about-us">About</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#contact">Contact</a> </li>
          <li class="nav-item"> <a class="nav-link" href="workout.html">Workouts</a> </li>       
          <li class="nav-item"> <a class="nav-link" href="food.html">Healthy Recipes</a> </li>
          <li class="nav-item"><a class="nav-link" href="logout.php"> Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="banner" style="background-image: url('images/gym.jpg'); background-size: cover; background-position: center; height: 100vh; width: 100%; display: flex; align-items: center; justify-content: center;">
    <div class="container">
      <div class="fh5co-banner-text-box">
        <div class="quote-box pl-5 pr-5 wow bounceInRight">
          <h2> Fitness <br><span>First</span> </h2>
        </div>
        <a href="nutriplan.php" class="btn text-uppercase btn-outline-danger btn-lg mb-3 wow bounceInDown">Get Diet Plan</a>
        <a href="schedule.html" class="btn text-uppercase btn-outline-danger btn-lg mb-3 wow bounceInDown">Get Weekly Schedule</a>
      </div>
    </div>
  </div>

  <div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" 
     style="background-image:url('images/about-bg.jpg'); background-size:cover; background-position:center;">
  <div class="container">
    <div class="col-sm-6 offset-sm-6">
      <h2 class="wow bounceInLeft" data-wow-delay=".25s">ABOUT US</h2>
      <hr/>
      <p class="wow bounceInRight" data-wow-delay=".25s">We are dedicated to helping you achieve your fitness goals through personalized training, modern facilities, and expert guidance. We provide fitness program, nutrition advice, and lifestyle coaching to transform your life.</p>
    </div>
  </div>
</div>

  <div class="container-fluid fh5co-content-box">
    <div class="container">
      <div class="row">
        <div class="col-md-5 pr-0"><img src="images/rode-gym.jpg" alt="gym" class="img-fluid wow bounceInLeft" /> </div>
        <div class="col-md-7 pl-0">
          <div class="wow bounceInRight" data-wow-delay=".25s">
            <div class="card-img-overlay">
              <p>Great weekend, met lots of cool people and took away quite a bit. Thank you for the experience, and to you and your professional team for making things seem </p>
            </div>
            <img src="images/gym-girls.jpg" alt="girls in gym" class="img-fluid" /> 
          </div>
        </div>
      </div>
      <div class="row trainers pl-0 pr-0">
        <div class="col-12 bg-50">
          <div class="quote-box2 wow bounceInDown" data-wow-delay=".25s">
            <h2>Other Services</h2>
          </div>
        </div>
        <div class="col-md-6 pr-5 pl-5">
          <div class="card text-center wow bounceInLeft" data-wow-delay=".25s"> 
            <img class="card-img-top rounded-circle img-fluid" src="images/trainers1.jpg" alt="Card image">
            <div class="card-body mb-5">
              <h4 class="card-title">WORKOUT</h4>
              <p class="card-text">You don't need a gym or fancy equipment to build muscle and get stronger.</p>
              <a href="workout.html"><p> Lets Get Started</p></a>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5 pr-5">
          <div class="card text-center wow bounceInRight" data-wow-delay=".25s"> 
            <img class="card-img-top rounded-circle img-fluid" src="images/trainers2.jpg" alt="Card image">
            <div class="card-body mb-5">
              <h4 class="card-title">HEALTHY RECIPES</h4>
              <p class="card-text">Looking for a few new healthy recipes to add to your weekly rotation ?</p>
              <a href="food.html"><p> Lets Get Started</p></a>
            </div>
          </div>
        </div>
      </div>

      <div class="row gallery">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body mb-4 wow bounceInLeft" data-wow-delay=".25s">
              <h4 class="card-title">WEIGHT LOSS</h4>
              <p class="card-text">Believe in yourself because every great journey begins with a single step...</p>
            </div>
            <img class="card-img-top img-fluid wow bounceInRight" data-wow-delay=".25s" src="images/g1.jpg" alt="Card image"> 
          </div>
        </div>
        <div class="col-md-4">
          <div class="card"> 
            <img class="card-img-top img-fluid wow bounceInUp" data-wow-delay=".25s" src="images/g2.jpg" alt="Card image">
            <div class="card-body mt-4 wow bounceInDown" data-wow-delay=".25s">
              <h4 class="card-title">MENTAL HEALTH</h4>
              <p class="card-text">Reduces anxiety, stress, and depression...</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body mb-4 wow bounceInRight" data-wow-delay=".25s">
              <h4 class="card-title">LIFESTYLE INTEGRATION</h4>
              <p class="card-text">Encourage active living...</p>
            </div>
            <img class="card-img-top img-fluid wow bounceInLeft" data-wow-delay=".25s" src="images/g3.jpeg" alt="Card image"> 
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer with Contact form wired to DB -->
  <footer class="container-fluid" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-3 footer1 d-flex wow bounceInLeft" data-wow-delay=".25s">
          <div class="d-flex flex-wrap align-content-center"> 
            <a href="index.php"><img src="images/logo.png" alt="logo" /></a>
            <p></p>
            <p>&copy; 2025 All rights reserved.<br></p>
          </div>
        </div>
        <div class="col-md-6 footer2 wow bounceInUp" data-wow-delay=".25s" id="contact">
          <div class="form-box">
            <h4>CONTACT US</h4>
            <form action="contact_submit.php" method="POST">
              <table class="table table-responsive d-table">
                <tr>
                  <td><input type="text" class="form-control pl-0" name="name" placeholder="NAME" required /></td>
                  <td><input type="email" class="form-control pl-0" name="email" placeholder="EMAIL" required /></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr>
                  <td colspan="2"><input type="text" class="form-control pl-0" name="address" placeholder="ADDRESS" /></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr>
                  <td colspan="2"><input type="text" class="form-control pl-0" name="message" placeholder="MESSAGES" required /></td>
                </tr>
                <tr><td colspan="2"></td></tr>
                <tr>
                  <td colspan="2" class="text-center pl-0"><button type="submit" class="btn btn-dark">SEND</button></td>
                </tr>
              </table>
            </form>
          </div>
        </div>

        <div class="col-md-3 footer3 wow bounceInRight" data-wow-delay=".25s">
          <h5>ADDRESS</h5>
          <p>RiseFit GYM Kothrud,Pune</p>
          <h5>PHONE</h5>
          <p>8767099924</p>
          <h5>EMAIL</h5>
          <p>risefit3@gmail.com</p>
          <div class="social-links">
            <ul class="nav nav-item">
              <li><img src="images/facebook.png" alt="facebook" /></li>
              <li><img src="images/you.png" alt="youtube" /></li>
              <li><img src="images/in.png" alt="instagram" /></li>
              <li><img src="images/in2.png" alt="twitter" /></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>