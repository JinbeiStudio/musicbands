<?php

namespace App\Service;

use App\Entity\MusicalGroups;
use App\Entity\MusicalGroupsFiles;
use App\Repository\MusicalGroupsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class UploadFileService
{
    public function __construct(
        protected UploadableManager $uploadableManager,
        protected string $projectDir,
        protected EntityManagerInterface $em,
        protected MusicalGroupsRepository $musicalGroupsRepository
    ) {
    }

    public function generateMusicalGroupsFile(?UploadedFile $uploadedFile): MusicalGroupsFiles
    {
        /** @var MusicalGroupsFiles $file */
        $file = new MusicalGroupsFiles();

        $listener = $this->uploadableManager->getUploadableListener();
        $currentFolder = date('Y') . '/' . date('m');

        $listener->setDefaultPath('uploads/' . $currentFolder);
        $this->uploadableManager->markEntityToUpload($file, $uploadedFile);

        return $file;
    }

    public function insertMusicalGroups(string $path)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($this->projectDir . '/public/' . $path);
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $groups = $sheet->toArray();

        unset($groups[0]);
        foreach ($groups as $group) {
            $exists = $this->musicalGroupsRepository->findBy(['name' => $group[0]]);

            foreach ($exists as $exist) {
                $this->em->remove($exist);
            }

            $newGroup = new MusicalGroups();
            $newGroup->setName($group[0]);
            $newGroup->setCountry($group[1]);
            $newGroup->setCity($group[2]);
            $newGroup->setYear(intval($group[3]));
            $newGroup->setSplitYear(intval($group[4]) === 0 ? NULL : intval($group[4]));
            $newGroup->setFounders($group[5]);
            $newGroup->setMembersCount(intval($group[6]));
            $newGroup->setMusicalStyle($group[7]);
            $newGroup->setDescription($group[8]);

            $this->em->persist($newGroup);
        }

        $this->em->flush();
    }
}
