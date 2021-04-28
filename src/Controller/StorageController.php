<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class StorageController extends AbstractController
{
    /**
     * @Route("/getFile/{type}/{fileName}", name="getFile")
     */
    public function getFile(KernelInterface $kernel, $type, $fileName)
    {
        $path = $this->getParameter('uploadsDir') . $type . '/' .$fileName;
        return new BinaryFileResponse($path);
    }
}