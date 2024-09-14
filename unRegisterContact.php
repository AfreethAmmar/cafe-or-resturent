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
  height: 100vh;
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url(images/cafe123.jpg);
  background-size: cover;
  background-position: center;
}
section {
  padding: 50px 0;
  min-height: 100vh;
}
.contact-info {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 30px;
}

.contact-info-item {
  background: #fff0cb69;
  padding: 15px 0px;
  border-radius: 20%;
}

.contact-info-text p {
  margin-bottom: 0px;
}
.contact-info-text h2 {
  color: #000000;
  font-size: 22px;
  text-transform: capitalize;
  font-weight: 600;
  margin-bottom: 10px;
}
.contact-info-text span {
  color: #000000;
  font-size: 16px;
  display: inline-block;
  width: 100%;
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
          <li><a href="unRegisterHome.php">Home</a></li>
                    <li><a href="unRegisterMenu.php">Menu</a></li>
                    <li><a href="unRegisterLocation.php">location</a></li>
                    <li><a href="unRegisterContact.php">contact</a></li>
                    <li><a href="unRegisterAboutus.php">about us</a></li>
                    
      </div>
    </header>
    <section class="contact-page-sec">
        <div data-aos="flip-up">
            <div class="contact-info">
                <div class="contact-info-item">
                  <div class="contact-info-icon">
                  <div class="contact-info-text">
                    <h2>address</h2>
                    <span>123 Main Street,</span> 
                    <span>Downtown </span> 
                  </div>
                </div>            
              </div>          
            </div>          
        </div>
        <div data-aos="flip-up">
            <div class="contact-info">
                <div class="contact-info-item">
                  <div class="contact-info-text">
                    <h2>E-mail</h2>
                    <span>Gallery@cafe.com</span> 
                    <span>afreethammar@gmail.com</span>
                  </div>
                </div>            
              </div>                
            </div>  
        </div>
             
            <div data-aos="flip-up">
                <div class="contact-info">
                    <div class="contact-info-item">
                      <div class="contact-info-text">
                        <h2>Open time</h2>
                        <span>Mon - Thu  9:00 am - 4.00 pm</span>
                        <span>Thu - Mon  10.00 pm - 5.00 pm</span>
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
      <p>&copy;2024 Gallery Cafe. All rights reserved.</p>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      //alert('works')
      AOS.init({
        delay: 1000,
        duration: 1000,
      });
    </script>
  </body>
</html>
