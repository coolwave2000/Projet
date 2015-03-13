<?php
/**
 * Created by PhpStorm.
 * User: aravindanrengaramanujam
 * Date: 11/03/15
 * Time: 12:32
 */

namespace video\StreamBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="video")
 */
class Video {


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * @param mixed $videoName
     */
    public function setVideoName($videoName)
    {
        $this->videoName = $videoName;
    }

    /**
     * @return mixed
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * @param mixed $videoDescription
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;
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
    public function getVideoViewCount()
    {
        return $this->videoViewCount;
    }

    /**
     * @param mixed $videoViewCount
     */
    public function setVideoViewCount($videoViewCount)
    {
        $this->videoViewCount = $videoViewCount;
    }

    /**
     * @return mixed
     */
    public function getVideoPublicationDate()
    {
        return $this->videoPublicationDate;
    }

    /**
     * @param mixed $videoPublicationDate
     */
    public function setVideoPublicationDate($videoPublicationDate)
    {
        $this->videoPublicationDate = $videoPublicationDate;
    }

    /**
     * @return mixed
     */
    public function getVideoDuration()
    {
        return $this->videoDuration;
    }

    /**
     * @param mixed $videoDuration
     */
    public function setVideoDuration($videoDuration)
    {
        $this->videoDuration = $videoDuration;
    }

    /**
     * @return mixed
     */
    public function getVideoAuthor()
    {
        return $this->videoAuthor;
    }

    /**
     * @param mixed $videoAuthor
     */
    public function setVideoAuthor($videoAuthor)
    {
        $this->videoAuthor = $videoAuthor;
    }

    /**
     * @return mixed
     */
    public function getVideoPrivacy()
    {
        return $this->videoPrivacy;
    }

    /**
     * @param mixed $videoPrivacy
     */
    public function setVideoPrivacy($videoPrivacy)
    {
        $this->videoPrivacy = $videoPrivacy;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoLink;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $videoViewCount;

    /**
     * @ORM\Column(type="date", length=255)
     */
    protected $videoPublicationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoDuration;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="video")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $videoAuthor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoPrivacy;
}