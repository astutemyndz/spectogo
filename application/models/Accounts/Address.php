<?php 
namespace Models\Accounts;
use Models\Accounts\BaseAddress;

class Address extends BaseAddress{
   
    /**
     * Phone number in E.123 format. 50 characters max.
     *
     * @param string $phone
     * 
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number in E.123 format. 50 characters max.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Type of address (e.g., HOME_OR_WORK, GIFT etc).
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Type of address (e.g., HOME_OR_WORK, GIFT etc).
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}