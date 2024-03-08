<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/slider-styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav>
        <div class="nav__logo">UniNest NSBM</div>
        <ul class="nav__links">
            <li class="link"><a href="#home_section">Home</a></li>
            <li class="link"><a href="#popular_section">Accomodations</a></li>
            <li class="link"><a href="#blog_section">Blog</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <header class="section__container header__container" id="home_section">
        <div class="header__image__container">
            <div class="header__content">
                <h1>Discover Accommodation Options</h1>
                <p>Specifically for NSBM Students!</p>
            </div>
            <div class="booking__container">
                <form>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Location</label>
                        </div>
                        <p>Where are you looking to stay?</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Minimum Rent</label>
                        </div>
                        <p>What is your minimum budget?</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Maximum Rent</label>
                        </div>
                        <p>What is your maximum budget?</p>
                    </div>

                </form>
                <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </header>

    <section class="section__container popular__container" id="popular_section">
        <h2 class="section__header">New Accommodations</h2>
        <div class="popular__grid">
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <span class="rent">
                            <h4>Rs.12000</h4><span>
                    </div>
                    <p>New York City, USA</p>
                    <button class="location__button">View Location</button>
                </div>
            </div>
        </div>
    </section>




    <section class="section__container card__container swiper" id="blog_section">
        <h2 class="section__header">Explore Our Accommodation Guides</h2>
        <div class="card__content">
            <div class="swiper-wrapper">
                <article class="card__article swiper-slide">


                    <div class="card__data">
                        <h3 class="card__name">Kell Dawx</h3>
                        <p class="card__description">
                            Passionate about development and design,
                            I carry out projects at the request of users.
                        </p>

                        <a href="#" class="card__button">View More</a>
                    </div>
                </article>

                <article class="card__article swiper-slide">


                    <div class="card__data">
                        <h3 class="card__name">Lotw Fox</h3>
                        <p class="card__description">
                            Passionate about development and design,
                            I carry out projects at the request of users.
                        </p>

                        <a href="#" class="card__button">View More</a>
                    </div>
                </article>

                <article class="card__article swiper-slide">


                    <div class="card__data">
                        <h3 class="card__name">Sara Mit</h3>
                        <p class="card__description">
                            Passionate about development and design,
                            I carry out projects at the request of users.
                        </p>

                        <a href="#" class="card__button">View More</a>
                    </div>
                </article>

                <article class="card__article swiper-slide">


                    <div class="card__data">
                        <h3 class="card__name">Jenny Wert</h3>
                        <p class="card__description">
                            Passionate about development and design,
                            I carry out projects at the request of users.
                        </p>

                        <a href="#" class="card__button">View More</a>
                    </div>
                </article>

                <article class="card__article swiper-slide">


                    <div class="card__data">
                        <h3 class="card__name">Lexa Kin</h3>
                        <p class="card__description">
                            Passionate about development and design,
                            I carry out projects at the request of users.
                        </p>

                        <a href="#" class="card__button">View More</a>
                    </div>
                </article>
            </div>
        </div>

        <!-- Navigation buttons -->
        <div class="swiper-button-next">
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="swiper-button-prev">
            <i class="ri-arrow-left-s-line"></i>
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
        </div>





    </section>

    <footer class="footer" id="footer_section">
        <div class="section__container footer__container">
            <div class="footer__col">
                <h3>UniNest NSBM</h3>
                <p>
                    UniNest NSBM is Your one-stop platform for hassle-free student accommodation near NSBM Green University Town.
                    With diverse housing options, finding your perfect place to stay has never been easier.

                </p>
                <p>
                    Say goodbye to accommodation worries and hello to a stress-free booking experience with UniNest NSBM.
                </p>
            </div>
            <div class="footer__col">
                <h4>Company</h4>
                <p>About Us</p>
                <p>Our Team</p>
                <p>Contact Us</p>
            </div>
            <div class="footer__col">
                <h4>Legal</h4>
                <p>FAQs</p>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
            </div>
            <div class="footer__col">
                <h4>Resources</h4>
                <ul class="social-icons">
                    <li><a href="#" class="fab fa-facebook-f"></a></li>
                    <li><a href="#" class="fab fa-twitter"></a></li>
                    <li><a href="#" class="fab fa-instagram"></a></li>
                    <li><a href="#" class="fab fa-linkedin-in"></a></li>
                </ul>
            </div>
        </div>

        <div class="footer__bar">
            Copyright © nsbm. All rights reserved.
        </div>

    </footer>


    <!--=============== SWIPER JS ===============
        -->
    <script src="assets/js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>




</body>

</html>