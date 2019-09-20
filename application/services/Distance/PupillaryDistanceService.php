<?php namespace Services\Distance;

use Contracts\Distance\DistanceInterface;
use Services\BaseService;

class PupillaryDistanceService extends BaseService implements DistanceInterface{
    
    protected $model;

    public function __construct($model) {
       $this->model = $model;
    }

    public function getPupillaryDistance() {
        return $this->model->all();
    }



}