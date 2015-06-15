<?php
namespace video\StreamBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use video\StreamBundle\Entity\User;
use video\StreamBundle\Entity\Video;
use video\StreamBundle\Entity\videoShare;
use video\StreamBundle\Form\Type\RegistrationFormType;
use video\StreamBundle\Form\Type\VideoType;

class HomeController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
            //get public videos only
            $query = $em->createQuery('SELECT v FROM videoStreamBundle:Video v WHERE v.videoPrivacy = :videoPrivacy ORDER BY v.id DESC');
            $query->setParameter('videoPrivacy', "Public");
            $listVideos = $query->getResult();


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
            // Update compteur vue
            $this->updateVideoCount($video_id);

            // Videos recommandés
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT v FROM videoStreamBundle:Video v WHERE v.videoViewCount > :vCount AND v.videoShareCount > :vSCount ORDER BY v.videoViewCount DESC, v.videoShareCount DESC');
            $query->setParameter('vCount', 0);
            $query->setParameter('vSCount',0);
            $query->setMaxResults(3);
            $listVideos = $query->getResult();


            return $this -> render('videoStreamBundle:Home:view.html.twig', array('video_id'=>$listVideo,'recommendedVideos'=> $listVideos));
        }
    }


    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new RegistrationFormType(), $user);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if($form->isValid())
        {
            $user->setEnabled(true);
            $em->persist($user);
            $em->flush();
            return $this->indexAction();


        } else {
            return $this -> render('videoStreamBundle:Home:register.html.twig', array('form'=>$form->createView()));

        }

    }

    public function profileAction(Request $request)
    {

        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createFormBuilder($user)
            ->add('email', 'text')
            ->add('password', 'password')
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$em->persist($user);
            $em->flush();
            return $this->render('videoStreamBundle:Home:profile.html.twig',array(
                "working"=>"working", 'user'=>$user, 'form'=>$form->createView()
            ));
        } else {
            return $this -> render('videoStreamBundle:Home:profile.html.twig',array(
                'form'=>$form->createView(), 'user'=>$user
            ));
        }

    }

    public function recommendationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT v FROM videoStreamBundle:Video v WHERE v.videoViewCount > :vCount AND v.videoShareCount > :vSCount ORDER BY v.videoViewCount DESC, v.videoShareCount DESC');
        $query->setParameter('vCount', 0);
        $query->setParameter('vSCount',0);

        $listVideos = $query->getResult();


        //Retrieve all recommended videos
        return $this -> render('videoStreamBundle:Home:recommendation.html.twig',array('recommendedVideos'=>$listVideos));
    }


    public function historyAction()
    {
        return $this -> render('videoStreamBundle:Home:history.html.twig');
    }

    public function contactAction()
    {
        return $this -> render('videoStreamBundle:Home:contact.html.twig');
    }

    public function updateVideoCount($video_id)
    {
        // Video count update
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('videoStreamBundle:video')->find($video_id);
        $video->setVideoViewCount($video->getVideoViewCount()+1);
        $em->flush();
    }

    public function uploadAction(Request $request)
    {
        $video = new Video();
        $user = $this->get('security.context')->getToken()->getUser();
        $video->setUser($user);
        $form = $this->createForm(new VideoType(),$video);

        $form->handleRequest($request);
        if($form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $video->upload();
            //var_dump($video);
            $video->setVideoViewCount(0);
            $video->setVideoShareCount(0);
            $video->setVideoDuration(0);
            $video->setVideoPublicationDate(new \DateTime());
            $em->persist($video);
            $em->flush();
            return $this -> redirect($this->generateUrl('myVideo_page'));

        }
        else
        {
            return $this -> render('videoStreamBundle:Home:upload.html.twig',array('form'=>$form->createView()));
        }
    }

    public function shareItAction($id)
    {
        $videoShare = new videoShare();
        $videoShare->setVideoLink($id);
        $vlink = $videoShare->getLink();
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($videoShare);
        $em->flush();
        
        return $this -> render('videoStreamBundle:Home:shareInfo.html.twig',array('link'=>$vlink ,'videoId'=>$id));
    }

    public function getShareAction($id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('videoStreamBundle:videoShare');
        $videoShares = $repository->findBy(array('link' => $id));

        $v_id = $videoShares[0]->getVideoLink();
        //echo($videoShares[0]->getVideoLink());

        return $this->viewAction($v_id);
    }



    public function myVideoAction()
    {

        // Session getUserId
        $user = $this->get('security.context')->getToken()->getUser();
        $userId= $user->getId();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT v FROM videoStreamBundle:Video v WHERE v.user = :vUserId');
        $query->setParameter('vUserId', $userId);

        $listVideos = $query->getResult();
        return $this -> render('videoStreamBundle:Home:myVideo.html.twig',array('myVideos'=>$listVideos));
    }

    public function getEditAction($id){


            $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('videoStreamBundle:Video')->find($id);


//        $query = $em->createQuery('SELECT v FROM videoStreamBundle:Video v WHERE v.id = :vVideoId');
//        $query->setParameter('vVideoId', $id);

        //$myVideoInfo = $query->getResult();

        //return new Response("INFO " .$id);
        return $this -> render('videoStreamBundle:Home:editVideo.html.twig',array('myVideo'=>$video));
    }

    public function updateVideoInfoAction($id){

            // My Video update
        // get VideoInfo change - form
        $requête = $this->get('request');
        if($requête->getMethod()=='POST'){
 $name = $_POST['videoName'];
 $desc = $_POST['videoDesc'];
 $privacy = $_POST['videoPrivacy'];
 $em = $this->getDoctrine()->getManager();
 $video = $em->getRepository('videoStreamBundle:Video')->find($id);
 $video->setVideoName($name);
 $video->setVideoDescription($desc);
 $video->setVideoPrivacy($privacy);
 $em->flush();

 return $this->MyVideoAction();
 //return $this -> render('videoStreamBundle:Home:myVideo.html.twig');
        }
    }

}
