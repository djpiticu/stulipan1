<?php

declare(strict_types=1);

namespace App\Entity\Model;

use App\Controller\Utils\GeneralUtils;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 *
 */

class CustomerBasic
{
    /**
     * @var string
     * @Groups({"orderView", "orderList"})
     *
     * @Assert\NotBlank(message="checkout.customer.missing-email-address")
     * @Assert\Email(message="checkout.customer.invalid-email-address")
     */
    private $email;

    /**
     * @var string
     * @Groups({"orderView", "orderList"})
     *
     * @Assert\NotBlank(message="checkout.customer.missing-firstname")
     */
    private $firstname;

    /**
     * @var string
     * @Groups({"orderView", "orderList"})
     *
     * @Assert\NotBlank(message="checkout.customer.missing-lastname")
     */
    private $lastname;

    /**
     * @var string
     * @Groups({"orderView", "orderList"})
     *
     * @Assert\NotBlank(message="checkout.customer.missing-phone")
     * @CustomAssert\PhoneNumber(regionCode="HU", message="checkout.customer.invalid-phone")
     */
    private $phone;

    public function __construct(string $email = null, string $firstname = null, string $lastname = null, string $phone = null)
    {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = ucwords($firstname);
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = ucwords($lastname);
    }

    /**
     * @return string
     */
    public function getFullname(): ?string
    {
        $fullname = $this->firstname.' '.$this->lastname;
        return $fullname;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return (string) $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(?string $phone)
    {
        $utils = new GeneralUtils();
        $this->phone = $utils->formatPhoneNumber($phone);
    }



}