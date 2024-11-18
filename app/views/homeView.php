
<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Home Page</h2>

<h1>Hello, <?php 

 if ($is_logged_in) {
    ;
    echo $data['user_info']['username'];
} else {
    echo 'Guest!';
}
 ?></h1>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png" />
    <title>DoIndie</title>

     <!-- CSS FILE LINK -->
     <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\homepage.css">


  </head>
  <body>

    <!-- HEADER SECTION START -->
    <header>
      <nav class="header__nav">
        <div class="header__logo">
          <h4 data-aos="fade-down">DOINDIE</h4>
          <div class="header__logo-overlay"></div>
        </div>

        <ul class="header__menu" data-aos="fade-down">
          <li>
            <a href="homepage.html">Home</a>
          </li>
          
          <li class="dropdown">
            <a href="#" data-toggle="dropdown">Artists</a>
            <ul class="dropdown-menu">
              <li><a href="#">Artist 1</a></li>
              <li><a href="#">Artist 2</a></li>
              <li><a href="#">Artist 3</a></li>
              <li><a href="#">Artist 4</a></li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a href="<?php echo BASEURL; ?>products" data-toggle="dropdown">Products</a>
            <!-- <ul class="dropdown-menu">
              <li><a href="#">Product 1</a></li>
              <li><a href="#">Product 2</a></li>
              <li><a href="#">Product 3</a></li>
              <li><a href="#">Product 4</a></li>
            </ul> -->
          </li>

          <li>
            <a class="cart-link" href="#">CART</a>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown">Profile</a>
            <ul class="dropdown-menu">
              <li><a href="#edit-profile">Edit Profile</a></li>
              <li><a href="#log-out">Log Out</a></li>
            </ul>
        </ul>

        <ul class="header__menu-mobile" data-aos="fade-down">
          <li>
            <img src="<?php echo BASEURL; ?>assets\img\menu.svg" alt="art1" />
          </li>
        </ul>
      </nav>
    </header>
    <!-- HEADER SECTION END -->

    <!-- HERO SECTION START -->
    <section class="hero">
      <div class="hero-image">
        <img 
          src="<?php echo BASEURL; ?>assets\img\FISH MASCOT.png"
          alt="homepage image"
          data-aos="fade-up"
        />
        <h2 data-aos="fade-up">
          Do, <br />
          Indie
        </h2>

        <div class="hero-image__overlay"></div>
      </div>

      <div class="hero-content">
        <div class="hero-content-info" data-aos="fade-left">
          <h1>Made by Artists, for Artists</h1>
          <p>An online artists' marketplace.</p>

          <div class="hero-content__buttons">
            <button class="hero-content__order-button">What's New?</button>
            <button class="hero-content__play-button">
              <img src="<?php echo BASEURL; ?>assets\img\play-circle.svg" alt="play" />
              Terms and Conditions
            </button>
          </div>
        </div>

        <div class="hero-content__testimonial" data-aos="fade-up">
          <div class="hero-content__customer flex-center">
            <h4>Lorem</h4>
            <p>Ipsum Dolor</p>
          </div>

          <div class="hero-content__review">
            <img src="<?php echo BASEURL; ?>assets\img\user.png" alt="user" />
            <p>"User review here maybe?"</p>
          </div>
        </div>
      </div>
    </section>
    <!-- HERO SECTION END -->


    <!-- SCROLLING GALLERY START -->
    <div class="carousel">
      <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc; font-family:'Roboto', sans-serif; padding-top: 5px;">TOP SELLERS</h1>
      <div class="carousel-container">
        <img class="carousel-item carousel-item-3" src="<?php echo BASEURL; ?>assets\img\1.png" loading="lazy" data-index="1">
        <img class="carousel-item carousel-item-4" src="<?php echo BASEURL; ?>assets\img\1.png" loading="lazy" data-index="2">
        <img class="carousel-item carousel-item-5" src="<?php echo BASEURL; ?>assets\img\1.png" loading="lazy" data-index="3">
        <img class="carousel-item carousel-item-1" src="<?php echo BASEURL; ?>assets\img\1.png" loading="lazy" data-index="4">
        <img class="carousel-item carousel-item-2" src="<?php echo BASEURL; ?>assets\img\1.png" loading="lazy" data-index="5">
      </div>
      
      <div class="carousel-controls">
        <button class="carousel-control carousel-control-previous" data-name="previous">
          <span class="ax-hidden">previous</span>
        </button>
        <button class="carousel-control carousel-control-add" data-name="add">
          <span class="ax-hidden">add</span>
        </button><button class="carousel-control carousel-control-play playing" data-name="play">
          <span class="ax-hidden">play</span>
        </button>
        <button class="carousel-control carousel-control-next" data-name="next">
          <span class="ax-hidden">next</span>
        </button>
      </div>
    </div>
    <!-- SCROLLING GALLERY END -->

    <!-- FOOTER START -->
    <footer class="footer flex-between">
      <h3 class="footer__logo">
        <span>Do</span>Indie
      </h3>

      <ul class="footer__nav">
        <li><a href="homepage.html">Home</a></li>
        <li><a href="">Customer Service</a></li>
        <li><a href="">Shopping Cart</a></li>
        <li><a href="">About Us</a></li>
      </ul>

      <ul class="footer__social">
        <li class="flex-center">
          <img src="<?php echo BASEURL; ?>assets\img\facebook.svg" alt="facebook" />
        </li>
        <li class="flex-center">
          <img src="<?php echo BASEURL; ?>assets\img\instagram.svg" alt="instagram" />
        </li>
        <li class="flex-center">
          <img src="<?php echo BASEURL; ?>assets\img\twitter.svg" alt="twitter" />
        </li>
      </ul>
    </footer>
    <!-- FOOTER END -->

    <!-- JS FILE LINK -->
    <script defer src="<?php echo BASEURL; ?>assets\js\homepage.js"></script>
  </body>
</html>