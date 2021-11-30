<?php 

class ProductController extends Controller{

    public function __construct(){}

    public function addItem(){
        // print_r($_POST);

        $contentType = trim($_SERVER["CONTENT_TYPE"] ?? '');

        if ($contentType !== "application/json"){
            die(json_encode([
                'value' => 0,
                'error' => 'Content-Type is not set as "application/json"',
                'data' => null,
            ]));
        }

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);

        if(! is_array($data)){          
            die(json_encode([
                'value' => 0,
                'error' => 'Received JSON is improperly formatted',
                'data' => null,
            ]));
        }

        print_r($data);

        // die(json_encode([
        //     'value' => 1,
        //     'error' => null,
        //     'data' => null,
        // ]));
    }

    public function editItem(){
        
        if(isset($_POST['submitEditItem'])){

            $this->seller = $this->model('Product');
            $this->seller->updateEachFeild($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }
}

?>