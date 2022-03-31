<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331102059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_entreprises');
        $this->addSql('ALTER TABLE users ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9A4AEAFEA ON users (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_entreprises (users_id INT NOT NULL, entreprises_id INT NOT NULL, INDEX IDX_A1048B5B67B3B43D (users_id), INDEX IDX_A1048B5BA70A18EC (entreprises_id), PRIMARY KEY(users_id, entreprises_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_entreprises ADD CONSTRAINT FK_A1048B5B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_entreprises ADD CONSTRAINT FK_A1048B5BA70A18EC FOREIGN KEY (entreprises_id) REFERENCES entreprises (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A4AEAFEA');
        $this->addSql('DROP INDEX IDX_1483A5E9A4AEAFEA ON users');
        $this->addSql('ALTER TABLE users DROP entreprise_id');
    }
}
