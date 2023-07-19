<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Entity\MusicalGroupsFiles;
use App\Message\CreateMusicalGroupsMessage;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Symfony\Component\Messenger\MessageBusInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: MusicalGroupsFiles::class)]
class UploadFileListener
{
    protected $bus;
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function postPersist(MusicalGroupsFiles $file, PostPersistEventArgs $args)
    {
        $this->insertGroups($file);
    }

    public function insertGroups(MusicalGroupsFiles $file)
    {
        $this->bus->dispatch(new CreateMusicalGroupsMessage($file->getPath()));
    }
}
