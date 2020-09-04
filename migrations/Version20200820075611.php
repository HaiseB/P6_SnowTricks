<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200820075611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trick (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, tag_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, content MEDIUMTEXT NOT NULL, is_online TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_D8F0A91E9D86650F (user_id_id), INDEX IDX_D8F0A91E5DA88751 (tag_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E5DA88751 FOREIGN KEY (tag_id_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE trick');
    }
}
