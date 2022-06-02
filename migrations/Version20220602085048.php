<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602085048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5FF52FC51');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC510C8BDCC');
        $this->addSql('DROP INDEX IDX_2ED7EC510C8BDCC ON classes');
        $this->addSql('DROP INDEX IDX_2ED7EC5FF52FC51 ON classes');
        $this->addSql('ALTER TABLE classes ADD user_id INT DEFAULT NULL, DROP class__id, DROP calendrier_id');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5A76ED395 ON classes (user_id)');
        $this->addSql('ALTER TABLE users ADD class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9EA000B10 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9EA000B10 ON users (class_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5A76ED395');
        $this->addSql('DROP INDEX IDX_2ED7EC5A76ED395 ON classes');
        $this->addSql('ALTER TABLE classes ADD calendrier_id INT DEFAULT NULL, CHANGE user_id class__id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC510C8BDCC FOREIGN KEY (class__id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC510C8BDCC ON classes (class__id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5FF52FC51 ON classes (calendrier_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9EA000B10');
        $this->addSql('DROP INDEX IDX_1483A5E9EA000B10 ON users');
        $this->addSql('ALTER TABLE users DROP class_id');
    }
}
