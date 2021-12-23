<?php 

class ModelFactory{

    //load the model
    public function getModel($model){

        //require model file
        require_once '../app/models/' . $model . '.php';

        return $model::getInstance();

        // switch ($model) {
        //     case 'Buyer':
        //         return Buyer::getBuyer();

        //     case 'Seller':
        //         return Seller::getSeller();

        //     case 'Product':
        //         return Product::getProduct();
            
        //     default:
        //         break;
        // }

        //instantiate model
        // return new $model();
    }
}

?>