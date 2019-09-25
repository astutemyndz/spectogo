<?php namespace Services\Accounts;

use Contracts\Accounts\AccountInterface;
use Services\BaseService;

class PrescriptionService extends BaseService{
    
    protected $model;
  
    protected $billingAddress;

    protected $id_users;
    protected $id_pupillary_distance;

    protected $prescription = array();
    public function __construct($model) {
       $this->model = $model;
    }

    public function save($attributes) {
        return $this->model->save($attributes);
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function prescriptionId() {
        return $this->model->lastInsertId();
    }

    public function setPrescription($prescription) {
        $this->prescription['prescription'] = $prescription;
        return $this;
    }
    public function setPrescriptionDetails($prescription) {
        $this->prescription['details'] = $prescription;
        return $this;
    }
    public function setPrescriptionPrism($prescription) {
        $this->prescription['prism'] = $prescription;
        return $this;
    }

    public function getPrescription() {
        return $this->prescription;
    }

    
}