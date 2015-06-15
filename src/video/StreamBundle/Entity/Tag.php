<?php
/**
 * Created by PhpStorm.
 * User: mamadhaxor
 * Date: 13/03/2015
 * Time: 12:28
 */

namespace video\StreamBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     *@ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $tag_name;

    /**
     * @return mixed
     */
    public function getTagName()
    {
        return $this->tag_name;
    }

    /**
     * @param mixed $tag_name
     */
    public function setTagName($tag_name)
    {
        $this->tag_name = $tag_name;
    }

}