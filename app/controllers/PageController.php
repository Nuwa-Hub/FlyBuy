<?php

class PageController extends Controller
{

    public function __construct()
    {

        $this->productModel = $this->model('Product');
        $this->buyerModel = $this->model('Buyer');
        $this->sellerModel = $this->model('Seller');
    }

    public function index()
    {

        $products = $this->castToArray($this->productModel->findAllProducts());

        usort($products, function ($a, $b) {

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);

            return $t2 - $t1;
        });

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['seller'] = $this->sellerModel->findUserById($products[$i]['seller_id']);
        }

        $products = $this->castToObj($products);

        $data = [
            'products' => $products
        ];

        $this->view('pages/homepage', $data);
    }

    public function loginSignup()
    {
        $this->view('pages/loginSignup');
    }

    public function buyerAccount($id)
    {

        if (!isset($_SESSION['cartarr'])) {
            $_SESSION['cartarr'] = array();
        }

        $products = $this->castToArray($this->productModel->findAllProducts());

        usort($products, function ($a, $b) {

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);

            return $t2 - $t1;
        });

        for ($i = 0; $i < count($products); $i++) {
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
        } else {
            $this->view('pages/buyerAccount', $data);
        }
    }

    public function sellerAccount($id)
    {

        $products = $this->castToArray($this->sellerModel->findAllSellerProducts($id));

        usort($products, function ($a, $b) {

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
        } else {
            $this->view('pages/sellerAccount', $data);
        }
    }

    public function getSalesHistory($id)
    {

        $result = $this->sellerModel->getSalesHistoryById($id);

        $salesByYear = $result['salesByYear'];
        $salesByYearMonth = $result['salesByYearMonth'];

        foreach ($salesByYear as $yearSale) {

            $yearSale->salesByMonth = array(
                'January' => array('month_order_count' => 0, 'month_income' => 0),
                'February' => array('month_order_count' => 0, 'month_income' => 0),
                'March' => array('month_order_count' => 0, 'month_income' => 0),
                'April' => array('month_order_count' => 0, 'month_income' => 0),
                'May' => array('month_order_count' => 0, 'month_income' => 0),
                'June' => array('month_order_count' => 0, 'month_income' => 0),
                'July' => array('month_order_count' => 0, 'month_income' => 0),
                'August' => array('month_order_count' => 0, 'month_income' => 0),
                'September' => array('month_order_count' => 0, 'month_income' => 0),
                'October' => array('month_order_count' => 0, 'month_income' => 0),
                'November' => array('month_order_count' => 0, 'month_income' => 0),
                'December' => array('month_order_count' => 0, 'month_income' => 0)
            );

            foreach ($salesByYearMonth as $yearMonthSale) {

                $splited_year_month = explode('-', $yearMonthSale->ym);

                if ($splited_year_month[0] === $yearSale->yr) {
                    $yearSale->salesByMonth[$splited_year_month[1]] = array('month_order_count' => $yearMonthSale->month_order_count, 'month_income' => $yearMonthSale->month_income);
                }
            }
        }

        // return $salesByYear;
        echo json_encode($salesByYear);
    }


    public function editSellerAccount($id)
    {

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id)
        ];

        if (!isset($_COOKIE['user_login'])) {
            header('location: ' . URLROOT . '/PageController/loginSignup');
        } else {
            $this->view('pages/editSellerAccount', $data);
        }
    }
    public function editBuyerAccount($id)
    {

        $data = [
            'buyer_id' => $id,
            'user' => $this->buyerModel->findUserById($id)
        ];

        if (!isset($_COOKIE['user_login'])) {
            header('location: ' . URLROOT . '/PageController/loginSignup');
        } else {
            $this->view('pages/editBuyerAccount', $data);
        }
    }

    public function viewAllNotifications($id, $type = 'all')
    {

        $notifications = $this->castToArray($this->sellerModel->getAllNotificationsById($id, $type));

        // can be used to sort according to the timestamp
        usort($notifications, function ($a, $b) {

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);

            return $t2 - $t1;
        });

        $notifications = $this->castToObj($notifications);

        //find and add for each notification
        foreach ($notifications as $key => $note) {

            $notifications[$key]->item_list = unserialize($notifications[$key]->item_list);
            $notifications[$key]->buyer = $this->buyerModel->findUserById($notifications[$key]->buy_id);
        }

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id),
            'notifications' => $notifications,
            'type' => $type
        ];

        if (!isset($_COOKIE['user_login'])) {
            header('location: ' . URLROOT . '/PageController/loginSignup');
        } else {
            $this->view('pages/notification', $data);
        }
    }

    public function verifyEmail($userType, $vkey)
    {

        if ($userType == 'buyer') {
            $user = $this->buyerModel->findUserByVKey($vkey);
        } else {
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

    public function emailVerified($userType, $vkey)
    {

        if ($userType == 'buyer') {
            $this->buyerModel->verifyUser($vkey);
        } else {
            $this->sellerModel->verifyUser($vkey);
        }

        $this->view('pages/emailVerified');
    }

    public function forgotPassword()
    {

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

    public function changePassword($vkeyBuyer, $vkeySeller)
    {

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

    public function shoppingCart($id)
    {

        $data = [
            'buyer_id' => $id,
        ];

        $this->view('pages/shoppingCart', $data);
    }

    public function downloadPdf($id)
    {
        $custmor = $this->buyerModel->findUserById($id);
        $customerAddress = $custmor->address;
        $addr = explode(",", $customerAddress);

        $pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->SetTextColor(255, 255, 255);
        // start a new page
        $pdf->AddPage();

        // date and invoice no
        $currentDate = new DateTime();

        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);


        $pdf->writeHTML(" <h3>Date : " . $currentDate->format('Y-m-d') . "</h3>");
        $pdf->writeHTML("<b>INVOICE#".$_SESSION['last_id']."</b>");
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // logo
        $pdf->Image('logo.png', 10, 3, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $pdf->writeHTML('<img src="logo.png" width=10px hieght=10px>');
        $pdf->Image('logo.jpg', 500);
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // bill to
        $pdf->writeHTML("<b>BILL TO:</b>", true, false, false, false, 'R');
        $pdf->writeHTML($addr[0], true, false, false, false, 'R');
        $pdf->writeHTML($addr[1], true, false, false, false, 'R');
        $pdf->writeHTML($addr[2], true, false, false, false, 'R');
        $pdf->writeHTML($addr[3], true, false, false, false, 'R');
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

        // invoice table starts here
        $header = array('DESCRIPTION', 'UNITS', 'RATE $', 'AMOUNT');
        $data = array();
        foreach ($_SESSION['cartarray'] as $product) {
            array_push($data, array($product->itemName, $product->amount[1], $product->price, ($product->price) * ($product->amount[1])));
        }
        $pdf->printTable($header, $data);
        $pdf->Ln();

        // comments
        $pdf->SetFont('', '', 12);
        $pdf->writeHTML("<b>OTHER COMMENTS:</b>");
        $pdf->writeHTML("Method of payment: <i>CASH PAYMENT</i>");
        $pdf->writeHTML("");
        $pdf->Write(0, "\n\n\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTML("If you have any questions about this invoice, please contact:", true, false, false, false, 'C');
        $pdf->writeHTML("cosmosflybuy@gmail.com", true, false, false, false, 'C');

        // new style
        $style = array(
            'border' => 2,
            'padding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => array(255, 255, 255)
        );
      
        // QRCODE,H : QR-CODE Best error correction
        $pdf->write2DBarcode($_SESSION['last_id'].$_SESSION['buyer_id'], 'QRCODE,H', 80, 210, 50, 50, $style, 'N');
      
        session_unset();
        session_destroy();
        // save pdf file
        ob_end_clean();
        $pdf->Output(__DIR__ . '/invoice#13.pdf', 'D');
        // echo 'location.reload(true)';

    }

    public function castToArray($arr)
    {

        $casted_arr = [];

        foreach ($arr as $i => $obj) {
            $casted_arr[$i] = (array)$obj;
        }

        return $casted_arr;
    }

    public function castToObj($arr)
    {

        $casted_arr = [];

        foreach ($arr as $i => $obj) {
            $casted_arr[$i] = (object)$obj;
        }

        return $casted_arr;
    }

    /*buyerinfo */
    public function buyerInfo($id)
    {
        // $products = $this->castToArray($this->productModel->findAllProducts());

        // usort($products, function ($a, $b) {

        //     $t1 = strtotime($a['created_at']);
        //     $t2 = strtotime($b['created_at']);

        //     return $t2 - $t1;
        // });

        // for ($i = 0; $i < count($products); $i++) {
        //     $products[$i]['seller'] = $this->sellerModel->findUserById($products[$i]['seller_id']);
        // }

        // $products = $this->castToObj($products);

        $carts = $this->castToArray($this->buyerModel->getAllCartsById($id));

        // can be used to sort according to the timestamp
        usort($carts, function ($a, $b) {

            $t1 = strtotime($a['created_at']);
            $t2 = strtotime($b['created_at']);

            return $t2 - $t1;
        });

        $carts = $this->castToObj($carts);
        $cart_list = array();

        foreach ($carts as $oneCart) {

            $oneCart->item_list = unserialize($oneCart->cart);
            unset($oneCart->cart);

            $cart_price = 0;
            $cart_details = array();
            $item_list = array();

            foreach ($oneCart->item_list as $seller_item_list) {

                $cart_price += $seller_item_list['order_price'];
                unset($seller_item_list['order_price']);

                foreach ($seller_item_list as $item) {
                    array_push($item_list, $item);
                }
            }

            $cart_details['item_list'] = $item_list;
            $cart_details['cart_id'] = $oneCart->cart_id;
            $cart_details['created_at'] = $oneCart->created_at;
            $cart_details['cart_price'] = $cart_price;

            array_push($cart_list, $cart_details);
        }

        $data = [
            'buyer_id' => $id,
            'user' => $this->buyerModel->findUserById($id),
            'cart_list' => $cart_list
        ];

        $this->view('pages/buyerInfo', $data);
    }
}
