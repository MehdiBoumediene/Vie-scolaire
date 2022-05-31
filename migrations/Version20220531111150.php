<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531111150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants ADD tuteurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB6FFF0BAB FOREIGN KEY (tuteurs_id) REFERENCES tuteurs (id)');
        $this->addSql('CREATE INDEX IDX_227C02EB6FFF0BAB ON etudiants (tuteurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB6FFF0BAB');
        $this->addSql('DROP INDEX IDX_227C02EB6FFF0BAB ON etudiants');
        $this->addSql('ALTER TABLE etudiants DROP tuteurs_id');
    }
}
