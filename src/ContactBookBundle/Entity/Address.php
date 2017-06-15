<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="ContactBookBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="address")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var int
     *
     * @ORM\Column(name="houseNr", type="integer")
     */
    private $houseNr;

    /**
     * @var int
     *
     * @ORM\Column(name="appartmentNr", type="integer")
     */
    private $appartmentNr;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNr
     *
     * @param integer $houseNr
     * @return Address
     */
    public function setHouseNr($houseNr)
    {
        $this->houseNr = $houseNr;

        return $this;
    }

    /**
     * Get houseNr
     *
     * @return integer 
     */
    public function getHouseNr()
    {
        return $this->houseNr;
    }

    /**
     * Set appartmentNr
     *
     * @param integer $appartmentNr
     * @return Address
     */
    public function setAppartmentNr($appartmentNr)
    {
        $this->appartmentNr = $appartmentNr;

        return $this;
    }

    /**
     * Get appartmentNr
     *
     * @return integer 
     */
    public function getAppartmentNr()
    {
        return $this->appartmentNr;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}
