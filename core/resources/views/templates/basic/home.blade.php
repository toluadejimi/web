<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="Hosting Services and More...">
    <meta name="keywords" content="Hosting, Domain, Transfer, Buy Domain, Email">
    <link rel="canonical" href="https://html.themewant.com/elitehost">
    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="Webly - Web Hosting & More...">
    <meta property="og:description" content="Hosting Services and More...">
    <meta property="og:image" content="https://www.example.com/image.jpg">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Webly - Web Hosting & More...">
    <meta name="twitter:description" content="Hosting Services and More...">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('')}}/assets/assets/images/fav.png">

    <title>Webly - Web Hosting & More...</title>
    <!-- Preconnect to Google Fonts and Google Fonts Static -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- all styles -->
    <link rel="preload stylesheet" href="{{url('')}}/assets/assets/css/plugins.min.css" as="style">
    <!-- fontawesome css -->
    <link rel="preload stylesheet" href="{{url('')}}/assets/assets/css/plugins/fontawesome.min.css" as="style">
    <!-- Custom css -->
    <link rel="preload stylesheet" href="{{url('')}}/assets/assets/css/style.css" as="style">
</head>

<body>

<!-- HEADER AREA -->
<header class="rts-header style-one header__default">
    <!-- HEADER TOP AREA -->
    <div class="rts-ht rts-ht__bg">
        <div class="container">
            <div class="row">
                <div class="rts-ht__wrapper">
                    <div class="rts-ht__email">
                        <a href="mailto:info@webly.store"><img src="{{url('')}}/assets/assets/images/icon/email.svg" alt="" class="icon">contact@webly.store</a>
                    </div>
                    <div class="rts-ht__promo">
                        <p><img class="icon" src="{{url('')}}/assets/assets/images/icon/tag--group.svg" alt=""> Hosting Flash Sale: Starting at <strong>₦4,000/mo</strong> for a limited time</p>
                    </div>
                    <div class="rts-ht__links">
                        <div class="live-chat-has-dropdown">
                            <a href="#" class="live__chat"><img src="{{url('')}}/assets/assets/images/icon/forum.svg" alt="" class="icon">Live Chat</a>
                        </div>
                        <div class="login-btn-has-dropdown">
                            @auth
                                <a href="user/dashboard" class="login__link"><img src="{{url('')}}/assets/assets/images/icon/person.svg" alt="" class="icon">Dashboard</a>

                            @else
                                <a href="user/login" class="login__link"><img src="{{url('')}}/assets/assets/images/icon/person.svg" alt="" class="icon">Login</a>

                            @endauth
                            <div class="login-submenu">
                                <form action="index-six.html#">
                                    <div class="form-inner">
                                        <div class="single-wrapper">
                                            <input type="email" placeholder="Your email" required>
                                        </div>
                                        <div class="single-wrapper">
                                            <input type="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-btn">
                                            <button type="submit" class="primary__btn">Log In</button>
                                        </div>
                                        <a href="index-six.html#" class="forgot-password">Forgot your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADER TOP AREA END -->
    <div class="container">
        <div class="row">
            <div class="rts-header__wrapper">
                <div class="header-wrapper-left d-flex align-items-center ">
                    <!-- FOR LOGO -->
                    <div class="rts-header__logo">
                        <div class="@if (request()->routeIs('user.register')) col-xl-6 col-lg-7 col-md-10 @else col-xxl-5 col-lg-6 col-md-8 @endif">
                            <a href="{{ route('home') }}" class="text-center d-block my-3 mb-sm-4 logo">
                                <img src="{{ getImage(getFilePath('logoIcon') . '/dark_logo.png') }}" alt="@lang('logo')">
                            </a>
                            @yield('auth')
                        </div>
{{--                        <a href="index.html" class="site-logo">--}}
{{--                            <img src="{{ getImage(getFilePath('logoIcon') . '/dark_logo.png') }}" alt="@lang('logo')">--}}
{{--                            <img class="logo-dark" src="{{url('')}}/assets/assets/images/logo/logo-1.svg" alt="elitehost">--}}
{{--                        </a>--}}
                    </div>
                    <!-- FOR NAVIGATION MENU -->

                    <nav class="rts-header__menu" id="mobile-menu">
                        <div class="elitehost-menu">
                            <ul class="list-unstyled elitehost-desktop-menu">
                                <li class="menu-item elitehost-has-dropdown">
                                    <a href="#" class="elitehost-dropdown-main-element">Home</a>
                                </li>

                                <li class="menu-item elitehost-has-dropdown mega-menu big">
                                    <a href="index-six.html#" class="elitehost-dropdown-main-element">Services</a>
                                    <div class="rts-mega-menu">
                                        <div class="wrapper">
                                            <div class="row g-0">
                                                <div class="col-lg-3">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="pricing.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/03.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Bulletproof Hosting</p>
                                                                    <span>Starting from ₦25,000/mo</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="pricing.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/65.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Mobile App Development</p>
                                                                    <span>Starting from ₦800,000/mo</span>
                                                                </div>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/04.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Email Services</p>
                                                                    <span>Starting from ₦45,000/mo</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/09.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Project Maintenance</p>
                                                                    <span>Starting from ₦100,000/mo</span>
                                                                </div>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="domain-checker.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/12.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Domain Registration</p>
                                                                    <span>Starting from ₦12,000/yr</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="sign-in.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/199.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>SSL Certificate</p>
                                                                    <span>Starting from ₦24,000/yr</span>
                                                                </div>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="contact.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/16.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Website Development</p>
                                                                    <span>Starting from ₦500,000/mo</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="knowledgebase.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/11.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Knowledgebase</p>
                                                                    <span>Read Elitehost article</span>
                                                                </div>
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item elitehost-has-dropdown mega-menu">
                                    <a href="index-six.html#" class="elitehost-dropdown-main-element">Hosting</a>
                                    <div class="rts-mega-menu">
                                        <div class="wrapper">
                                            <div class="row g-0">
                                                <div class="col-lg-6">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="shared-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/22.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Shared Hosting</p>
                                                                    <span>Manage Shared Hosting</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="wordpress-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/23.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>WordPress Hosting</p>
                                                                    <span>WordPress Hosting speed</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="vps-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/24.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>VPS Hosting</p>
                                                                    <span>Dedicated resources</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6">
                                                    <ul class="mega-menu-item">
                                                        <li>
                                                            <a href="reseller-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/25.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Reseller Hosting</p>
                                                                    <span>Earn additional revenue</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="dedicated-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/27.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Dedicated Hosting</p>
                                                                    <span>Hosting that gives you tools</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="cloud-hosting.html">
                                                                <img src="{{url('')}}/assets/assets/images/mega-menu/29.svg" alt="icon">
                                                                <div class="info">
                                                                    <p>Cloud Hosting</p>
                                                                    <span>Manage Cloud Hosting</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item elitehost-has-dropdown">
                                    <a href="index-six.html#" class="elitehost-dropdown-main-element">Features</a>
                                    <ul class="elitehost-submenu list-unstyled menu-pages">
                                        <li class="nav-item"><a class="nav-link" href="https://hostie-Email.themewant.com/?systpl=elitehost" target="_blank">More...</a></li>
                                        <li class="nav-item"><a class="nav-link" href="https://hostie-Email.themewant.com/index.php/store/shared-hosting?systpl=elitehost" target="_blank">Shared Hosting</a></li>
                                        <li class="nav-item"><a class="nav-link" href="https://hostie-Email.themewant.com/index.php/store/vps-hosting?systpl=elitehost" target="_blank">VPS Hosting</a></li>
                                        <li class="nav-item"><a class="nav-link" href="https://hostie-Email.themewant.com/index.php/announcements?systpl=elitehost" target="_blank">Announcement</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item elitehost-has-dropdown">
                                    <a href="index-six.html#" class="elitehost-dropdown-main-element">Help Center</a>
                                    <ul class="elitehost-submenu list-unstyled menu-pages">
                                        <li class="nav-item"><a class="nav-link" href="faq.html">FAQ</a></li>
                                        <li class="nav-item"><a class="nav-link" href="support.html">Support</a></li>
                                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                                        <li class="nav-item"><a class="nav-link" href="knowledgebase.html">Knowledgebase</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- FOR HEADER RIGHT -->
                </div>
                <div class="rts-header__right d-flex">
                    @auth
                        <a href="/user/dashboard" class="login__btn" target="_blank">Client Area</a>

                    @else

                        <a href="user/login" class="login__btn" target="_blank">Get Started</a>

                    @endauth
                    <button id="menu-btn" aria-label="Menu" class="mobile__active menu-btn"><i class="fa-sharp fa-solid fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER AREA END -->

