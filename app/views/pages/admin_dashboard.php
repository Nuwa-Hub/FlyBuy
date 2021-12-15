<?php
include '../database/db_connection.php';

session_start();


//fetch all products which not approved
$products = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM  products WHERE approve=0"), MYSQLI_ASSOC);


//fetch all buyers
$customers = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM  buyers"), MYSQLI_ASSOC);


//fetch all buyers
$sellers = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM  sellers"), MYSQLI_ASSOC);


//when submit button click
if (isset($_POST['accept'])) {
    print_r("dgf");
    $pid = $_POST['pid'];
    //update the approve column in product table
    $sql = "UPDATE products SET approve=1 WHERE item_id=$pid";

    mysqli_query($conn, $sql);

    //refresh the page
    header("Refresh:0");
}
//when desline button click
if (isset($_POST['decline'])) {
    $pid = $_POST['pid'];

    //delete product from product table
    $sql = "DELETE FROM  products WHERE item_id=$pid";
    mysqli_query($conn, $sql);
    //refresh the page
    header("Refresh:0");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_admin_dashbboard.css">

    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Admin Dashboard</title>
</head>

<body onload="rederect()">
    <!-- header -->
    <header id="header">
        <a href="#" class="logo">FlyBuy</a>
        <h3>Admins(Akash,Kala,Nuwan,Ransika)</h3>
        <div class="search-container">
            <input type="text" name="search" placeholder="Search..." class="search-input">
            <a href="#" class="search-btn">
                <i class="fas fa-search"></i>
            </a>
        </div>
        <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Sign out</a></li>
            <li onclick="currentSlide(5)"><a>New products<span id="cart-item" class="badge badge-danger"><?php echo sizeof($products) ?></span></a></li>

        </ul>
    </header>
    <!-- side bar -->
    <div class="page_container">
        <ul class="icon-container">
            <li onclick="currentSlide(1)"><a>Ratings</a></li>
            <li onclick="currentSlide(2)"><a>Revenue</a></li>
            <li onclick="currentSlide(3)"><a>Customers deatails</a></li>
            <li onclick="currentSlide(4)"><a>Sellers details</a></li>
            <li onclick="currentSlide(5)"><a>New products</a></li>
        </ul>
        <div class="s1">
            <img class="adminimg" src="../images/admin1.jpg" alt="profile picture">

            <img class="adminimg" src="../images/admin2.jpeg" alt="profile picture">
        </div>
        <div class="s2">
            <img class="adminimg" src="../images/admin3.jpeg" alt="profile picture">
            <img class="adminimg" src="../images/admin4.jpeg" alt="profile picture">
        </div>
    </div>
    <!-- slides menu -->
    <div class="slide-show">
        <div class="page_container popup-menu0 slides">

            <canvas id="cvs" width="700" height="300">
                [No canvas support]
            </canvas>
        </div>
        <div class="page_container popup-menu1 slides">
            <h1>dfsfdgsfdg</h1>
        </div>
        <div class="page_container popup-menu2 slides">

            <div class="scrollmenu">
                     <?php foreach ($customers as $customer) { ?>

                    <div class="item-container ">
                        <img src="../images/admin2.jpeg" alt="Avatar" class="uimage">
                        <div class="overlay ">
                            <h3 class="uname"><?php echo $customer['username'] ?></h3>
                            <h3 class="uemail">Email:<?php echo $customer['email'] ?></h3>
                            <h3 class="utel">tel No:<?php echo $customer['telNo'] ?></h3>
                            <h3 class="uaddress">Address:<?php echo $customer['address'] ?></h3>
                            <h3 class="uaddress">Rating</h3>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
        <div class="page_container popup-menu3 slides">
            <div class="scrollmenu">
                <?php foreach ($sellers as $seller) { ?>

                    <div class="item-container ">
                        <img src="../images/admin2.jpeg" alt="Avatar" class="uimage">
                        <div class="overlay ">
                            <h3 class="uname"><?php echo $seller['username'] ?></h3>
                            <h3 class="uemail">Email:<?php echo $seller['email'] ?></h3>
                            <h3 class="utel">tel No:<?php echo $seller['telNo'] ?></h3>
                            <h3 class="uaddress">Address:<?php echo $seller['Address'] ?></h3>
                            <h3 class="uaddress">Store NAme :<?php echo $seller['storeName'] ?></h3>
                            <h3 class="uaddress">Rating</h3>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
        <div class="page_container popup-menu4 slides" id="s4">

            <div class="item-bar">
                <?php foreach ($products as $product) { ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="pid" class="pid" value="<?php echo $product['item_id'] ?>">
                        <div class="item-container">
                            <div class="image-container">
                                <img onmouseover="popupmsg(this)" onmouseout="clearpopup(this)" src="../images/../images/admin2.jpeg" alt="">
                                <div class="popup-page1" id="popup-page">
                                    <h3 class="pname"><?php echo $product['itemName'] ?></h3>
                                    <h3 class="pdes">:<?php echo $product['description'] ?></h3>
                                    <h3 class="pamount">Amount :<?php echo $product['amount'] ?></h3>
                                    <h3 class="pprice">price :<?php echo $product['price'] ?>/=</h3>
                                    <h3 class="pstore">store name</h3>
                                </div>
                                <div class="popup-page2" id="popup-page">
                                    <img src="../images/admin2.jpeg" alt="">
                                    <img src="" alt=" ">
                                </div>
                            </div>
                            <div class="des-container">
                                <h2 class="itemname"><?php echo $product['itemName'] ?></h2>
                                <h2 class="item-price">Price : <?php echo $product['price'] ?>/=</h2>
                                <ul>
                                    <button onclick="setbtnclick()" class="btn btn-info btn-block addItemBtn add-cart-btn" name="accept">
                                        Accept
                                    </button>
                                    <button onclick="setbtnclick()" class="btn btn-info btn-block addItemBtn add-cart-btn" name="decline">
                                        Decline
                                    </button>
                                </ul>

                            </div>
                        </div>
                    </form>

                <?php } ?>
            </div>

        </div>
    </div>


    <!-- background animation 
    <section>
        </div>
        <div class=" leaf ">
            <div> <img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Transparent-Autumn-Leaves-Falling-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png " height="75px " width="75px "></div>
            <div><img src="http://cdn.clipart-db.ru/rastr/autumn_leaves_025.png " height="75px " width="75px "></div>
        </div>
        <div class="leaf leaf1 ">
            <div> <img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Transparent-Autumn-Leaves-Falling-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png " height="75px " width="75px "></div>
            <div><img src="http://cdn.clipart-db.ru/rastr/autumn_leaves_025.png " height="75px " width="75px "></div>
        </div>
        <div class="leaf leaf2 ">
            <div> <img src="http://www.pngmart.com/files/1/Fall-Autumn-Leaves-Transparent-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Pictures-Collage-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Autumn-Fall-Leaves-Clip-Art-PNG.png " height="75px " width="75px "></img>
            </div>
            <div><img src="http://www.pngmart.com/files/1/Green-Leaves-PNG-File.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Transparent-Autumn-Leaves-Falling-PNG.png " height="75px " width="75px "></img>
            </div>
            <div> <img src="http://www.pngmart.com/files/1/Realistic-Autumn-Fall-Leaves-PNG.png " height="75px " width="75px "></div>
            <div><img src="http://cdn.clipart-db.ru/rastr/autumn_leaves_025.png " height="75px " width="75px "></div>
        </div>
    </section>
-->
    <script src="../javaScript/RGraph.common.core.js"></script>
    <script src="../javaScript/RGraph.line.js"></script>
    <script src=" ../javaScript/graph.js "></script>
    <script src=" ../javaScript/admin_dashboard.js "></script>
</body>

</html>