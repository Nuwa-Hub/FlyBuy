<?php

class UserController extends Controller
{

    private $isValid = true;

    public function __construct()
    {
        $this->buyerModel = $this->model('Buyer');
        $this->sellerModel = $this->model('Seller');
        $this->productModel = $this->model('Product');
    }

    public function register()
    {

        if (isset($_POST['submitSignup'])) {

            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $userType = $_POST['userType'];

            if ($userType == 'buyer') {
                $this->userModel = $this->buyerModel;
            } else {
                $this->userModel = $this->sellerModel;
            }

            $emailExists = $this->userModel->checkEmailExistence($_POST['email']);

            $signupValidator = new SignupValidator($_POST, $emailExists, $userType);

            $data = $signupValidator->validateForm();

            foreach ($data['signupErrors'] as $field => $errorValue) {
                if ($errorValue != 'none' and $errorValue != '') {
                    $this->isValid = false;
                    break;
                }
            }

            if ($this->isValid) {
                //Register user from model function
                if ($this->userModel->register($data)) {

                    $additionalData  = ['vkey' => $data['vkey'], 'table' => $userType];
                    $email = $_POST['email'];

                    $path = URLROOT . '/PageController/emailVerified';
                    sendMail($email, 'signup', $additionalData, $path);
                    header('location: ' . URLROOT . '/PageController/verifyEmail/' . $userType . '/' . $data['vkey']);
                } else {
                    die('Something went wrong.');
                }
            } else {
                $this->view('pages/loginSignup', $data);
            }
        }
    }

    public function login()
    {

        if (isset($_POST['submitLogin'])) {

            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $userType = $_POST['submitLogin'];

            if ($userType == 'buyer') {
                $this->userModel = $this->buyerModel;
            } else {
                $this->userModel = $this->sellerModel;
            }

            $users = $this->userModel->findAllUsers();

            $loginValidator = new LoginValidator($_POST, $users, $userType);

            $data = $loginValidator->validateForm($userType);

            foreach ($data['loginErrors'] as $field => $errorValue) {
                if ($errorValue != 'none' and $errorValue != '') {
                    $this->isValid = false;
                    break;
                }
            }

            if ($this->isValid) {

                setcookie('user_login', $data['loginData']['email'], time() + 86400, "/");
                $id = $this->userModel->login($data);

                if ($userType === 'buyer') {
                    header('location: ' . URLROOT . '/PageController/buyerAccount/' . $id);
                } else {
                    header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
                }
            } else {
                $this->view('pages/loginSignup', $data);
            }
        }
    }

    /*
    common methods to edit user profile details
    */
    public function editProfile()
    {

        if (isset($_POST['seller_id'])) {
            $this->userModel = $this->sellerModel;
            $id = $_POST['seller_id'];
            $userType = 'seller';
        } else {
            $this->userModel = $this->buyerModel;
            $id = $_POST['buyer_id'];
            $userType = 'buyer';
        }

        $user = $this->userModel->findUserById($id);

        $editProfileValidator = new EditProfileValidator($_POST, $userType);

        $data = $editProfileValidator->validateForm();
        $data['user'] = $user;

        foreach ($data['editProfileErrors'] as $field => $errorValue) {
            if ($errorValue != 'none' and $errorValue != '') {
                $this->isValid = false;
                break;
            }
        }

        if ($this->isValid) {

            $data['editProfileData']['vkey'] = $user->vkey;
            $this->userModel->updateUserData($data['editProfileData']);

            if (!empty($data['editProfileData']['password'])) {
                $_POST['submitLogout'] = '';
                $this->logout();
            }
            else if ($userType === 'buyer') {
                header('location: ' . URLROOT . '/PageController/buyerAccount/' . $id);
            }
            else {
                header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
            }
        } else {

            if ($userType === 'buyer') {
                // $data['buyer_id'] = $id;
                // $this->view('pages/editBuyerAccount', $data);
            } else {
                $data['seller_id'] = $id;
                $this->view('pages/editSellerAccount', $data);
            }
        }
    }

    public function editProfilePicture(){

        if (isset($_POST['seller_id'])) {
            $this->userModel = $this->sellerModel;
            $id = $_POST['seller_id'];
        }
        else {
            $this->userModel = $this->buyerModel;
            $id = $_POST['buyer_id'];
        }

        $file = $_FILES['profilePic'];

        if($file['error'] === 0){

            $this->removeProfilePic($id, $this->userModel);
            $newImgName = $this->uploadProfilePicToServer($file);

            $this->userModel->updateProfilePicName($id, $newImgName);
        }

        if (isset($_POST['seller_id'])) {
            header('location: ' . URLROOT . '/PageController/editSellerAccount/' . $id);
        }
        else {
            // header('location: ' . URLROOT . '/PageController/editBuyerAccount/' . $id);
        }
    }

