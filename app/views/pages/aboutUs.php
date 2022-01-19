<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_aboutUs.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style_aboutusSlide.css">

</head>

<body>
    <header id="header">

        <a href="<?php echo URLROOT; ?>/PageController/home" class="logo">FlyBuy
            <img src="<?php echo URLROOT; ?>/public/img/logo.svg" id="flybuy-logo" style="width:65px;height:65px;position:absolute;margin-left:10px"></a>

        <ul>
            <li><a href="<?php echo URLROOT; ?>/PageController/buyerAccount/<?php echo $data['buyer_id']; ?>" class="active">Home</a></li>
            <li><a href="<?php echo URLROOT; ?>/PageController/loginSignup">Login/Sign up</a></li>
            <li><a href="<?php echo URLROOT; ?>/PageController/aboutUs">About us</a></li>
        </ul>

    </header>

    <div id="about-main">
        <div class="jumbotron">
            <div class="jumbotron-inner">
                <div class="top-box">
                    <div class="content-box">
                        <h1>
                            About FlyBuy
                        </h1>
                        <p>
                            Online shopping system for grocery items <br /> Our mission is to automate and facilitate the whole process of shopping.
                        </p>
                    </div>
                </div>
            </div>
            <div class="img-layer-container">
                <div class="team-image" id="team-image">
                    <img class="team4" src="<?php echo URLROOT; ?>/public/img/admin4.jpeg" />
                    <img class="team2" src="<?php echo URLROOT; ?>/public/img/admin2.jpg" />
                    <img class="team1" src="<?php echo URLROOT; ?>/public/img/admin1.jpg" />
                    <img class="team3" src="<?php echo URLROOT; ?>/public/img/admin3.jpeg" />

                </div>

                <div class="circles-container">
                    <div class="img-1">
                        <img src="https://apimatic.io/img/theme/aboutUs/Circles-1-1.svg" />
                    </div>
                    <div class="img-2">
                        <img src="https://apimatic.io/img/theme/aboutUs/Circles-2-1.svg" />
                    </div>
                </div>
            </div>
        </div>
        <div class="story-container">
            <div class="need-for-dx-container">
                <h3 class="text-center">
                    Need for DX
                </h3>
                <p>
                    Application Programming Interfaces (APIs) have taken the world by storm and are now the de facto standard of software communication. Almost every software product nowadays consumes APIs. The business model of numerous companies around the world relies upon the consumption of their APIs. API providers, therefore, strive to increase API adoption rates by spending millions of dollars every year to improve developer experience. This is usually done by providing Software Development Kits (SDKs) and API documentation to developer consuming their API(s). Developing SDKs and writing documentation, however, are arduous, monotonous and error-prone tasks. It is a slow process and costs a lot of time and money.
                </p>
                <div class="img-container">

                </div>
            </div>
            <div class="container-divider"></div>
            <div class="our-tech-container">
                <h3 class="text-center">
                    Our Technology
                </h3>
                <p>
                    Our code generation engine enables API providers to generate SDKs for their APIs within minutes and at a fraction of the cost. We provide tools like our API editor and API transformer to further aid API providers in minimizing the time required to ship excellent quality SDKs to the developers using their APIs. Our code generation engine is also capable of generating succinct and error-free documentation for APIs and SDKs, both. The documentation for the SDKs includes dynamic screenshots detailing usage instructions tailored to the provider's specific API and also code snippets showing example usage. As the cherry on the cake, we provide beautifully designed DX portals to encapsulate this documentation.
                </p>
                <div class="img-container">

                </div>
            </div>
            <div class="container-divider"></div>
            <div class="content">


                <div class="rm_wrapper">
                    <div id="rm_container" class="rm_container">
                        <ul>
                            <li data-images="rm_container_1" data-rotation="-15"><img src="<?php echo URLROOT; ?>/public/img/about/1.jpg" /></li>
                            <li data-images="rm_container_2" data-rotation="-5"><img src="<?php echo URLROOT; ?>/public/img/about/2.jpg" /></li>
                            <li data-images="rm_container_3" data-rotation="5"><img src="<?php echo URLROOT; ?>/public/img/about/3.jpg" /></li>
                            <li data-images="rm_container_4" data-rotation="15"><img src="<?php echo URLROOT; ?>/public/img/about/4.jpg" /></li>
                        </ul>
                        <div id="rm_mask_left" class="rm_mask_left"></div>
                        <div id="rm_mask_right" class="rm_mask_right"></div>
                        <div id="rm_corner_left" class="rm_corner_left"></div>
                        <div id="rm_corner_right" class="rm_corner_right"></div>
                        <h2>Fashion Explosion 2013</h2>
                        <div style="display:none;">
                            <div id="rm_container_1">
                                <img src="<?php echo URLROOT; ?>/public/img/about/1.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/f1.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/v1.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/s1.jpg" />
                            </div>
                            <div id="rm_container_2">
                                <img src="<?php echo URLROOT; ?>/public/img/about/2.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/f2.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/v2.png" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/s2.jpg" />
                            </div>
                            <div id="rm_container_3">
                                <img src="<?php echo URLROOT; ?>/public/img/about/3.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/f3.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/v3.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/s3.jpg" />
                            </div>
                            <div id="rm_container_4">
                                <img src="<?php echo URLROOT; ?>/public/img/about/4.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/f4.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/v4.jpg" />
                                <img src="<?php echo URLROOT; ?>/public/img/about/s4.jpg" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-divider"></div>
            <div class="today-container">
                <h3 class="text-center">
                    Flash Forward Today
                </h3>
                <p>
                    APIMatic has come a long way since its inception 3 years ago. Having started with only generating SDKs, APIMatic now provides solutions in other areas of developer experience as well. Presently, APIMatic is used by numerous organizations around the world to:
                </p>
                <ul>
                    <li>Create and store definitions of their APIs</li>
                    <li>Generate SDKs for their APIs for 10 platforms</li>
                    <li>Keep these SDKs in sync with API updates</li>
                    <li>Convert API descriptions into multiple formats (Swagger, API Blueprint, RAML etc.)</li>
                    <li>Generate beautiful documentation for their APIs and SDKs</li>
                    <li>Generate complete Developer Experience API Portals</li>
                </ul>
            </div>
            <div class="container-divider"></div>
        </div>
    </div>

    <!--Footer-->

    <footer id="footer">
        <div class="blocks">
            <div class="logo">powered by<br>
                <img src="<?php echo URLROOT; ?>/public/img/cosmos.png" id="cosmos" style="width:200px;position:absolute;margin-left:10px"><br><br><br><br><br>
                <span class="copyright">&copy; FlyBuy.All Rights Reserved.</span>
            </div>
            <div class="app">Download our app<br>
                <img src="<?php echo URLROOT; ?>/public/img/footer/playstore.svg" id="icons" style="width:120px;position:absolute;margin-left:40px;margin-top:20px;cursor:pointer;">
                <img src="<?php echo URLROOT; ?>/public/img/footer/iphone.svg" id="icons" style="width:120px;position:absolute;margin-left:40px;margin-top:75px;cursor:pointer;">
            </div>
            <div class="follow">Follow us<br>
                <img src="<?php echo URLROOT; ?>/public/img/footer/fb.svg" style="width:40px;position:absolute;margin-left:10px;margin-top:20px;cursor:pointer;">
                <img src="<?php echo URLROOT; ?>/public/img/footer/insta.svg" style="width:40px;position:absolute;margin-left:70px;margin-top:20px;cursor:pointer;">
                <img src="<?php echo URLROOT; ?>/public/img/footer/twitter.svg" style="width:40px;position:absolute;margin-left:130px;margin-top:20px;cursor:pointer;">
            </div>
            <div class="contact">Contact us
                <div class="info">
                    <br>
                    <i class="fas fa-phone" style="font-size:18px;color:#b3b3b3;"><span style="font-family:poppins;font-weight:400;color:#b3b3b3;"> 070 4915685</span></i><br>
                    <i class="fas fa-envelope" style="font-size:18px;color:#b3b3b3;margin-top:15px;"><span style="font-family:poppins;font-weight:400;color:#b3b3b3;"> Flybuy19cse@gmail.com</span></i>
                </div>
            </div>
        </div>

    </footer>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://tympanus.net/Tutorials/RotatingImageSlider/js/jquery.transform-0.9.3.min_.js"></script>
    <script type="text/javascript" src="https://tympanus.net/Tutorials/RotatingImageSlider/js/jquery.mousewheel.js"></script>
    <script src="<?php echo URLROOT; ?>/public/javascript/aboutUs.js"></script>
    <script src="<?php echo URLROOT; ?>/public/javascript/aboutusSlide.js"></script>
</body>

</html>