<!-- HERO BANNER -->
<div class="rts-hero hero__banner wp__banner banner__background-4">
    <div class="rts-hero__video">
        <video loop muted autoplay src="{{url('')}}/assets/assets/images/video/hosting.mp4" class="appl1-hdvd-xx"></video>
    </div>
    <div class="container">
        <div class="row">
            <div class="hero__banner__wrapper d-flex flex-wrap flex-lg-nowrap gap-5 gap-lg-0
                align-items-center justify-content-between px-5 px-lg-0">

                <!-- banner content -->
                <div class="hero__banner__content content-5">
                    <h6 class="mb-0">
                        Up to 75% off Web Hosting
                    </h6>
                    <h1 class="heading">
                        Powerful Web Hosting Solutions
                    </h1>
                    <p class="price-area">From <span>₦4,500/mo</span>/mo. Regular ₦18,500/mo. excl. VAT</p>
                    <div class="domain__options">

                        <div class="domain__form">
                            <div id="nav-tabcontent" class="tab-content">
                                <div id="register" class="tab-pane fade active show" role="tabpanel">
                                    <form action="http://mydevhost.com/register/domain" class="domain__search d-flex">
                                        <input type="text" placeholder="Enter domain name" required>
                                        <select name="r" id="r">
                                            <option value=".com">.com</option>
                                            <option value=".net">.net</option>
                                            <option value=".love">.love</option>
                                            <option value=".pw">.pw</option>
                                            <option value=".org">.org</option>
                                            <option value=".org">.org</option>
                                            <option value=".info">.info</option>
                                            <option value=".info">.info</option>
                                            <option value=".xyz">.xyz</option>
                                        </select>
                                        <button type="submit" class="btn__primary">Search</button>
                                    </form>
                                </div>

                                <div id="transfer" class="tab-pane fade" role="tabpanel">
                                    <form action="index-six.html#" class="domain__search d-flex">
                                        <input type="text" placeholder="Enter domain name" required>
                                        <select name="t" id="t">
                                            <option value=".com">.com</option>
                                            <option value=".net">.net</option>
                                            <option value=".love">.love</option>
                                            <option value=".pw">.pw</option>
                                            <option value=".org">.org</option>
                                            <option value=".org">.org</option>
                                            <option value=".info">.info</option>
                                            <option value=".info">.info</option>
                                            <option value=".xyz">.xyz</option>
                                        </select>
                                        <button type="submit" class="btn__primary">Transfer</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="domain__list d-flex gap-5">
                            <div class="single__domain d-flex gap-1">
                                <strong>.com</strong>
                                <span>from ₦14,500/mo</span>
                            </div>
                            <div class="single__domain d-flex gap-1">
                                <strong>.org</strong>
                                <span>from ₦12,500/mo</span>
                            </div>
                            <div class="single__domain d-flex gap-1">
                                <strong>.xyz</strong>
                                <span>from ₦8,500/mo</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- banner content end -->
            </div>
        </div>
    </div>
