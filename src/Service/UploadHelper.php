<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UploadHelper
{
    private $params;
    private $slugger;

    public function __construct(ParameterBagInterface $params, SluggerInterface $slugger)
    {
        $this->params = $params;
        $this->slugger = $slugger;
    }

    public function uploadTrickMainPicture(UploadedFile $uploadedFile){
        return $this->uploadTrickPicture($uploadedFile, $this->params->get('main_picture_directory'));
    }

    public function uploadTrickLinkedPicture(SluggerInterface $slugger, UploadedFile $uploadedFile){
        return $this->uploadTrickPicture($uploadedFile, $this->params->get('linked_picture_directory'));
    }

    public function uploadTrickPicture(UploadedFile $uploadedFile, string $destination) :string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }
}