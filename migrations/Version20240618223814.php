<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618223814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, habitat_id INT NOT NULL, commodite_id INT  NOT NULL, quantity DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, INDEX IDX_9FF31636AFFE2D26 (habitat_id), INDEX IDX_9FF31636AE632A35 (commodite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636AE632A35 FOREIGN KEY (commodite_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT \'\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636AFFE2D26');
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636AE632A35');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) NOT NULL');
    }
}
