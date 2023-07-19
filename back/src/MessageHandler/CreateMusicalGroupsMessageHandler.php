<?php

namespace App\MessageHandler;

use App\Message\CreateMusicalGroupsMessage;
use App\Service\UploadFileService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateMusicalGroupsMessageHandler
{
    public $uploadFileService;

    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    public function __invoke(CreateMusicalGroupsMessage $message)
    {
        $this->uploadFileService->insertMusicalGroups($message->getPath());
    }
}
