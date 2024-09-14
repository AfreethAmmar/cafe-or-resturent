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
  height: 100%;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url(images/cafe123.jpg);
  background-size: cover;
  background-position: center;
}
.about-container {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
  background-color: #386b6600;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
  text-align: center;
  border-radius: 50px;
}

.about-container h1 {
  text-align: center;
  color: #ffffff;
  font-family: "Dancing Script", cursive;
}

.about-container h2 {
  color: #ffffff;
  border-bottom: 2px solid #ddd;
  padding-bottom: 5px;
  margin-top: 20px;
  background-color: #000000af;
}

.about-image {
  display: block;
  margin: 0 auto 20px;
  max-width: 100%;
  height: auto;
  border-radius: 30px;
  border: 3px solid white;
}

.about-container p {
  line-height: 1.6;
  color: #000000;
  background-color: #fff0cb69;
  padding: 10px;
  border-radius: 30px;
  font-weight: 600;
  font-size: 14px;
}
      </style>
  </head>
  <body>
    <header>
      <div class="navebar">
        <a href="#"
          ><img class="logo" src="images/logo.png "loading="lazy" width="60px" height="60px"
          ></a
        >
        <ul>
          <ul>
          <li><a href="index.php">Home</a></li>
                    
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="location.php">location</a></li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a href="about-us.php">about us</a></li>
                    <li><a href="unRegisterHome.php">logout</a></li>
          </ul>
      </div>
    </header>

    <div class="about-container">
      <div data-aos="zoom-out-up">
        <h1>About The Gallery Café</h1>
      </div>
      <div data-aos="flip-down">
        <img
          src="images/cafe-british-owned-managed.jpg"
          alt="The Gallery Café"
          class="about-image"
          width="300"
        />
      </div>
      <div
        data-aos="flip-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="2000"
      >
        <p>
          Welcome to The Gallery Café, where art and coffee come together to
          create a unique experience. Located in the heart of the city, our café
          offers a cozy ambiance for coffee lovers and art enthusiasts alike.
          <br />
          Our mission is to provide high-quality coffee and delicious pastries
          in a welcoming environment. We believe in supporting local artists by
          showcasing their work in our gallery space. <br />
          Come and enjoy a cup of our specialty coffee while admiring beautiful
          art. We look forward to welcoming you to The Gallery Café!
        </p>
      </div>
      <div
        data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1000"
      >
        <h2>Our Story</h2>
      </div>

      <div
        data-aos="flip-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="2000"
      >
        <p>
          The Gallery Café was founded in 2020 by a group of friends who share a
          passion for coffee and art. Our goal was to create a space where
          people can relax, enjoy a great cup of coffee, and appreciate local
          art.
        </p>
      </div>
      <div
        data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1000"
      >
        <h2>Meet the Team</h2>
      </div>

      <div
        data-aos="flip-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="2000"
      >
        <p>
          Our team is made up of dedicated coffee enthusiasts and talented
          baristas who strive to provide the best experience for our customers.
          Each team member brings their unique skills and passion to The Gallery
          Café.
        </p>
      </div>
    </div>

    <div data-aos="fade-in" data-aos-duration="900">
      <div class="btn-div">
        <button id="btn"><a href="index.php">Back to Menu</a></button>
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
        duration: 200,
      });
    </script>
  </body>
</html>
