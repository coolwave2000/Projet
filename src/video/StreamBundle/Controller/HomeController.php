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
        $repository = $this->getDoctrine()->getRepository('videoStreamBundle:Video');
        $listVideos = $repository->findAll();

        //Retrieve all videos - for each
        return $this -> render('videoStreamBundle:Home:index.html.twig',array('allVideos'=>$listVideos));
    }

    public function viewAction($video_id)
    {
        // récupération Id - lien dans la table Video - envoi source en paramètre
        $repository = $this->getDoctrine()->getRepository('videoStreamBundle:Video');
        $listVideo = $repository->find($video_id);

        if(!$listVideo)
        {
            return $this -> render('videoStreamBundle:Home:view.html.twig', array('video_id'=>$video_id));
        }
        else
        {
            $this->updateVideoCount($video_id);
            return $this -> render('videoStreamBundle:Home:view.html.twig', array('video_id'=>$listVideo));
        }
    }


    public function uploadAction()
    {
        return $this -> render('videoStreamBundle:Home:upload.html.twig');
    }

    public function registerAction()
    {
        return $this -> render('videoStreamBundle:Home:register.html.twig');
    }

    public function updateVideoCount($video_id)
    {
        // Video count update
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('videoStreamBundle:video')->find($video_id);
        $video->setVideoViewCount($video->getVideoViewCount()+1);
        $em->flush();
    }
}