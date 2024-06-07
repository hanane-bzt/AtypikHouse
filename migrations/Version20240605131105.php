<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605131105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habitat_option (habitat_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_F0D3A60BAFFE2D26 (habitat_id), INDEX IDX_F0D3A60BA7C41D6F (option_id), PRIMARY KEY(habitat_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A7C41D6F');
        $this->addSql('DROP INDEX IDX_3B37B2E8A7C41D6F ON habitat');
        $this->addSql('ALTER TABLE habitat DROP option_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BAFFE2D26');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BA7C41D6F');
        $this->addSql('DROP TABLE habitat_option');
        $this->addSql('ALTER TABLE habitat ADD option_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A7C41D6F ON habitat (option_id)');
    }
}