</div>
<!-- HERO BANNER END -->

<!-- EliteHost FEATURE AREA -->
<section class="rts-feature section__padding">
    <div class="container">
        <div class="row gy-30">
            <div class="col-lg-3 col-md-6">
                <div class="single__feature">
                    <div class="single__feature--box">
                        <div class="single__feature--box-icon">
                            <img src="{{url('')}}/assets/assets/images/feature/feature-01.svg" alt="">
                        </div>
                        <h5 class="single__feature--box-title">
                            Free WHM & cPanel
                        </h5>
                        <p class="single__feature--box-description">
                            We guarantee it you don't have
                            to worry about it.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__feature">
                    <div class="single__feature--box">
                        <div class="single__feature--box-icon">
                            <img src="{{url('')}}/assets/assets/images/feature/feature-02.svg" alt="">
                        </div>
                        <h5 class="single__feature--box-title">
                            Performance Optimized
                        </h5>
                        <p class="single__feature--box-description">
                            If your website is slow or down
                            then you losing customers.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__feature">
                    <div class="single__feature--box">
                        <div class="single__feature--box-icon">
                            <img src="{{url('')}}/assets/assets/images/feature/feature-03.svg" alt="">
                        </div>
                        <h5 class="single__feature--box-title">
                            Super Easy to Use
                        </h5>
                        <p class="single__feature--box-description">
                            Our custom control panel to use
                            and removes the headache
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__feature">
                    <div class="single__feature--box">
                        <div class="single__feature--box-icon">
                            <img src="{{url('')}}/assets/assets/images/feature/feature-04.svg" alt="">
                        </div>
                        <h5 class="single__feature--box-title">
                            24/7 Expert Support
                        </h5>
                        <p class="single__feature--box-description">
                            Our custom control panel to use
                            and removes the headache
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- EliteHost FEATURE AREA END -->

<!-- EliteHost FEATURE AREA -->
<section class="rts-service section__padding body-bg-2">
    <div class="container">
        <div class="row">
            <div class="rts-section text-center">
                <h2 class="rts-section__title">Experience Our Exceptional Services</h2>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="single__service">
                    <div class="single__service--box">
                        <div class="single__service--box-icon">
                            <img src="{{url('')}}/assets/assets/images/service/shared__hosting.svg" alt="">
                        </div>
                        <h5 class="single__service--box-title">
                            Shared Hosting
                        </h5>
                        <p class="single__service--box-description">
                            The most popular hosting plan and comes at one of the most.
                        </p>
                        <div class="single__service--box-button">
                            <a href="index-six.html#" class="rts-btn">Get a Quote <i class="fa-regular fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__service">
                    <div class="single__service--box">
                        <div class="single__service--box-icon">
                            <img src="{{url('')}}/assets/assets/images/service/wordpress__hosting.svg" alt="">
                        </div>
                        <h5 class="single__service--box-title">
                            WordPress Hosting
                        </h5>
                        <p class="single__service--box-description">
                            WordPress Hosting gives you speed and performance with a full
                        </p>
                        <div class="single__service--box-button">
                            <a href="index-six.html#" class="rts-btn">Get a Quote <i class="fa-regular fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__service">
                    <div class="single__service--box">
                        <div class="single__service--box-icon">
                            <img src="{{url('')}}/assets/assets/images/service/cloud__hosting.svg" alt="">
                        </div>
                        <h5 class="single__service--box-title">
                            Cloud Hosting
                        </h5>
                        <p class="single__service--box-description">
                            Earn additional revenue or support your customers with easy-to-use
                        </p>
                        <div class="single__service--box-button">
                            <a href="index-six.html#" class="rts-btn">Get a Quote <i class="fa-regular fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single__service">
                    <div class="single__service--box">
                        <div class="single__service--box-icon">
                            <img src="{{url('')}}/assets/assets/images/service/reseller__hosting.svg" alt="">
                        </div>
                        <h5 class="single__service--box-title">
                            Reseller Hosting
                        </h5>
                        <p class="single__service--box-description">
                            Reseller hosting is a form of web hosting where the account
                        </p>
                        <div class="single__service--box-button">
                            <a href="index-six.html#" class="rts-btn">Get a Quote <i class="fa-regular fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- EliteHost FEATURE AREA END -->

