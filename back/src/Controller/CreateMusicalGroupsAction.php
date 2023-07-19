<?php

namespace App\Controller;

use App\Entity\MusicalGroupsFiles;
use App\Service\UploadFileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsController]
final class CreateMusicalGroupsAction extends AbstractController
{
    public function __invoke(Request $request, UploadFileService $uploadFileService): MusicalGroupsFiles
    {
        /** @var ?UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        return $uploadFileService->generateMusicalGroupsFile($uploadedFile);
    }
}
