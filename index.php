<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="project web 2/styles.css" />
    <title>Web Design Mastery | Burger House</title>
  </head>
<header class="header">
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#">
                    <img src="project web 2/assets/logo-dark.png" alt="logo" class="nav__logo-dark"/>
                    <img src="../assets/logo-white.png" alt="logo" class="nav__logo-white"/>
                </a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="#special">SPECIAL</a></li>
            <li><a href="Project web 2/login.php">MENU</a></li>
            <li><a href="#event">EVENTS</a></li>
            <li><a href="#contact">CONTACT US</a></li>
            <li><a href="project web 2/signup.php">SIGNUP</a></li>
            <li class="cart-header">
                <a href="project web 2/cart.php"><img src="project web 2/assets/cart.png" alt="Cart"/></a>
                <div class="cart-counter" id="cart-counter">0</div>
            </li>
            <li class="logout"><form action="/Project web 2/logout.php" method post>
                <input type="submit" id="logout" value="logout">
            </form></li>
        </ul>
    </nav>
    <div class="section__container header__container" id="home">
        <div class="header__image">
            <img src="project web 2/assets/header.png" alt="header"/>
        </div>
        <div class="header__content">
            <h2>IT IS GOOD TIME FOR THE GREAT TASTE OF BURGER</h2>
            <h1>BURGER<br/><span>WEEK</span></h1>
        </div>
    </div>
</header>


    <section class="section__container banner__container" id="special">
      <div class="banner__card">
        <p>TRY IT OUT TODAY</p>
        <h4>MOST POPULAR BURGER</h4>
      </div>
      <div class="banner__card">
        <p>TRY IT OUT TODAY</p>
        <h4>MORE FUN<br />MORE TASTE</h4>
      </div>
      <div class="banner__card">
        <p>TRY IT OUT TODAY</p>
        <h4>FRESH & CHILI</h4>
      </div>
    </section>

    <section class="section__container order__container" id="menu">
      <h3>ALWAYS TASTEY BURGER</h3>
      <h2 class="section__header">CHOOSE & ENJOY</h2>
      <p class="section__description">
        Whether you crave classic flavors or daring combinations, this is where
        your culinary journey begins. Indulge your cravings and savor every bite
        as you create your personalized burger experience with Burger Company.
      </p>
      <div class="order__grid">
        <div class="order__card">
          <img src="project web 2/assets/order-1.png" alt="order" />
          <h4>Chicken Burger</h4>
          <p>
            Sink your teeth into the timeless perfection of our Chicken Burger,
            an experience that never goes out of style.
          </p>
          <button class="btn">ORDER NOW</button>
        </div>
        <div class="order__card">
          <img src="project web 2/assets/order-2.png" alt="order" />
          <h4>Veggie Delight Burger</h4>
          <p>
            Embrace the vibrant flavors of our Veggie Delight Burger, a
            celebration of freshness and wholesome goodness.
          </p>
          <button class="btn">ORDER NOW</button>
        </div>
        <div class="order__card">
          <img src="project web 2/assets/order-3.png" alt="order" />
          <h4>BBQ Bacon Burger</h4>
          <p>
            Indulge in a symphony of smoky, savory flavors with our BBQ Bacon
            Burger, grilled and topped with crispy bacon.
          </p>
          <button class="btn">ORDER NOW</button>
        </div>
      </div>
    </section>

    <section class="section__container event__container" id="event">
      <div class="event__content">
        <div class="event__image">
          <img src="assets/event.png" alt="event" />
        </div>
        <div class="event__details">
          <h3>Discover</h3>
          <h2 class="section__header">UPCOMING EVENTS</h2>
          <p class="section__description">
            From exclusive burger tastings and chef collaborations to community
            outreach initiatives and seasonal celebrations, there's always
            something special on the horizon at Burger Company. Be the first to
            know about our upcoming events, promotions, and gatherings as we
            continue to bring joy and flavor to our cherished customers. Join us
            in creating memorable moments and delicious memories together!
          </p>
        </div>
      </div>
    </section>

    <section class="reservation" id="contact">
      <div class="section__container reservation__container">
        <h3>RESERVATION</h3>
        <h2 class="section__header">BOOK YOUR TABLE</h2>
        <form action="/">
          <input type="text" placeholder="NAME" />
          <input type="email" placeholder="EMAIL" />
          <input type="date" placeholder="DATE" />
          <input type="time" placeholder="TIME" />
          <input type="number" placeholder="PEOPLE" />
          <button class="btn" type="submit">FIND TABLE</button>
        </form>
      </div>
      <img
        src="project web 2/assets/reservation-bg-1.png"
        alt="reservation"
        class="reservation__bg-1"
      />
      <img
        src="project web 2/assets/reservation-bg-2.png"
        alt="reservation"
        class="reservation__bg-2"
      />
    </section>
<?php 
include 'project web 2/components/footer.php';
?>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
  </body>
</html>