<!-- DATA CENTER AREA -->
<div class="rts-data-center fix pb--120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="rts-section w-790 text-center">
                <h3 class="rts-section__title">
                    Data Centers All Around the World</h3>
                <p class="rts-section__description">Our web hosting, WordPress hosting, and cloud hosting plans offer server
                    locations in: USA, Germany Egypt , India, Chaina, Brazil, Canada, Russia, Australia and South
                    Africa.
                </p>
            </div>
        </div>
        <!-- data center content -->
        <div class="row">
            <div class="col-12">
                <div class="rts-data-center__location">
                    <img src="{{url('')}}/assets/assets/images/data__center.png" alt="data__center">
                    <ul class="round-shape">
                        <li class="one">
                            <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Canada" data-bs-custom-class="color-elitehost" title="Canada"></span>

                            <img src="{{url('')}}/assets/assets/images/flag-01.svg" alt="">
                        </li>
                        <li class="two">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="Germany"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-02.svg" alt="">
                        </li>
                        <li class="three">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="Russia"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-03.svg" alt="">
                        </li>
                        <li class="four">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="USA"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-04.svg" alt="">
                        </li>
                        <li class="five">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="Egypt"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-05.svg" alt="">
                        </li>
                        <li class="six">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="India"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-06.svg" alt="">
                        </li>
                        <li class="seven">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="China"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-07.svg" alt="">
                        </li>
                        <li class="eight">
                                <span class="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                      data-bs-custom-class="color-elitehost" title="Brazil"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-08.svg" alt="">
                        </li>
                        <li class="nine">
                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-custom-class="color-elitehost" data-bs-placement="bottom" data-bs-original-title="South Africa"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-09.svg" alt="">
                        </li>
                        <li class="ten">
                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-custom-class="color-elitehost" data-bs-placement="bottom" data-bs-original-title="Australia"></span>
                            <img src="{{url('')}}/assets/assets/images/flag-10.svg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DATA CENTER AREA END -->

<!-- HOSTING FEATURE AREA START -->
<div class="rts-hosting-feature-area area-3 body-bg-2 section__padding">
    <div class="container">
        <div class="section-inner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="left-side-image">
                        <img src="{{url('')}}/assets/assets/images/feature/feature-hero-09.webp" width="630" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-side-content">
                        <div class="section-title-area text-start">
                            <h2 class="section-title">Unmatched Website
                                Performance</h2>
                            <p class="desc">Finding and purchasing the perfect domain name is the first step to establishing a successful online presence. With our comprehensive domain registration.</p>
                        </div>
                        <ul class="feature-list">
                            <li>
                                <div class="icon">
                                    <img src="{{url('')}}/assets/assets/images/pricing/09.svg" alt="">
                                </div>
                                <div class="text">
                                    <h5 class="title">Easy Domain Search</h5>
                                    <p>Find the perfect domain name with various extensions (.com, .net, .org, etc.).</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{url('')}}/assets/assets/images/pricing/10.svg" alt="">
                                </div>
                                <div class="text">
                                    <h5 class="title">Competitive Pricing</h5>
                                    <p>Enjoy affordable domain registration fees.</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="{{url('')}}/assets/assets/images/pricing/09.svg" alt="">
                                </div>
                                <div class="text">
                                    <h5 class="title">24/7 Customer Support</h5>
                                    <p>Get assistance anytime with our round-the-clock support team.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HOSTING FEATURE AREA END-->

