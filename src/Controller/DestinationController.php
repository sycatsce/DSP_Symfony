<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DriverManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DestinationController extends AbstractController
{

    /**
     * @Route("/destinations/user/{id}")
     */
    public function listUserDestionations($id)
    {

        $destinationRepository = $this->getDoctrine()->getRepository(Destination::class);
        $stmt = $this->getEntityManager()->getConnection()->prepare(
            'SELECT * FROM destination WHERE  id = (
                SELECT destination_id FROM user_destination WHERE user_id = :id
            )'
        );
        $stmt->setParameter(':id', $id);
        $stmt->execute();

        return $this->render('destination/userDestinations.html.twig', [
            'destinations'=> $stmt->fetchAll()
        ]);
    }

    /**
     * @Route("/destination/create")
     */
    public function createDestination()
    {

    }

    /**
     * @Route("/destination/add/{id}")
     */
    public function addDestination()
    {
        
    }
}
