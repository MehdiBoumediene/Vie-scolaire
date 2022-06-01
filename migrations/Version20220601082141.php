<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601082141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier CHANGE type type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD calendrier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5FF52FC51 ON classes (calendrier_id)');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A76ED395');
        $this->addSql('DROP INDEX IDX_58316743A76ED395 ON tuteurs');
        $this->addSql('ALTER TABLE tuteurs CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_5831674367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5831674367B3B43D ON tuteurs (users_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E96FFF0BAB');
        $this->addSql('DROP INDEX IDX_1483A5E96FFF0BAB ON users');
        $this->addSql('ALTER TABLE users DROP tuteurs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5FF52FC51');
        $this->addSql('DROP INDEX IDX_2ED7EC5FF52FC51 ON classes');
        $this->addSql('ALTER TABLE classes DROP calendrier_id');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_5831674367B3B43D');
        $this->addSql('DROP INDEX IDX_5831674367B3B43D ON tuteurs');
        $this->addSql('ALTER TABLE tuteurs CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_58316743A76ED395 ON tuteurs (user_id)');
        $this->addSql('ALTER TABLE users ADD tuteurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E96FFF0BAB FOREIGN KEY (tuteurs_id) REFERENCES tuteurs (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E96FFF0BAB ON users (tuteurs_id)');
    }
}
