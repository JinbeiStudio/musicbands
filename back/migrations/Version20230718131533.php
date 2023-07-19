<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * File size
 */
final class Version20230718131533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'File size';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups_files ADD file_size NUMERIC(10, 0) NOT NULL, DROP size');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups_files ADD size VARCHAR(255) NOT NULL, DROP file_size');
    }
}
