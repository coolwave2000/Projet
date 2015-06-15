<?php
/**
 * Created by PhpStorm.
 * User: aravindanrengaramanujam
 * Date: 02/06/15
 * Time: 10:58
 */

namespace video\StreamBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="videoShare")
 */
class videoShare {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoLink;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    protected $videoShareDate;


    function __construct()
    {
        $length =10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->setLink($randomString);
        $date = new \DateTime();
        $this->setVideoShareDate($date);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getVideoLink()
    {
        return $this->videoLink;
    }

    /**
     * @param mixed $videoLink
     */
    public function setVideoLink($videoLink)
    {
        $this->videoLink = $videoLink;
    }

    /**
     * @return mixed
     */
    public function getVideoShareDate()
    {
        return $this->videoShareDate;
    }

    /**
     * @param mixed $videoShareDate
     */
    public function setVideoShareDate($videoShareDate)
    {
        $this->videoShareDate = $videoShareDate;
    }

}