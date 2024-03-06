<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\all.min.css">
</head>

<body>
    <nav>
        <div class="nav__logo">UniNest NSBM</div>
        <ul class="nav__links">
            <li class="link"><a href="#">Home</a></li>
            <li class="link"><a href="#">Popular</a></li>
            <li class="link"><a href="#">About</a></li>
            <li class="link"><a href="#">Contact</a></li>
            <li class="link"><a href="#">Login</a></li>
        </ul>
    </nav>
    <header class="section__container header__container">
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

    <section class="section__container popular__container">
        <h2 class="section__header">Popular Accommodations</h2>
        <div class="popular__grid">
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Plaza Hotel</h4>
                        <h4>$499</h4>
                    </div>
                    <p>New York City, USA</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Ritz Paris</h4>
                        <h4>$549</h4>
                    </div>
                    <p>Paris, France</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Peninsula</h4>
                        <h4>$599</h4>
                    </div>
                    <p>Hong Kong</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Atlantis The Palm</h4>
                        <h4>$449</h4>
                    </div>
                    <p>Dubai, United Arab Emirates</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>The Ritz-Carlton</h4>
                        <h4>$649</h4>
                    </div>
                    <p>Tokyo, Japan</p>
                </div>
            </div>
            <div class="popular__card">
                <img src="assets/header_pic.jpeg" alt="popular hotel" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>Marina Bay Sands</h4>
                        <h4>$549</h4>
                    </div>
                    <p>Singapore</p>
                </div>
            </div>
        </div>
    </section>



</body>

</html>