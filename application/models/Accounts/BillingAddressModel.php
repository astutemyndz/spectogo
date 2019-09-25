<?php 
namespace Models\Accounts;
use Illuminate\Database\Eloquent\Model;

class BillingAddressModel extends Model{

    protected $table = 'billing_address';
    /**
     * Default shipping address of the Payer.
     * @deprecated Not publicly available
     * @param bool $default_address
     * 
     * @return $this
     */
    public function setDefaultAddress($default_address)
    {
        $this->default_address = $default_address;
        return $this;
    }

    /**
     * Default shipping address of the Payer.
     * @deprecated Not publicly available
     * @return bool
     */
    public function getDefaultAddress()
    {
        return $this->default_address;
    }

  

    /**
     * The invoice recipient email address. Maximum length is 260 characters.
     *
     * @param string $email
     * 
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * The invoice recipient email address. Maximum length is 260 characters.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * The invoice recipient first name. Maximum length is 30 characters.
     *
     * @param string $first_name
     * 
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * The invoice recipient first name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * The invoice recipient last name. Maximum length is 30 characters.
     *
     * @param string $last_name
     * 
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * The invoice recipient last name. Maximum length is 30 characters.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }



    /**
     * The invoice recipient address.
     *
     * @param \PayPal\Api\InvoiceAddress $address
     * 
     * @return $this
     */
    public function setAddress1($address)
    {
        $this->address1 = $address;
        return $this;
    }

    /**
     * The invoice recipient address.
     *
     * @return \PayPal\Api\InvoiceAddress
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * The invoice recipient address.
     *
     * @param \PayPal\Api\InvoiceAddress $address
     * 
     * @return $this
     */
    public function setAddress2($address)
    {
        $this->address2 = $address;
        return $this;
    }

    /**
     * The invoice recipient address.
     *
     * @return \PayPal\Api\InvoiceAddress
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    

    /**
     * Additional information, such as business hours. Maximum length is 40 characters.
     *
     * @param string $additional_info
     * 
     * @return $this
     */
    public function setAdditionalInfo($additional_info)
    {
        $this->additional_info = $additional_info;
        return $this;
    }

    /**
     * Additional information, such as business hours. Maximum length is 40 characters.
     *
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additional_info;
    }
   
}