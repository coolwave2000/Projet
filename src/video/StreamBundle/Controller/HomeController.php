<?php
/**
 * Created by PhpStorm.
 * User: Aminidir
 * Date: 06/03/15
 * Time: 13:09
 */

namespace video\StreamBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        //Retrieve all videos
        return $this -> render('videoStreamBundle:Home:index.html.twig');
    }

    public function viewAction($video_id)
    {
        return $this -> render('videoStreamBundle:Home:view.html.twig', array('video_id'=>$video_id));
    }

    public function uploadAction()
    {
        return $this -> render('videoStreamBundle:Home:upload.html.twig');
    }

    public function registerAction()
    {
        return $this -> render('videoStreamBundle:Home:register.html.twig');
    }
}