<?php

namespace App\Controller;

use App\Entity\Truck;
use App\Form\TruckType;
use App\Repository\TruckRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/truck")
 */
class TruckController extends AbstractController
{
    /**
     * @Route("/", name="truck_index", methods={"GET"})
     */
    public function index(TruckRepository $truckRepository): Response
    {
        return $this->render('truck/index.html.twig', [
            'trucks' => $truckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="truck_new", methods={"GET","POST"})
     */
    public function new(Request $request, TruckRepository $truckRepository): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $truck = new Truck();
            $form = $this->createForm(TruckType::class, $truck);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($truck);
                $entityManager->flush();

                return $this->redirectToRoute('truck_index');
            }

            return $this->render('truck/new.html.twig', [
                'truck' => $truck,
                'form' => $form->createView(),
            ]);
        } else {
            throw $this->createAccessDeniedException('Access Denied.');
        }
    }

    /**
     * @Route("/{id}", name="truck_show", methods={"GET"})
     */
    public function show(Truck $truck): Response
    {
        return $this->render('truck/show.html.twig', [
            'truck' => $truck,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="truck_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Truck $truck): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        $form = $this->createForm(TruckType::class, $truck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('truck_index', [
                'id' => $truck->getId(),
            ]);
        }

        return $this->render('truck/edit.html.twig', [
            'truck' => $truck,
            'form' => $form->createView(),
        ]);
        } else {
            throw $this->createAccessDeniedException('Access Denied.');
        }
    }

    /**
     * @Route("/{id}", name="truck_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Truck $truck): Response
    {
        if ($this->isCsrfTokenValid('delete'.$truck->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($truck);
            $entityManager->flush();
        }

        return $this->redirectToRoute('truck_index');
    }
}