    public function removeProfilePic($id, $userModel){

        $imgName = $userModel->getProfilePicNameById($id)->profilePic;
        $defaultImg = "defaultProfilePic.png";
        
        if(strcmp($imgName, $defaultImg) !== 0){
            $imageDestination = '../public/img/uploads/profilePics/' . $imgName;
            unlink($imageDestination);
        }
    }

    public function uploadProfilePicToServer($file){

        $imgNewName = 'defaultProfilePic.png';

        if($file['error'] === 0){

            $tempExt = explode('.', $file['name']);
            $imgExt = strtolower(end($tempExt));

            $imgNewName = uniqid('', true) . '.' . $imgExt;
            $imgDestination = '../public/img/uploads/profilePics/' . $imgNewName;

            move_uploaded_file($file['tmp_name'], $imgDestination);
        }

        return $imgNewName;
    }

    public function checkout(){

        $buyer_id = $_POST['buy_id'];
        $cart = [];
        $order = [];

        foreach ($_SESSION['cartarr'] as $product) {

            $data = [
                'item_id'   => $product->item_id,
                'amount'      => $product->amount[0] - $product->amount[1],
            ];
            
            $seller_id = $product->seller_id;

            $this->productModel->reduceAmount($data);

            if (!isset($cart[$seller_id]['order_price'])) {
                $cart[$seller_id]['order_price'] = 0;
            }

            // $cart[$seller_id][$product->item_id] = $product->amount[1];
            $cart[$seller_id][$product->item_id] = array('itemName' => $product->itemName, 'price' => $product->price, 'cart_amount' => $product->amount[1]);
            $cart[$seller_id]['order_price'] += $product->price * $product->amount[1];
        }

        $this->buyerModel->saveCart($buyer_id, $cart);

        foreach ($cart as $seller_id => $order) {
            $this->sellerModel->saveNotification($buyer_id, $seller_id, $order);
        }

        $_SESSION['cartarray'] = $_SESSION['cartarr'];
        $_SESSION['cartarr'] = [];
    }

    public function getNotificationCount()
    {

        $id = $_POST['seller_id'];

        $rowCount =  $this->sellerModel->notificationCount($id);

        $data = [
            'rowCount' => $rowCount
        ];

        echo json_encode($data);
    }

    public function markNotificationAsRead()
    {

        $id = $_POST['notify_id'];

        $this->sellerModel->markNotificationById($id);
    }

    public function getProductSearchResult(){

        if (isset($_POST['seller_id'])) {

            $id = $_POST['seller_id'];

            $allSellerProducts = $this->sellerModel->findAllSellerProducts($id);
            echo json_encode($allSellerProducts);
        }
        else {

            $allProducts = $this->productModel->findAllProducts();
            foreach ($allProducts as $product) {
                $product->seller = $this->sellerModel->findUserById($product->seller_id);
            }
            echo json_encode($allProducts);
        }
    }

    public function logout()
    {

        if (isset($_POST['submitLogout'])) {

            if (isset($_COOKIE['user_login'])) {

                unset($_COOKIE['user_login']);
                setcookie('user_login', null, -1, '/');
            }

            header('location: ' . URLROOT . '/PageController/loginSignup');
        }
    }

    public function deleteUser(){

        $userType = $_POST['userType'];
        $id = $_POST['id'];

        if ($userType === 'seller') {
            $this->userModel = $this->sellerModel;
        }
        else {
            $this->userModel = $this->buyerModel;
        }

        $user = $this->userModel->findUserById($id);

        $deleteAccountValidator = new DeleteAccountValidator($_POST, $user);

        $data = $deleteAccountValidator->validateForm();

        foreach ($data['deleteAccountErrors'] as $field => $errorValue) {
            if ($errorValue != 'none' and $errorValue != '') {
                $this->isValid = false;
                break;
            }
        }

        if($this->isValid){
            
            $this->userModel->clearUserFields($id);

            unset($_COOKIE['user_login']);
            setcookie('user_login', null, -1, '/');
        }
        
        echo json_encode($data);
    }
}