<!-- HOSTING FEATURE AREA START -->
<div class="rts-hosting-feature-area section__padding">
    <div class="container">
        <div class="section-inner">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-side-image">
                        <img src="{{url('')}}/assets/assets/images/feature/feature-hero-08.webp" width="574" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rts-whychoose__content area-3">
                        <h2 class="rts-whychoose__content--title">
                            Secure Remote Management Protocols
                        </h2>

                        <!-- single content-->
                        <div class="single">
                            <div class="single__image">
                                <img src="{{url('')}}/assets/assets/images/feature/feature-05.svg" alt="">
                            </div>
                            <div class="single__content">
                                <h6>SSL Certificates:</h6>
                                <p>Find the perfect domain name with various extensions (.com, .net, .org, etc.).</p>
                            </div>
                        </div>
                        <!-- single content-->
                        <div class="single">
                            <div class="single__image">
                                <img src="{{url('')}}/assets/assets/images/feature/feature-06.svg" alt="">
                            </div>
                            <div class="single__content">
                                <h6>DDoS Protection</h6>
                                <p>Enjoy affordable domain registration fees.</p>
                            </div>
                        </div>
                        <!-- single content-->
                        <div class="single">
                            <div class="single__image">
                                <img src="{{url('')}}/assets/assets/images/feature/feature-07.svg" alt="">
                            </div>
                            <div class="single__content">
                                <h6>Two-Factor Authentication (2FA)</h6>
                                <p>Get assistance anytime with our round-the-clock support team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HOSTING FEATURE AREA END-->

<!-- EliteHost FEATURE AREA -->
<section class="rts-service area-2 body-bg-2 section__padding">
    <div class="container">
        <div class="row">
            <div class="rts-section text-center">
                <h2 class="rts-section__title">Here's why you'll love hosting with Elitehost</h2>
            </div>
        </div>
        <div class="service-inner">
            <ul>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/01.svg" alt="">
                        <h6>No Limits</h6>
                    </div>
                    <p class="desc">You don't have to sacrifice quality to get great hosting at a low cost.</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/02.svg" alt="">
                        <h6>Affordability</h6>
                    </div>
                    <p class="desc">Get unlimited storage and scalable bandwidth.</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/03.svg" alt="">
                        <h6>Free Domain</h6>
                    </div>
                    <p class="desc">et your domain for free when you use the promo code </p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/04.svg" alt="">
                        <h6>Drag & Drop Capability</h6>
                    </div>
                    <p class="desc">Our easy-to-use drag-and-drop website builder is automatically included.</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/05.svg" alt="">
                        <h6>99% Uptime Guarantee</h6>
                    </div>
                    <p class="desc">Reliability you can count on, so your site will be up and running</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/01.svg" alt="">
                        <h6>Reliability & Security</h6>
                    </div>
                    <p class="desc">Get unlimited storage and scalable bandwidth.</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/01.svg" alt="">
                        <h6>Safe & Secure</h6>
                    </div>
                    <p class="desc">Get unlimited storage and scalable bandwidth.</p>
                </li>
                <li class="service-wrapper">
                    <div class="icon-area">
                        <img src="{{url('')}}/assets/assets/images/service/06.svg" alt="">
                        <h6>24/7 Expert Support</h6>
                    </div>
                    <p class="desc">Encrypt data with an automatic SSL plan and access even more security tools </p>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- EliteHost FEATURE AREA END -->

<!-- TESTIMONIAL -->
<section class="rts-testimonial area-2 section__padding">
    <div class="container">
        <div class="row ">
            <div class="col-12 d-flex justify-content-center">
                <div class="rts-section w-460 text-center">
                    <h2 class="rts-section__title">Our Client Feedback</h2>
                    <p class="rts-section__description">We’re honored and humbled by the great feedback we receive
                        from our customers on a daily basis.</p>
                </div>
            </div>
        </div>
        <!-- testimonial -->
        <div class="row">
            <div class="col-lg-12">
                <div class="rts-testimonial__slider testimonial__slider--second">
                    <div class="swiper-wrapper">
                        <!-- single testimonial -->
                        <div class="swiper-slide">
                            <div class="rts-testimonial__single2">
                                <div class="quote-icon">
                                    <img src="{{url('')}}/assets/assets/images/testimonials/quote.svg" alt="">
                                </div>
                                <div class="content">
                                    <p>I am using Digital Ocean Plan in Cloud ways and I can confirm it is very good. Also, additional the backup with my hosting is awesome too.</p>
                                </div>
                                <div class="author__meta">
                                    <div class="author__meta--image">
                                        <img src="{{url('')}}/assets/assets/images/testimonials/author.png" alt="">
                                    </div>
                                    <div class="author__meta--details">
                                        <a href="index-six.html#">Jamie Knop</a>
                                        <span>Business Owner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonial end -->
                        <!-- single testimonial -->
                        <div class="swiper-slide">
                            <div class="rts-testimonial__single2">
                                <div class="quote-icon">
                                    <img src="{{url('')}}/assets/assets/images/testimonials/quote.svg" alt="">
                                </div>
                                <div class="content">
                                    <p>I started my own web hosting business
                                        their reseller hosting plan, and it's been a great decision. The resources are ample,
                                        the management tools are easy to use.</p>
                                </div>
                                <div class="author__meta">
                                    <div class="author__meta--image">
                                        <img src="{{url('')}}/assets/assets/images/testimonials/author-2.png" alt="">
                                    </div>
                                    <div class="author__meta--details">
                                        <a href="index-six.html#">Jahed Khan</a>
                                        <span>Business Owner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonial end -->
                        <!-- single testimonial -->
                        <div class="swiper-slide">
                            <div class="rts-testimonial__single2">
                                <div class="quote-icon">
                                    <img src="{{url('')}}/assets/assets/images/testimonials/quote.svg" alt="">
                                </div>
                                <div class="content">
                                    <p>I've been using their web hosting services for over a year now, and I happier. The uptime is fantastic, and the customer support team is always quick.</p>
                                </div>
                                <div class="author__meta">
                                    <div class="author__meta--image">
                                        <img src="{{url('')}}/assets/assets/images/testimonials/author-3.png" alt="">
                                    </div>
                                    <div class="author__meta--details">
                                        <a href="index-six.html#">Samira Khan</a>
                                        <span>Digital Marketer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonial end -->
                        <!-- single testimonial -->
                        <div class="swiper-slide">
                            <div class="rts-testimonial__single2">
                                <div class="quote-icon">
                                    <img src="{{url('')}}/assets/assets/images/testimonials/quote.svg" alt="">
                                </div>
                                <div class="content">
                                    <p>I've been using their web hosting services for over a year now, and I happier. The uptime is fantastic, and the customer support team is always quick.</p>
                                </div>
                                <div class="author__meta">
                                    <div class="author__meta--image">
                                        <img src="{{url('')}}/assets/assets/images/testimonials/author.png" alt="">
                                    </div>
                                    <div class="author__meta--details">
                                        <a href="index-six.html#">Jamie Knop</a>
                                        <span>Business Owner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single testimonial end -->
                    </div>
                    <!-- pagination dot -->
                    <div class="rts-dot__button slider-center"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- TESTIMONIAL END -->

