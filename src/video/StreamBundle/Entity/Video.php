<?php
/**
 * Created by PhpStorm.
 * User: aravindanrengaramanujam
 * Date: 11/03/15
 * Time: 12:32
 */

namespace video\StreamBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="video")
 * @ORM\HasLifecycleCallbacks
 */
class Video {


    private $temp;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



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

    /**
     * @return mixed
     */

    /**
     * @Assert\File(maxSize="500M", mimeTypes={"video/mp4","video/webm","video/ogg"})
     */
    protected $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if(isset($this->videoLink)) {
            $this->temp = $this->videoLink;
            $this->videoLink = null;
        } else {
            $this->videoLink = 'initial.jpg';
        }
    }
    public $filename;

    /**
     * @return mixed
     */
    public function getFilename()
    {
        if($this->filename == null) {
            $this->filename = sha1(uniqid(mt_rand(), true));
            return $this->filename;
        }
        return $this->filename;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if ($this->getFile() !== null) {
            //$filename = sha1(uniqid(mt_rand(), true));
            $this->videoLink = $this->getFilename().'.'.$this->getFile()->getClientOriginalExtension();
        }
    }

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
    public function getAbsolutePath()
    {
        return null == $this->videoLink ? null : $this->getUploadRootDir();
    }

    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    public function getUploadDir()
    {
        return 'uploads/videos';
    }

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $videoViewCount;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $videoShareCount;

    /**
     * @return mixed
     */
    public function getVideoShareCount()
    {
        return $this->videoShareCount;
    }

    /**
     * @param mixed $videoShareCount
     */
    public function setVideoShareCount($videoShareCount)
    {
        $this->videoShareCount = $videoShareCount;
    }

    /**
     * @ORM\Column(type="date", length=255)
     */
    protected $videoPublicationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoDuration;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="videos")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $user;

    /**
     *@ORM\ManyToMany(targetEntity="Tag")
     *@ORM\JoinTable(name="video_tags", joinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
     */
    protected $tags;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $videoPrivacy;


    public function upload()
    {
        if (null == $this->getFile()) {
            return new Response("in the upload file nul");
        }

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFilename().'.'.$this->getFile()->getClientOriginalExtension()
        );
        return new Response("in the upload file");

        /*if(isset($this->temp)) {
            unlink($this->getUploadRootDir(), $this->temp);
            $this->temp = null;

        }
        $this->file = null;*/
    }
}