<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201162532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_server (id INT AUTO_INCREMENT NOT NULL, client_header VARCHAR(20) NOT NULL, server_header VARCHAR(20) NOT NULL, client_token VARCHAR(100) NOT NULL, server_token VARCHAR(100) NOT NULL, server_host VARCHAR(100) NOT NULL, current_host VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remote_event (id INT AUTO_INCREMENT NOT NULL, status INT NOT NULL, count_attempts INT NOT NULL, hash VARCHAR(255) NOT NULL, event_name VARCHAR(255) NOT NULL, data LONGTEXT NOT NULL, created DATETIME NOT NULL, retry_date INT DEFAULT NULL, INDEX status_count_idx (status, count_attempts), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_server');
        $this->addSql('DROP TABLE remote_event');
    }
}