<!-- HOSTING LATEST BLOG -->
<section class="rts-blog body-bg-2 pt--120 pb--60">
    <div class="container">
        <div class="row justify-content-center justify-content-md-start">
            <div class="col-md-12 col-sm-10">
                <div class="rts-section text-center">
                    <h2 class="rts-section__title">Latest Article</h2>
                </div>
            </div>
        </div>
        <!-- blog start -->
        <div class="row g-30 mb--60 justify-content-center justify-content-md-start">
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.html">
                        <img class="blog__thumb" src="{{url('')}}/assets/assets/images/blog/blog-1.webp" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="index-six.html#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.html" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{url('')}}/assets/assets/images/author/author__one.png" alt="">
                            </div>
                            <div class="author__content">
                                <a href="index-six.html#">Mack jon</a>
                                <span>Developer & Web serenity </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.html">
                        <img class="blog__thumb" src="{{url('')}}/assets/assets/images/blog/blog-2.webp" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="index-six.html#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.html" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{url('')}}/assets/assets/images/author/author__two.png" alt="">
                            </div>
                            <div class="author__content">
                                <a href="index-six.html#">Ahmad Eamin</a>
                                <span>Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.html">
                        <img class="blog__thumb" src="{{url('')}}/assets/assets/images/blog/blog-3.webp" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="index-six.html#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.html" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{url('')}}/assets/assets/images/author/author__four.png" alt="">
                            </div>
                            <div class="author__content">
                                <a href="index-six.html#">Samira Khan</a>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- light cta -->
    </div>
</section>
<!-- HOSTING LATEST BLOG END -->

<!-- SHARED HOSTING FAQ -->
<section class="rts-hosting-faq section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="rts-section text-center">
                    <h2 class="rts-section__title mb-0">Frequently asked questions</h2>
                </div>
                <div class="rts-faq__accordion">
                    <div class="accordion accordion-flush" id="rts-accordion">
                        <div class="accordion-item active">
                            <div class="accordion-header" id="first">
                                <h4 class="accordion-button collapse show" data-bs-toggle="collapse" data-bs-target="#item__one" aria-expanded="false" aria-controls="item__one">
                                    Why buy a domain name from EliteHost?
                                </h4>
                            </div>
                            <div id="item__one" class="accordion-collapse collapse collapse show" aria-labelledby="first" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from EliteHost, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="two">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__two" aria-expanded="false" aria-controls="item__two">
                                    How does domain registration work?
                                </h4>
                            </div>
                            <div id="item__two" class="accordion-collapse collapse" aria-labelledby="two" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from EliteHost, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="three">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__three" aria-expanded="false" aria-controls="item__three">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__three" class="accordion-collapse collapse" aria-labelledby="three" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from EliteHost, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header" id="four">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__four" aria-expanded="false" aria-controls="item__four">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__four" class="accordion-collapse collapse" aria-labelledby="four" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from EliteHost, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="five">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__five" aria-expanded="false" aria-controls="item__four">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__five" class="accordion-collapse collapse" aria-labelledby="five" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from EliteHost, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- SHARED HOSTING FAQ END -->

