<?php


namespace App\Controller;


use App\Entity\UserInfo;
use App\Repository\UserInfoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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

    /**
     * @Route("/downloadFile/{type}/{fileName}", name="downloadFile")
     */
    public function download($type, $fileName)
    {
        $path = $this->getParameter('uploadsDir') . $type . '/' .$fileName;
        $response = new BinaryFileResponse($path);
        $response->headers->set('Content-Type','text/plain');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);

        return $response;
    }

    /**
     * @Route("/delete/{type}/{fileName}", name="deleteFile", methods={"POST"})
     */
    public function delete($type, $fileName, UserInfoRepository $repository, EntityManagerInterface $manager)
    {
        $path = $this->getParameter('uploadsDir') . $type . '/' .$fileName;
        unlink($path);
        /** @var UserInfo $obj */
        $obj = $repository->findBy(['photoFilename' => $fileName])[0];
        $obj->setPhotoFilename(null);
        $manager->persist($obj);
        $manager->flush();

        return $this->redirectToRoute('profile');
    }
}