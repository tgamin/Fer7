<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029103604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_type_artical (article_type_id INT NOT NULL, artical_id INT NOT NULL, INDEX IDX_3525D0EB289EC824 (article_type_id), INDEX IDX_3525D0EBF70C0DA7 (artical_id), PRIMARY KEY(article_type_id, artical_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_type_artical ADD CONSTRAINT FK_3525D0EB289EC824 FOREIGN KEY (article_type_id) REFERENCES article_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_type_artical ADD CONSTRAINT FK_3525D0EBF70C0DA7 FOREIGN KEY (artical_id) REFERENCES artical (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_type_artical DROP FOREIGN KEY FK_3525D0EB289EC824');
        $this->addSql('ALTER TABLE article_type_artical DROP FOREIGN KEY FK_3525D0EBF70C0DA7');
        $this->addSql('DROP TABLE article_type');
        $this->addSql('DROP TABLE article_type_artical');
    }
}
