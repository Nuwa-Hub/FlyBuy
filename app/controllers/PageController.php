<?php

class PageController extends Controller{

    public function __construct(){
        $this->productModel = $this->model('Product');
        $this->buyerModel = $this->model('Buyer');
        $this->sellerModel = $this->model('Seller');
    }

    public function index(){
        
        $allProducts = $this->productModel->findAllProducts();

        $data = [
            'products' => $allProducts
        ];

        $this->view('pages/homepage', $data);
    }

    public function loginSignup(){
        $this->view('pages/loginSignup');
    }

    public function buyerAccount($id){

        $data = [
            'buyer_id' => $id,
            'user' => $this->buyerModel->findUserById($id),
            'products' => $this->buyerModel->getAllProducts($id)
        ];
        
        if(!isset($_COOKIE['user_login'])){
            header('location: ' . URLROOT . '/PageController/loginSignup');
        }
        else{
            $this->view('pages/buyerAccount', $data);
        }
    }

    public function sellerAccount($id){

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id),
            'products' => $this->sellerModel->findAllSellerProducts($id)
        ];
        
        if(!isset($_COOKIE['user_login'])){
            header('location: ' . URLROOT . '/PageController/loginSignup');
        }
        else{
            $this->view('pages/sellerAccount', $data);
        }
    }

    public function editSellerAccount($id){

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id)
        ];
        
        $this->view('pages/editSellerAccount', $data);
    }
    
    public function verifyEmail($userType, $vkey){

        if ($userType == 'buyer'){
            $user = $this->buyerModel->findUserByVKey($vkey);
        }
        else{
            $user = $this->sellerModel->findUserByVKey($vkey);
        }

        if (isset($_POST['sendAgainLink'])){

            $additionalData  = ['vkey' => $vkey, 'table' => $userType];
            $email = $user->email;
            $path = URLROOT . "/PageController/verifyEmail/";
            $type = 'signup';

            sendMail($email, $type, $additionalData, $path);
            header('location: ' . URLROOT . '/PageController/verifyEmail/' . $userType . '/' . $vkey);
        }

        $this->view('pages/verifyEmail');
    }

    public function emailVerified($userType, $vkey){

        if ($userType == 'buyer'){
            $this->buyerModel->verifyUser($vkey);
        }
        else{
            $this->sellerModel->verifyUser($vkey);
        }

        $this->view('pages/emailVerified');
    }

    public function forgotPassword(){

        $data = [
            'className' => '',
            'errorMsg'  => '',
            'value'     => ''
        ];

        $vkeyBuyer = '';
        $vkeySeller = '';

        if (isset($_POST['submitForgotPsw'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $data['value'] = $email;

            if($email){
                $buyer = $this->buyerModel->findUserByEmail($email);
                $seller = $this->sellerModel->findUserByEmail($email);

                ($buyer) ? $vkeyBuyer = $buyer->vkey : $vkeyBuyer = '';
                ($seller) ? $vkeySeller = $seller->vkey : $vkeySeller = '';

                $type = 'forgotPsw';

                $additionalData = [
                    'vkeyBuyer'     => $vkeyBuyer,
                    'vkeySeller'    => $vkeySeller,
                    'msg'           => ''
                ];

                $path = URLROOT . "/PageController/changePassword";

                $data['className'] = 'success';

                if (empty($vkeyBuyer) and empty($vkeySeller)){
                    $data['className'] = 'error';
                    $data['errorMsg'] = 'Your email is not registered. Please check again';
                }
                else if (empty($vkeyBuyer)){
                    $additionalData['msg'] = 'Your email is registered as a seller. Please check your inbox and verify it is you';
                }
                else if (empty($vkeySeller)){
                    $additionalData['msg'] = 'Your email is registered as a buyer. Please check your inbox and verify it is you';
                }
                else{
                    $additionalData['msg'] = 'Your email is registered as a buyer and a seller. Please check your inbox and verify it is you';
                }

                if ($data['className'] == 'success'){
                    sendMail($email, $type, $additionalData, $path);
                    header('location: ' . URLROOT . '/PageController/loginSignup');
                }

            }
            else{
                $data['className'] = 'error';
                $data['errorMsg'] = 'email cannot be empty';
            }
        }

        $this->view('pages/forgotPsw', $data);
    }

    public function changePassword($vkeyBuyer, $vkeySeller){

        $data = [
            'vkeyBuyer' => $vkeyBuyer,
            'vkeySeller' => $vkeySeller
        ];

        if (isset($_POST['submitChangePsw'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $password = $_POST['password'];
            $confirmPsw = $_POST['confirmPsw'];

            // need to validate passwords before updating
            $changePswValidator = new changePswValidator($password, $confirmPsw, $vkeyBuyer, $vkeySeller);
            $data = $changePswValidator->validateForm();

            if (! empty($vkeyBuyer)){
                $dataToUpdate['password'] = $password;
                $dataToUpdate['vkey'] = $vkeyBuyer;
                $this->buyerModel->updateUserData($dataToUpdate);
            }
            if (! empty($vkeySeller)){
                $dataToUpdate['password'] = $password;
                $dataToUpdate['vkey'] = $vkeySeller;
                $this->buyerModel->updateUserData($dataToUpdate);
            }

        }

        $this->view('pages/changePsw', $data);

        
    }
}

?>