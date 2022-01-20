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
            <li><a href="#">About us</a></li>
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

           <!-- /* about us*/ -->
           <div class="us">

<div class="contact-area">
  <div class="contact">
    <main>
      <section>
        <div class="content">
        <img class="team4" src="<?php echo URLROOT; ?>/public/img/admin4.jpeg" />

          <aside>
            <h1>Akash Tharuka</h1>
            <p>Hi, I'm Akash Tharuka and I'm a full stack developer.(190623V)</p>
          </aside>

          <button class="button1">
            <span>Contact Me</span>

            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
              <g class="nc-icon-wrapper" fill="#444444">
                <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
              </g>
            </svg>
          </button>
        </div>

        <div class="title1">
        
        </div>
      </section>


    </main>

    <nav class="nav1">
      <a href="#" class="gmail">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M16 3v10c0 .567-.433 1-1 1h-1V4.925L8 9.233 2 4.925V14H1c-.567 0-1-.433-1-1V3c0-.283.108-.533.287-.712C.467 2.107.718 2 1 2h.333L8 6.833 14.667 2H15c.283 0 .533.108.713.288.179.179.287.429.287.712z"
              fill-rule="evenodd" />
          </svg>
        </div>

        <div class="content">
          <h1>Email</h1>
          <span>akash.19@cse.mrt.ac.lk</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="facebook">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
            stroke-linejoin="round" stroke-miterlimit="1.414">
            <path
              d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.48-1.195 1.18v1.54h2.39l-.31 2.42h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0"
              fill-rule="nonzero" />
          </svg>
        </div>

        <div class="content">
          <h1>Facebook</h1>
          <span> Akash Tharuka</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="twitter">
        <div class="icon">
        <img src="https://img.icons8.com/color/48/000000/apple-phone.png"/>

        </div>

        <div class="content">
          <h1>Telephone Number</h1>
        <span>+94715694899</span>
        </div>

        <svg class="arrow" xmlns="<?php echo URLROOT; ?>/public/img/smartphone.png" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>
    </nav>
  </div>

</div>

<div class="contact-area">
  <div class="contact">
    <main>
      <section>
        <div class="content">
        <img class="team1" src="<?php echo URLROOT; ?>/public/img/admin1.jpg" />

          <aside>
            <h1>Nuwan Deshapriya</h1>
            <p>Hi, I'm Nuwan Deshapriya and I'm a full stack developer.(190458T)</p>
          </aside>

          <button class="button2">
            <span>Contact Me</span>

            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
              <g class="nc-icon-wrapper" fill="#444444">
                <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
              </g>
            </svg>
          </button>
        </div>

        <div class="title2">
        
        </div>
      </section>


    </main>

    <nav class="nav2">
      <a href="#" class="gmail">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M16 3v10c0 .567-.433 1-1 1h-1V4.925L8 9.233 2 4.925V14H1c-.567 0-1-.433-1-1V3c0-.283.108-.533.287-.712C.467 2.107.718 2 1 2h.333L8 6.833 14.667 2H15c.283 0 .533.108.713.288.179.179.287.429.287.712z"
              fill-rule="evenodd" />
          </svg>
        </div>

        <div class="content">
          <h1>Email</h1>
          <span>nuwanp.19@cse.mrt.ac.lk</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="facebook">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
            stroke-linejoin="round" stroke-miterlimit="1.414">
            <path
              d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.48-1.195 1.18v1.54h2.39l-.31 2.42h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0"
              fill-rule="nonzero" />
          </svg>
        </div>

        <div class="content">
          <h1>Facebook</h1>
          <span>Nuwan Deshapriya</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="twitter">
        <div class="icon">
        <img src="https://img.icons8.com/color/48/000000/apple-phone.png"/>
        </div>

        <div class="content">
          <h1>Telephone Number</h1>
          <span>+94775929879</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>
    </nav>
  </div>

</div>








