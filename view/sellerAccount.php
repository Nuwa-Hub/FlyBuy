<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" 
        crossorigin="anonymous" 
    />
    
    <link rel="stylesheet" href="../css/styles_sellerAccount.css">
    <link rel="stylesheet" href="../css/styles_popup.css">
    <title>FlyBuy | Profile</title>
</head>
<body>

    <main>
        <nav>
            <a href="#" class="home">Home</a>
            <a href="#" class="notification">Notification</a>
            <a href="#" class="logout">Logout</a>
        </nav>

        <aside>
            <div class="header">
                <h3>Account Details</h3>
                <a href="#" class="user-edit-icon"><i class="fas fa-user-edit"></i></a>
            </div>
            <div class="img-div">
                <img src="../resources/user.png" alt="profile picture">
                <!-- <a href="#" class="edit-icon"><i class="fas fa-pen"></i></a> -->
            </div>
            <div class="store">COSMOS</div>
            <div class="name">akash tharuka</div>
            <div class="email">akash_tharuka@yahoo.</div>
            <div class="contact">071-569-4899</div>
            <div class="location">
                <div class="address-content">
                    <section class="street-no">No. 221/B</section>
                    <section class="street">Baker Street</section>
                    <section class="city">London</section>
                </div>
            </div>
        </aside>

        <section class="control-section">
            <a class="create-list" onclick="toggleDisplay()">New Item+</a>
            <div class="search-main">
                <div class="search-box-main">
                    <input class="search-txt-main" type="text" placeholder="search here...">
                    <a class="search-btn-main" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="item-container">item-container</section>

        <footer>footer</footer>
    </main>

    <div class="popup-window">

        <div class="overlay"></div>

        <div class="content">

            <div class="closeBtn" onclick="toggleDisplay()">&times;</div>

            <h1 class="title">Create List</h1>

            <div class="items">

            </div>

            <form class="item-form">
                <div class="input-field">
                    <i class="fas fa-archive"></i>
                    <input name="itemName" type="text" placeholder="Item Name" class="itemName">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error Message</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field">
                    <i class="fas fa-sort-numeric-up-alt"></i>
                    <input name="amount" type="number" placeholder="Amount" class="amount">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error Message</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field">
                    <i class="fas fa-dollar-sign"></i>
                    <input name="price" type="text" placeholder="Price" class="price">
                    <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error Message</small>
                    </i>
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="input-field">
                    <i class="fas fa-file-alt"></i>
                    <input name="description" type="text" placeholder="Description" class="description">
                    <!-- <i class="fas fa-exclamation-circle tooltip">
                        <small class="tooltip-text">Error Message</small>
                    </i> -->
                    <i class="fas fa-check-circle"></i>
                </div>

            </form>

            <button type="button" class="add-item btn">Add</button>
            <!-- <button type="button" class="submit btn">Submit</button> -->

        </div>

    </div>
    
</body>

<script>
    function toggleDisplay(){
        let popupWindow = document.querySelector('.popup-window');
        popupWindow.classList.toggle('active');
    }
</script>

</html>