<!-- NEWSLETTER AREA -->
<div class="rts-newsletter">
    <div class="container">
        <div class="row">
            <div class="rts-newsletter__box">
                <div class="rts-newsletter__box--content">
                    <h3 class="title">Sign up for web hosting today!</h3>
                    <form action="index-six.html#" class="newsletter__form">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" class="btn__two secondary__bg secondary__color">Subscribe </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- NEWSLETTER AREA END -->

<!-- FOOTER AREA -->
<footer class="rts-footer site-footer-one section__padding body-bg-2">
    <div class="container">
        <div class="row">
            <!-- widget -->
            <div class="col-lg-4 col-md-6 col-sm-6 rts-footer__widget--column">
                <div class="rts-footer__widget footer__widget w-280">
                    <div class="@if (request()->routeIs('user.register')) col-xl-6 col-lg-7 col-md-10 @else col-xxl-5 col-lg-6 col-md-8 @endif">
                        <a href="{{ route('home') }}" class="text-center d-block my-3 mb-sm-4 logo">
                            <img src="{{ getImage(getFilePath('logoIcon') . '/dark_logo.png') }}" alt="@lang('logo')">
                        </a>
                        @yield('auth')
                    </div>
                    <p class="brand-desc">1811 Silverside Rd, Wilmington <br> DE 19810, USA</p>
                    <div class="contact-wrapper">
                        <ul>
                            <li>
                                <div class="icon"><i class="fa-regular fa-phone"></i></div>
                                <a href="call-to:8060008899">+806 (000) 88 99</a>
                            </li>
                            <li>
                                <div class="icon"><i class="fa-sharp fa-regular fa-envelope"></i></div>
                                <a href="mail-to:info@webly.store">info@webly.store</a>
                            </li>
                        </ul>
                    </div>
                    <div class="separator site-default-border"></div>
                    <div class="payment__method">
                        <ul>
                            <li><img src="{{url('')}}/assets/assets/images/payment/visa.svg" alt=""></li>
                            <li><img src="{{url('')}}/assets/assets/images/payment/master-card.svg" alt=""></li>
                            <li><img src="{{url('')}}/assets/assets/images/payment/paypal.svg" alt=""></li>
                            <li><img src="{{url('')}}/assets/assets/images/payment/american-express.svg" alt=""></li>
                            <li><img src="{{url('')}}/assets/assets/images/payment/wise.svg" alt=""></li>
                            <li><img src="{{url('')}}/assets/assets/images/payment/skrill.svg" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- widget end -->
            <!-- widget -->
            <div class="col-lg-2 col-md-3 col-sm-6 rts-footer__widget--column">
                <div class="footer-widget-inner">
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Feature</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="blog.html">News Feed</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="sign-up.html">Sign Up</a></li>
                                <li><a href="sign-in.html">Sign In</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Help</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="support.html">Support</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="knowledgebase.html">Knowledgebase</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <!-- widget end -->
            <!-- widget -->
            <div class="col-lg-2 col-md-3 col-sm-6 rts-footer__widget--column">
                <div class="footer-widget-inner">
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Hosting</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="shared-hosting.html">Shared Hosting</a></li>
                                <li><a href="reseller-hosting.html">Reseller Hosting</a></li>
                                <li><a href="vps-hosting.html">VPS Hosting</a></li>
                                <li><a href="wordpress-hosting.html">WordPress Hosting</a></li>
                                <li><a href="cloud-hosting.html">Cloud Hosting</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Company</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="domain-checker.html">Domain Checker</a></li>
                                <li><a href="https://elitehost-Email.themewant.com/?systpl=elitehost">More...</a></li>
                                <li><a href="https://elitehost-Email.themewant.com/index.php/announcements?systpl=elitehost">Announcement</a></li>
                                <li><a href="https://elitehost-Email.themewant.com/index.php/store/shared-hosting?systpl=elitehost">Shared Hosting</a></li>
                                <li><a href="https://elitehost-Email.themewant.com/index.php/store/vps-hosting?systpl=elitehost">VPS Hosting</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widget end -->
            <!-- widget -->
            <div class="col-lg-4 col-md-6 rts-footer__widget--column">
                <div class="rts-footer__widget footer__widget w-307 ml--auto">
                    <h5 class="widget-title">Join Our Newsletter</h5>
                    <p>We'll send you news and offers.</p>
                    <form action="index-six.html#" class="newsletter mx-40">
                        <input type="email" class="home-one" name="email" placeholder="Enter mail" required>
                        <span class="icon"><i class="fa-regular fa-envelope-open"></i></span>
                        <button type="submit" aria-label="Submit"><i class="fa-regular fa-arrow-right"></i></button>
                    </form>
                    <div class="social__media">
                        <h5>social media</h5>
                        <div class="social__media--list">
                            <a href="https://www.facebook.com" aria-label="social-link" target="_blank" class="media"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com" aria-label="social-link" target="_blank" class="media"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.linkedin.com" aria-label="social-link" target="_blank" class="media"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.x.com" aria-label="social-link" target="_blank" class="media"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="https://www.behance.com" aria-label="social-link" target="_blank" class="media"><i class="fa-brands fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widget end -->
        </div>
    </div>
    <div class="rts__footer__copyright is__common">
        <div class="container">
            <div class="row">
                <div class="footer__copy__wrapper justify-content-center text-center">
                    <p>{{ __($general->site_name) }} &copy; {{ date('Y') }}. @lang('All Rights Reserved')</p>


                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER AREA END -->

