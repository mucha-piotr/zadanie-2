<?php

namespace AppBundle\Controller;


use AppBundle\Form\UploadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @Route("/",name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(UploadType::class,[],[]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $file */
            $file = $form->getData()['image'];
            
            $originalName = $file->getFilename().'.'.$file->guessClientExtension();
            
            $path = 'images/';
            
            
            $fileName = uniqid().'.'.$file->guessClientExtension();

            $url = $path.$fileName;
            $file->move($path,$fileName);
            
            $image = $this->get('image');
            
            
            $imageInfo = [
                "url" => $url,
                "width" => $image->getWidth($url),
                "height" => $image->getHeight($url),
                "size" => $image->calculateSize($url),
                "type" => $image->getType($url)
            ];

            $image->flipImage($url);

            return $this->render("@App/index.html.twig",[
                "form" => $form->createView(),
                "image" => $imageInfo
            ]);
        }
        
        return $this->render("@App/index.html.twig",[
            "form" => $form->createView(),
        ]);
    }
}