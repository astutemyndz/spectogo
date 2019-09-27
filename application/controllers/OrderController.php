<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderController extends Common_Controller {
    private $hasCartData = false;
    private $order;
    private $orderAttributes;
    private $orderColors;
    private $orderLensTints;
    private $orderPrescription;
    private $orderPrescriptionDetails;
    private $orderPrescriptionPrism;
    private $cartData = array();
    function __construct() {
        parent::__construct();
        if($this->cart->contents()) {
            $this->hasCartData = true;
        }
        $this->getCartData();
    }
    public function getCartData() {
        if($this->hasCartData) {
            $this->cartData =  $this->cart->contents();
        }
        return $this->cartData;
    }
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }
    public function setOrderAttributes($orderAttributes) {
        $this->orderAttributes = $orderAttributes;
        return $this;
    }
    public function setOrderColors($orderColors) {
        $this->orderColors = $orderColors;
        return $this;
    }
    public function setOrderLensTints($orderLensTints) {
        $this->orderLensTints = $orderLensTints;
        return $this;
    }
    public function setOrderPrescription($orderPrescription) {
        $this->orderPrescription = $orderPrescription;
        return $this;
    }
    public function setOrderPrescriptionDetails($orderPrescriptionDetails) {
        $this->orderPrescriptionDetails = $orderPrescriptionDetails;
        return $this;
    }
    public function setOrderPrescriptionPrism($orderPrescriptionPrism) {
        $this->orderPrescriptionPrism = $orderPrescriptionPrism;
        return $this;
    }
    public function setOrderUser($user) {
        $this->user = $user;
        return $this;
    }
    public function setTransaction($transaction) {
        $this->transaction = $transaction;
    }
    public function saveOrderToDatabase() {
        if($this->isPost()){
            $this->setTransaction($this->request);
            if($this->cartData) {

            }
        }
    }
}