<div class="contact-area">
  <div class="contact">
    <main>
      <section>
        <div class="content">
        <img class="team3" src="<?php echo URLROOT; ?>/public/img/admin3.jpeg" />


          <aside>
            <h1>Kalana Rubasinghe</h1>
            <p>Hi, I'm Kalana Rubasinghe and I'm a full stack developer.(190530H)</p>
          </aside>

          <button class="button3">
            <span>Contact Me</span>

            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
              <g class="nc-icon-wrapper" fill="#444444">
                <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
              </g>
            </svg>
          </button>
        </div>

        <div class="title3">
        
        </div>
      </section>


    </main>

    <nav class="nav3">
      <a href="#" class="gmail">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M16 3v10c0 .567-.433 1-1 1h-1V4.925L8 9.233 2 4.925V14H1c-.567 0-1-.433-1-1V3c0-.283.108-.533.287-.712C.467 2.107.718 2 1 2h.333L8 6.833 14.667 2H15c.283 0 .533.108.713.288.179.179.287.429.287.712z"
              fill-rule="evenodd" />
          </svg>
        </div>

        <div class="content">
          <h1>Email</h1>
          <span>kalana.19@cse.mrt.ac.lk</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="facebook">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
            stroke-linejoin="round" stroke-miterlimit="1.414">
            <path
              d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.48-1.195 1.18v1.54h2.39l-.31 2.42h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0"
              fill-rule="nonzero" />
          </svg>
        </div>

        <div class="content">
          <h1>Facebook</h1>
          <span>Kalana Rubasinghe</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="twitter">
        <div class="icon">
        <img src="https://img.icons8.com/color/48/000000/apple-phone.png"/>
        </div>

        <div class="content">
          <h1>Telephone Number</h1>
          <span>+94771993753</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>
    </nav>
  </div>

</div>




<div class="contact-area">
  <div class="contact">
    <main>
      <section>
        <div class="content">
        <img class="team2" src="<?php echo URLROOT; ?>/public/img/admin2.jpg" />

          <aside>
            <h1>Ransika Costa</h1>
            <p>Hi, I'm Ransika Costa and I'm a full stack developer.(190112E)</p>
          </aside>

          <button class="button4">
            <span>Contact Me</span>

            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
              <g class="nc-icon-wrapper" fill="#444444">
                <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path>
              </g>
            </svg>
          </button>
        </div>

        <div class="title4">
         
        </div>
      </section>


    </main>

    <nav class="nav4">
      <a href="#" class="gmail">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M16 3v10c0 .567-.433 1-1 1h-1V4.925L8 9.233 2 4.925V14H1c-.567 0-1-.433-1-1V3c0-.283.108-.533.287-.712C.467 2.107.718 2 1 2h.333L8 6.833 14.667 2H15c.283 0 .533.108.713.288.179.179.287.429.287.712z"
              fill-rule="evenodd" />
          </svg>
        </div>

        <div class="content">
          <h1>Email</h1>
          <span>rumal.19@cse.mrt.ac.lk</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="facebook">
        <div class="icon">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
            stroke-linejoin="round" stroke-miterlimit="1.414">
            <path
              d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.48-1.195 1.18v1.54h2.39l-.31 2.42h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0"
              fill-rule="nonzero" />
          </svg>
        </div>

        <div class="content">
          <h1>Facebook</h1>
          <span>Ransika Costa</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>

      <a href="#" class="twitter">
        <div class="icon">
        <img src="https://img.icons8.com/color/48/000000/apple-phone.png"/>
        </div>

        <div class="content">
          <h1>Telephone Number</h1>
          <span>+94704915685</span>
        </div>

        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
          <g class="nc-icon-wrapper" fill="#444444">
            <path d="M17.17 32.92l9.17-9.17-9.17-9.17L20 11.75l12 12-12 12z"></path>
          </g>
        </svg>
      </a>
    </nav>
  </div>

</div>

</div>

            <!-- /*end about us*/ -->
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