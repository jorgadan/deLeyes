<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CreditInfo;
use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Creditinfo controller.
 *
 * @Route("creditinfo")
 */
class CreditInfoController extends Controller
{
    /**
     * Lists all creditInfo entities.
     *
     * @Route("/", name="creditinfo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $creditInfos = $em->getRepository('AppBundle:CreditInfo')->findAll();

        return $this->render('creditinfo/index.html.twig', array(
            'creditInfos' => $creditInfos,
        ));
    }

    /**
     * Creates a new creditInfo entity.
     *
     * @Route("/new", name="creditinfo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $creditInfo = new Creditinfo();
        $form = $this->createForm('AppBundle\Form\CreditInfoType', $creditInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creditInfo->setUserId($this->getUser());
            $files = $request->files->all();
            /** @var UploadedFile $doc */
            foreach ($files['appbundle_creditinfo']['docs'] as $doc) {
                $prueba = new File();
                $prueba->setName($doc->getClientOriginalName());
                $prueba->setPath('uploads/'.$prueba->getName());
                $prueba->setCreditId($creditInfo);
                $doc->move(__DIR__.'/../../../web/uploads/',$doc->getClientOriginalName());
                $this->get('doctrine.orm.entity_manager')->persist($prueba);
            }
            $this->get('doctrine.orm.entity_manager')->persist($creditInfo);
            $this->get('doctrine.orm.entity_manager')->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('creditinfo/new.html.twig', array(
            'creditInfo' => $creditInfo,
            'form' => $form->createView(),
        ));
    }
}
