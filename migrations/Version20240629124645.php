<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240629124645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, habitat_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, total_price NUMERIC(10, 2) NOT NULL, INDEX IDX_4DA239A76ED395 (user_id), INDEX IDX_4DA239AFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A76ED395');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239AFFE2D26');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) NOT NULL');
    }
}
