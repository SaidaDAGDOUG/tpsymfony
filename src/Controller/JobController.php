<?php

namespace App\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Job;
use App\Entity\Image;
class JobController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('job/index.html.twig', [
            'controller_name' => 'Groupe B',
        ]);
    }
     /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('job/accueil.html.twig');
    }
    /**
     * @Route("/voir/{id}", name="voir",requirements={"id"="\d+"}) //fi blaset requirement najmou n7otou int $id bin 9awsin fil methode voir
     */
    public function voir($id)//:  Response
    {//reppsitory ta3mal recuperi les donnees 
        $repository=$this->getDoctrine()->getManager()->getRepository(Job::class);
        $job=$repository->find($id);
        if(null==$job){
            throw new NotFoundHttpException("le job job ayan l'id".$id."n'existe pas");

        }
        return $this->render('job/voir.html.twig',['job' =>$job]);
       //return new Response("hello my new id from the controller ".$id); //min8ir maya7tage page voir.html.twig bich ya5ou il id 
    }



    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter():  Response
    { 
        
        $job2=new job();
        $job2->setTitle('Developpeur symfony');
        $job2->setCompany('slothLab');
        $job2->setDescription('Nous recherchons un Deeloppeur symfony expert ');
        $job2->setIsActivated(1);
        $job2->setExpiresAt(new \DateTimeImmutable());
        $job2->setEmail('yosr@sloth-lab.com');

        $image=new image();
        $image->setUrl('https://www.anxiete.fr/wp-content/uploads/2014/10/phobie-sociale.jpg');
        $image->setAlt('');
        $job2->setImage($image);

        $em =$this->getDoctrine()->getManager();
        $em->persist($job2); //recuperer les donnees 
        $em->flush(); //insertion
        return $this->render('job/ajouter.html.twig',['ajouter_name' =>'Page ajout']);
       
    }
    /**
     * @Route("/modifier", name="modifier") 
     */
    public function modifier():  Response
    {
        return $this->render('job/modifier.html.twig');
       
    }
    /**
     * @Route("/supprimer", name="supprimer") 
     */
    public function supprimer():  Response
    {
        return $this->render('job/supprimer.html.twig'); 
       
    }



    public function menu():Response
    {
        $mymenu=array(
            ['route'=>'accueil','intitule'=>'Accueil'],
            ['route'=>'ajouter','intitule'=>'Ajouter un job'],
            ['route'=>'modifier','intitule'=>'Modifier un job '],
            ['route'=>'modifier','intitule'=>'apropos de nous'],
        
        );
        return $this->render('job/menu.html.twig',['mymenu'=>$mymenu,]);

    
    }
     
     public function sidebar():Response 
     {
         $listjobs=array(
             ['id' =>1,'nomjob' => 'Developpeur web'],
             ['id' =>2,'nomjob' => 'Responsable marketing'],
             ['id' =>3,'nomjob' => 'Team Leader'],
             
         );
         return $this->render('job/sidebar.html.twig',['listjobs'=>$listjobs,]);
     } 

 

      
    
}
