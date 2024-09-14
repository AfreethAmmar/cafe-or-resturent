<?php
    include 'connect.php';
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Gallery cafe</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <style>
body {
  width: 100%;
  height: 130vh;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url(images/cafe123.jpg);
  background-size: cover;
  background-position: center;
}
#caption-text {
  color: #fff0cb;
}
.location-text {
  font-size: 40px;
  color: #000000;
  text-align: center;
  background-color: #fff0cb69;
  border-radius: 35px;
  align-items: start;
  display: flex;
  font-size: 20px;
}
.location-text-main p,
.location-text-main-left p {
  padding: 0px 45px;
  font-weight: 900;
}

      </style>
  </head>
  <body>
    <header>
      <div class="navebar">
        <a href="#"
          ><img class="logo"src="images/logo.png "loading="lazy" width="60px" height="60px"
          ></a
        >
        
          <ul>
           
                    
          <li><a href="unRegisterHome.php">Home</a></li>
                    <li><a href="unRegisterMenu.php">Menu</a></li>
                    <li><a href="unRegisterLocation.php">location</a></li>
                    <li><a href="unRegisterContact.php">contact</a></li>
                    <li><a href="unRegisterAboutus.php">about us</a></li>
                    
          </ul>
      </div>
    </header>

    <div data-aos="zoom-in-right">
      <div id="location-caption">
        <h2>Find your nearest <b id="caption-text">Gallery Caffe!</b></h2>
      </div>
    </div>
    <div class="location-heading-main">
      <div class="location-heading">
        <h2>Locations</h2>
      </div>
    </div>
    <div data-aos="fade-up-right">
      <div class="location-text-main">
        <div class="location-text">
          <p>
            Downtown Branch <br />
            Address: 123 Main Street, Downtown <br />
            Phone: (075) 930-3693
          </p>
        </div>
      </div>
    </div>
    <div data-aos="fade-up-left">
      <div class="location-text-main-left">
        <div class="location-text">
          <p>
            Uptown Branch <br />
            Address: 456, Elm Street, Upwntown <br />
            Phone: (075) 930-3693
          </p>
        </div>
      </div>
    </div>
    <div data-aos="fade-up-left">
      <div class="location-text-main">
        <div class="location-text">
          <p>
            Midtown Branch <br />
            Address: 789, Oca Elm Street, Midwntown <br />
            Phone: (075) 930-3693
          </p>
        </div>
      </div>
    </div>
    </div>
    <div data-aos="fade-in">
      <div class="btn-div">
        <button id="btn"><a href="/index.html">Back to Menu</a></button>
      </div>
    </div>

    <footer>
      <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      //alert('works')
      AOS.init({
        delay: 500,
        duration: 1000,
      });
    </script>
  </body>
</html>
