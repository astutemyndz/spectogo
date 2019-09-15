<?php namespace Services\Products;

use Contracts\Products\ProductInterface;
use Services\BaseService;

class ProductService extends BaseService implements ProductInterface{
    
    protected $model;

    public function __construct($model) {
       $this->model = $model;
    }

    public function getProductDetails()
    {
        
    }

    public function getProducts() {
        return $this->model->all();
    }



}