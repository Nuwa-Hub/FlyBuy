<?php

class PageController extends Controller{

    public function __construct(){

        $this->productModel = $this->model('Product');
        $this->buyerModel = $this->model('Buyer');
        $this->sellerModel = $this->model('Seller');
    }

    public function index(){

        $products = $this->castToArray($this->productModel->findAllProducts());

        usort($products, function($a, $b){

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);
            
            return $t2 - $t1;
        });

        for($i = 0; $i < count($products); $i++){
            $products[$i]['seller'] = $this->sellerModel->findUserById($products[$i]['seller_id']);
        }

        $products = $this->castToObj($products);

        $data = [
            'products' => $products
        ];

        $this->view('pages/homepage', $data);
    }

    public function loginSignup(){
        $this->view('pages/loginSignup');
    }

    public function buyerAccount($id){

        if (!isset($_SESSION['cartarr'])) {
            $_SESSION['cartarr'] = array();
        }

        $products = $this->castToArray($this->productModel->findAllProducts());

        usort($products, function($a, $b){

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);
            
            return $t2 - $t1;
        });

        for($i = 0; $i < count($products); $i++){
            $products[$i]['seller'] = $this->sellerModel->findUserById($products[$i]['seller_id']);
        }

        $products = $this->castToObj($products);

        $data = [
            'buyer_id' => $id,
            'user' => $this->buyerModel->findUserById($id),
            'products' => $products
        ];

        if (!isset($_COOKIE['user_login'])) {
            header('location: ' . URLROOT . '/PageController/loginSignup');
        }
        else {
            $this->view('pages/buyerAccount', $data);
        }
    }

    public function sellerAccount($id){

        $products = $this->castToArray($this->sellerModel->findAllSellerProducts($id));

        usort($products, function($a, $b){

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);
            
            return $t2 - $t1;
        });

        $products = $this->castToObj($products);

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id),
            'products' => $products
        ];

        if (!isset($_COOKIE['user_login'])) {
            header('location: ' . URLROOT . '/PageController/loginSignup');
        }
        else {
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

        if ($userType == 'buyer') {
            $user = $this->buyerModel->findUserByVKey($vkey);
        } 
        else {
            $user = $this->sellerModel->findUserByVKey($vkey);
        }

        if (isset($_POST['sendAgainLink'])) {

            $additionalData  = ['vkey' => $vkey, 'table' => $userType];
            $email = $user->email;
            $path = URLROOT . "/PageController/emailVerified";
            $type = 'signup';

            sendMail($email, $type, $additionalData, $path);
            header('location: ' . URLROOT . '/PageController/verifyEmail/' . $userType . '/' . $vkey);
        }

        $this->view('pages/verifyEmail');
    }

    public function emailVerified($userType, $vkey){

        if ($userType == 'buyer') {
            $this->buyerModel->verifyUser($vkey);
        }
        else {
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

        if (isset($_POST['submitForgotPsw'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $data['value'] = $email;

            if ($email) {
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

                if (empty($vkeyBuyer) and empty($vkeySeller)) {
                    $data['className'] = 'error';
                    $data['errorMsg'] = 'Your email is not registered. Please check again';
                } else if (empty($vkeyBuyer)) {
                    $additionalData['msg'] = 'Your email is registered as a seller. Please check your inbox and verify it is you';
                } else if (empty($vkeySeller)) {
                    $additionalData['msg'] = 'Your email is registered as a buyer. Please check your inbox and verify it is you';
                } else {
                    $additionalData['msg'] = 'Your email is registered as a buyer and a seller. Please check your inbox and verify it is you';
                }

                if ($data['className'] == 'success') {
                    sendMail($email, $type, $additionalData, $path);
                    header('location: ' . URLROOT . '/PageController/loginSignup');
                }
            } else {
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

        if (isset($_POST['submitChangePsw'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $password = $_POST['password'];
            $confirmPsw = $_POST['confirmPsw'];

            // need to validate passwords before updating
            $changePswValidator = new changePswValidator($password, $confirmPsw, $vkeyBuyer, $vkeySeller);
            $data = $changePswValidator->validateForm();

            if (!empty($vkeyBuyer)) {
                $dataToUpdate['password'] = $password;
                $dataToUpdate['vkey'] = $vkeyBuyer;
                $this->buyerModel->updateUserData($dataToUpdate);
            }

            if (!empty($vkeySeller)) {
                $dataToUpdate['password'] = $password;
                $dataToUpdate['vkey'] = $vkeySeller;
                $this->buyerModel->updateUserData($dataToUpdate);
            }
        }

        $this->view('pages/changePsw', $data);
    }

    public function shoppingCart($id){

        $data = [
            'buyer_id' => $id,
        ];
        $this->view('pages/shoppingCart', $data);
    }
     
     public function downloadPdf(){
      
        $pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 12, '', true);

        // start a new page
        $pdf->AddPage();
        $pdf->writeHTML('<img src="logo.png" width=10px hieght=10px>');
        // date and invoice no
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTML("<b>DATE:</b> 01/01/2021");
        $pdf->writeHTML("<b>INVOICE#</b>12");
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // address
        $pdf->writeHTML("84 Norton Street,");
        $pdf->writeHTML("NORMANHURST,");
        $pdf->writeHTML("New South Wales, 2076");
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // bill to
        $pdf->writeHTML("<b>BILL TO:</b>", true, false, false, false, 'R');
        $pdf->writeHTML("22 South Molle Boulevard,", true, false, false, false, 'R');
        $pdf->writeHTML("KOOROOMOOL,", true, false, false, false, 'R');
        $pdf->writeHTML("Queensland, 4854", true, false, false, false, 'R');
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // invoice table starts here
        $header = array('DESCRIPTION', 'UNITS', 'RATE $', 'AMOUNT');
        $data = array(
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #1', '1', '100', '100'),
            array('Item #2', '2', '200', '400')

        );
        $pdf->printTable($header, $data);
        $pdf->Ln();

        // comments
        $pdf->SetFont('', '', 12);
        $pdf->writeHTML("<b>OTHER COMMENTS:</b>");
        $pdf->writeHTML("Method of payment: <i>PAYPAL</i>");
        $pdf->writeHTML("PayPal ID: <i>katie@paypal.com");
        $pdf->Write(0, "\n\n\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTML("If you have any questions about this invoice, please contact:", true, false, false, false, 'C');
        $pdf->writeHTML("Katie A Falk, (07) 4050 2235, katie@sks.com", true, false, false, false, 'C');

        // save pdf file
        $pdf->Output(__DIR__ . '/invoice#13.pdf', 'I');
    }

    public function castToArray($arr){

        $casted_arr = [];

        foreach ($arr as $i => $obj) {
            $casted_arr[$i] = (array)$obj;
        }

        return $casted_arr;
    }

    public function castToObj($arr){

        $casted_arr = [];

        foreach ($arr as $i => $obj) {
            $casted_arr[$i] = (object)$obj;
        }

        return $casted_arr;
    }

    public function viewNotification($id){
        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id)
        ];

        $this->view('pages/notification', $data);
    }
}
