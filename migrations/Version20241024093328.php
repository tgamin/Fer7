<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024093328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE realisation_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation_type_realisations (realisation_type_id INT NOT NULL, realisations_id INT NOT NULL, INDEX IDX_F9469DA2FA67AE (realisation_type_id), INDEX IDX_F9469DFBAB59A2 (realisations_id), PRIMARY KEY(realisation_type_id, realisations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisation_type_realisations ADD CONSTRAINT FK_F9469DA2FA67AE FOREIGN KEY (realisation_type_id) REFERENCES realisation_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisation_type_realisations ADD CONSTRAINT FK_F9469DFBAB59A2 FOREIGN KEY (realisations_id) REFERENCES realisations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realisation_type_realisations DROP FOREIGN KEY FK_F9469DA2FA67AE');
        $this->addSql('ALTER TABLE realisation_type_realisations DROP FOREIGN KEY FK_F9469DFBAB59A2');
        $this->addSql('DROP TABLE realisation_type');
        $this->addSql('DROP TABLE realisation_type_realisations');
    }
}
