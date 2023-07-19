<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Founders nullable
 */
final class Version20230718142906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Founders nullable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups CHANGE founders founders VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups CHANGE founders founders VARCHAR(255) NOT NULL');
    }
}
