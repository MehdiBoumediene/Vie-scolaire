<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602074023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_classes');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5A76ED395');
        $this->addSql('DROP INDEX IDX_2ED7EC5A76ED395 ON classes');
        $this->addSql('ALTER TABLE classes CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC567B3B43D ON classes (users_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9EA000B10');
        $this->addSql('DROP INDEX IDX_1483A5E9EA000B10 ON users');
        $this->addSql('ALTER TABLE users DROP class_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_classes (users_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_F2ED0A0F67B3B43D (users_id), INDEX IDX_F2ED0A0F9E225B24 (classes_id), PRIMARY KEY(users_id, classes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC567B3B43D');
        $this->addSql('DROP INDEX IDX_2ED7EC567B3B43D ON classes');
        $this->addSql('ALTER TABLE classes CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5A76ED395 ON classes (user_id)');
        $this->addSql('ALTER TABLE users ADD class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9EA000B10 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9EA000B10 ON users (class_id)');
    }
}
