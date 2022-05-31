<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531110022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuteurs ADD etudiants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id)');
        $this->addSql('CREATE INDEX IDX_58316743A873A5C6 ON tuteurs (etudiants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A873A5C6');
        $this->addSql('DROP INDEX IDX_58316743A873A5C6 ON tuteurs');
        $this->addSql('ALTER TABLE tuteurs DROP etudiants_id');
    }
}
