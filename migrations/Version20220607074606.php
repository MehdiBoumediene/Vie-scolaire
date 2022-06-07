<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607074606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences ADD absent TINYINT(1) DEFAULT NULL, ADD dateabsence DATETIME DEFAULT NULL, ADD enretard TINYINT(1) DEFAULT NULL, ADD dateretard DATETIME DEFAULT NULL, ADD present TINYINT(1) DEFAULT NULL, ADD datepresence DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences DROP absent, DROP dateabsence, DROP enretard, DROP dateretard, DROP present, DROP datepresence');
    }
}
