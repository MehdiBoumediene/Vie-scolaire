<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602080900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier ADD bloc_id INT DEFAULT NULL, ADD module_id INT DEFAULT NULL, ADD intervenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB95582E9C0 FOREIGN KEY (bloc_id) REFERENCES blocs (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9AFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_B2753CB95582E9C0 ON calendrier (bloc_id)');
        $this->addSql('CREATE INDEX IDX_B2753CB9AFC2B591 ON calendrier (module_id)');
        $this->addSql('CREATE INDEX IDX_B2753CB9AB9A1716 ON calendrier (intervenant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB95582E9C0');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9AFC2B591');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9AB9A1716');
        $this->addSql('DROP INDEX IDX_B2753CB95582E9C0 ON calendrier');
        $this->addSql('DROP INDEX IDX_B2753CB9AFC2B591 ON calendrier');
        $this->addSql('DROP INDEX IDX_B2753CB9AB9A1716 ON calendrier');
        $this->addSql('ALTER TABLE calendrier DROP bloc_id, DROP module_id, DROP intervenant_id');
    }
}
