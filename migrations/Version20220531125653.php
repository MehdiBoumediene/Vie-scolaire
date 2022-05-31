<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531125653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A4AEAFEA');
        $this->addSql('DROP INDEX IDX_1483A5E9A4AEAFEA ON users');
        $this->addSql('ALTER TABLE users CHANGE entreprise_id tuteurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E96FFF0BAB FOREIGN KEY (tuteurs_id) REFERENCES tuteurs (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E96FFF0BAB ON users (tuteurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E96FFF0BAB');
        $this->addSql('DROP INDEX IDX_1483A5E96FFF0BAB ON users');
        $this->addSql('ALTER TABLE users CHANGE tuteurs_id entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9A4AEAFEA ON users (entreprise_id)');
    }
}
