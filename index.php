<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <meta
      name="website1"
      content="This is the first practice html+css website"
    />
    <link rel="stylesheet" href="style.css" />
    <style>
.body {
  width: 100%;
  height: 100vh;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url(images/cafe123.jpg);
  background-size: cover;
  background-position: center;
}
.banner{
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url(images/cafe123.jpg);
  background-size: cover;
  background-position: center;
}
.navebar {
  width: 85%;
  margin: auto;
  padding: 5px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 3px solid #0096874f;
}

.logo {
  /*   cursor: pointer; */
  /*   background-color: #FFEA11; */
  margin-left: 5px;
}

.navebar ul li {
  list-style: none;
  display: inline-block;
  margin: 0 20px;
  /*padding: 0 20px; */
  position: relative;
}

.navebar ul li a {
  text-decoration: none;
  color: #fff0cb;
  text-transform: capitalize;
  font-weight: 800;
}

.navebar ul li::after {
  content: "";
  height: 2px;
  width: 0; /*100% */
  background: #fff0cb;
  position: absolute;
  left: 0;
  bottom: -8px;
  transition: 0.5s;
}

.navebar ul li:hover::after {
  width: 100%;
}

      </style>
  </head>
  <body>
  <!-- Customer-specific content here -->
    <div class="banner">
      <div class="navebar">
        <a href="#"
          ><img class="logo" src="images/logo.png "loading="lazy" width="60px" height="60px"
          ></a
        >
        <ul>
                    <li><a href="index.php">Home</a></li>
                    
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="location.php">location</a></li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a href="about-us.php">about us</a></li>
                    <li><a href="unRegisterHome.php">logout</a></li>
        </ul>
      </div>
      <div class="content">
        <h1>Gallery cafe</h1>
        <p>
          Hey Guys, where art and coffee blend seamlessly in a cozy, inspring
          ambiance. <br />
          enjoy your favorite brew surrounded by local artistry. <br />perfect
          for relaxing, meeting, andsharing ideas.
        </p>
      </div>
    </div>
  </body>
</html>
