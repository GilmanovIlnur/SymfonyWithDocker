<?php


namespace App\Service;


use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadService
{
    private $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function uploadFile($file, $storageDirectory)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid(). '.' . $file->guessExtension();
var_dump($newFilename);
        try {
            $file->move(
                $storageDirectory,
                $newFilename
            );
        } catch (FileException $e) {
            throw new Exception("File upload exception");
        }

        return $newFilename;
    }
}