<?php

namespace GrossumTestTaskBundle\Controller;

use GrossumTestTaskBundle\Entity\Contacts;
use GrossumTestTaskBundle\Form\ContactsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RegistrController extends Controller
{
    /**
     * @var Logger $logger
     */
    private $logger;
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registrAction(Request $request)
    {
        $this->logger = $this->get('grossum_test_task.logger');
        $form = $this->createForm(new ContactsType());
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            try {
                if ($form->isValid()) {
                    $data = $form->getData();
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($data);
                    $em->flush();
                    $this->logger->logger->debug(
                        sprintf('Create new record in database Data:%s',serialize($data))
                    );
                    return new JsonResponse(['status'=>'success','message'=>'create new record in database','code'=>200],200);
                } else {
                    $this->logger->logger->debug('not valid form data');
                    return new JsonResponse(['status'=>'error','message'=>'not valid form data','code'=>500],200);
                }
            } catch(\Exception $e){
                $this->logger->logger->debug('server error');
                return new JsonResponse(['status'=>'error','message'=>'server error','code'=>500],200);
            }
        }
        return $this->render('GrossumTestTaskBundle:Registr:registr.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
