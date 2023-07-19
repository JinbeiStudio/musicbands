<?php

namespace App\Entity;

use App\Repository\MusicalGroupsFilesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\CreateMusicalGroupsAction;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Uploadable\Mapping\Validator;

#[ORM\Entity(repositoryClass: MusicalGroupsFilesRepository::class)]
#[Gedmo\Uploadable(
    filenameGenerator: Validator::FILENAME_GENERATOR_SHA1,
    allowOverwrite: false,
    appendNumber: true
)]
#[ApiResource(
    types: ['https://schema.org/MediaObject'],
    operations: [
        new Post(
            openapiContext: [
                'summary' => 'Upload file',
                'description' => 'Upload a file and save it to the database.',
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ],
                                ]
                            ]
                        ],
                    ]
                ]
            ],
            controller: CreateMusicalGroupsAction::class,
            uriTemplate: '/file/upload',
            deserialize: false,
        )
    ]
)]
class MusicalGroupsFiles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\UploadableFilePath]
    private ?string $path = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\UploadableFileName]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\UploadableFileMimeType]
    private ?string $mimeType = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    #[Gedmo\UploadableFileSize]
    private ?string $fileSize = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getFileSize(): ?string
    {
        return $this->fileSize;
    }

    public function setFileSize(string $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }
}