<div id="anywhere-home" class="">
</div>

<!-- side bar area  -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu" aria-label="Close Menu"><i class="fa-sharp fa-thin fa-xmark"></i></button>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu metismenu" id="mobile-menu-active">
                <li class="has-droupdown">
                    <a href="index-six.html#" class="main">Home</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="index.html">Home One</a></li>
                        <li><a class="mobile-menu-link" href="index-two.html">Home Two
                            </a></li>
                        <li><a class="mobile-menu-link" href="index-three.html">Home Three</a></li>
                        <li><a class="mobile-menu-link" href="index-four.html">Home Four</a></li>
                        <li><a class="mobile-menu-link" href="index-five.html">Home Five</a></li>
                        <li><a class="mobile-menu-link" href="index-six.html">Home Six</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="index-six.html#" class="main">Pages</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="about.html">About</a></li>
                        <li><a class="mobile-menu-link" href="faq.html">Pricing</a></li>
                        <li><a class="mobile-menu-link" href="https://html.themewant.com/elitehost/book-a-demo.html">Sign Up</a></li>
                        <li><a class="mobile-menu-link" href="blog.html">Blog</a></li>
                        <li><a class="mobile-menu-link" href="blog-list.html">Blog List</a></li>
                        <li><a class="mobile-menu-link" href="support.html">Support</a></li>
                        <li><a class="mobile-menu-link" href="pricing.html">Pricing</a></li>
                        <li><a class="mobile-menu-link" href="https://html.themewant.com/elitehost/signin.html">Sign In</a></li>
                        <li><a class="mobile-menu-link" href="knowledgebase.html">Knowledgebase</a></li>
                        <li><a class="mobile-menu-link" href="blog-details.html">Blog Details</a></li>
                        <li><a class="mobile-menu-link" href="domain-checker.html">Domain Checker</a></li>
                        <li><a class="mobile-menu-link" href="contact.html">Contact</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="index-six.html#" class="main">Hosting</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="shared-hosting.html">Shared Hosting</a></li>
                        <li><a class="mobile-menu-link" href="wordpress-hosting.html">WordPress Hosting</a></li>
                        <li><a class="mobile-menu-link" href="vps-hosting.html">VPS Hosting</a></li>
                        <li><a class="mobile-menu-link" href="reseller-hosting.html">Reseller Hosting</a></li>
                        <li><a class="mobile-menu-link" href="dedicated-hosting.html">Dedicated Hosting</a></li>
                        <li><a class="mobile-menu-link" href="cloud-hosting.html">Cloud Hosting</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="index-six.html#" class="main">Feature</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" target="_blank" href="https://hostie-Email.themewant.com/?systpl=elitehost">More...</a></li>
                        <li><a class="mobile-menu-link" target="_blank" href="https://hostie-Email.themewant.com/index.php/store/shared-hosting?systpl=elitehost">Shared Hosting</a></li>
                        <li><a class="mobile-menu-link" target="_blank" href="https://hostie-Email.themewant.com/index.php/store/vps-hosting?systpl=elitehost">VPS Hosting</a></li>
                        <li><a class="mobile-menu-link" target="_blank" href="https://hostie-Email.themewant.com/index.php/announcements?systpl=elitehost">Announcment</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="index-six.html#" class="main">Help Center</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="knowledgebase.html">Knowledgebase</a></li>
                        <li><a class="mobile-menu-link" href="support.html">Support</a></li>
                        <li><a class="mobile-menu-link" href="contact.html">Contact</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <ul class="social-area-one pl--20 mt--100">
            <li><a href="https://www.linkedin.com" aria-label="social-link" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
            <li><a href="https://www.x.com" aria-label="social-link" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="https://www.youtube.com" aria-label="social-link" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
            <li><a href="https://www.facebook.com" aria-label="social-link" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
        </ul>
    </div>
    <!-- mobile menu area end -->
</div>

<!-- side abr area end -->


<!-- THEME PRELOADER START -->
<div class="loader-wrapper">
    <div class="loader">
    </div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- THEME PRELOADER END -->
<!-- BACK TO TOP AREA START -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>
<!-- BACK TO TOP AREA EDN -->

<!-- All Plugin -->
<script defer src="{{url('')}}/assets/assets/js/plugins.min.js"></script>
<!-- main js -->
<script defer src="{{url('')}}/assets/assets/js/main.js"></script>
</body>

</html>
