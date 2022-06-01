<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601144458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB98F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_B2753CB98F5EA509 ON calendrier (classe_id)');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5FF52FC51');
        $this->addSql('DROP INDEX IDX_2ED7EC5FF52FC51 ON classes');
        $this->addSql('ALTER TABLE classes DROP calendrier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB98F5EA509');
        $this->addSql('DROP INDEX IDX_B2753CB98F5EA509 ON calendrier');
        $this->addSql('ALTER TABLE calendrier DROP classe_id');
        $this->addSql('ALTER TABLE classes ADD calendrier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5FF52FC51 ON classes (calendrier_id)');
    }
}
