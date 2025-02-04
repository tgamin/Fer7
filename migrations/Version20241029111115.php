<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029111115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_description ADD artical_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_description ADD CONSTRAINT FK_F7672A41F70C0DA7 FOREIGN KEY (artical_id) REFERENCES artical (id)');
        $this->addSql('CREATE INDEX IDX_F7672A41F70C0DA7 ON article_description (artical_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_description DROP FOREIGN KEY FK_F7672A41F70C0DA7');
        $this->addSql('DROP INDEX IDX_F7672A41F70C0DA7 ON article_description');
        $this->addSql('ALTER TABLE article_description DROP artical_id');
    }
}
