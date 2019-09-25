<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Models\Accounts\Address;
use Models\Users\UserModel;
use Models\Accounts\BillingAddressModel;
use Models\Accounts\ShippingAddressModel;
use Models\Accounts\OptionalDeliveryAddressModel;
use Models\Accounts\PrescriptionModel;
use Models\Accounts\ReviewModel;
use Models\Accounts\OrderModel;
use Services\Accounts\AccountService;
use Services\Users\UserService;


class AccountController extends Common_Controller {
    protected $AccountService;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        
        
    }
    public function profile() {

    }
    public function updateProfile()
    {
       if($this->isAjaxRequest()) {

           $this->setRequest($_REQUEST);

           $user = new UserService(new UserModel());

           if(isset($this->request['title']) || !empty($this->request['title'])) {
                $user->setTitle($this->request['title']);
           }
           if(isset($this->request['firstName']) || !empty($this->request['firstName'])) {
                $user->setFirstName($this->request['firstName']);
           }
           if(isset($this->request['lastName']) || !empty($this->request['lastName'])) {
                $user->setLastName($this->request['lastName']);
           }
           if(isset($this->request['phone']) || !empty($this->request['phone'])) {
                $user->setPhone($this->request['phone']);
           }
           if(isset($this->request['email']) || !empty($this->request['email'])) {
                $user->setEmail($this->request['email']);
           }
        // update user details           
           $user->update($user->getAttributes());
           // ############################## Billing Address #########################
            $billingAddress = new Address();

            if(isset($this->request['address1']) || !empty($this->request['address1'])) {
                $billingAddress->setLine1($this->request['address1']);
            }

            if(isset($this->request['address2']) || !empty($this->request['address2'])) {
                $billingAddress->setLine2($this->request['address2']);
            }

            if(isset($this->request['countryCode']) || !empty($this->request['countryCode'])) {
                $billingAddress->setCountryCode($this->request['countryCode']);
            }
            
            if(isset($this->request['state']) || !empty($this->request['state'])) {
                $billingAddress->setState($this->request['state']);
            }
            if(isset($this->request['city']) || !empty($this->request['city'])) {
                $billingAddress->setCity($this->request['city']);
            }
            if(isset($this->request['postalCode']) || !empty($this->request['postalCode'])) {
                $billingAddress->setPostalCode($this->request['postalCode']);
            }

            // ############################## Shipping Address #########################
            $shippingAddress = new Address();

            if(isset($this->request['address1']) || !empty($this->request['address1'])) {
                $shippingAddress->setLine1($this->request['address1']);
            }

            if(isset($this->request['address2']) || !empty($this->request['address2'])) {
                $shippingAddress->setLine2($this->request['address2']);
            }

            if(isset($this->request['countryCode']) || !empty($this->request['countryCode'])) {
                $shippingAddress->setCountryCode($this->request['countryCode']);
            }
            
            if(isset($this->request['state']) || !empty($this->request['state'])) {
                $shippingAddress->setState($this->request['state']);
            }
            if(isset($this->request['city']) || !empty($this->request['city'])) {
                $shippingAddress->setCity($this->request['city']);
            }
            if(isset($this->request['postalCode']) || !empty($this->request['postalCode'])) {
                $billingAddress->setPostalCode($this->request['postalCode']);
            }

           $accountBillingAddressService = new AccountService(new BillingAddressModel());
           $accountShippingAddressService = new AccountService(new ShippingAddressModel());

           // update billing address
           $accountBillingAddressService->setBillingAddress($billingAddress);
           $accountBillingAddressService->updateProfile($billingAddress);
           
            // update shipping address
           $accountShippingAddressService->setBillingAddress($shippingAddress);
           $accountBillingAddressService->updateProfile($shippingAddress);

       }
    }
    

    
        
}
  
	
    


