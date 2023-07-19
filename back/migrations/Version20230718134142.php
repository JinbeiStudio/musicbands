<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Founders type
 */
final class Version20230718134142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'founders type';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups CHANGE founders founders VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE musical_groups CHANGE founders founders LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
