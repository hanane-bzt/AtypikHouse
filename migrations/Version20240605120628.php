<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605120628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A73F0036');
        $this->addSql('ALTER TABLE habitat ADD option_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A7C41D6F ON habitat (option_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A7C41D6F');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A73F0036');
        $this->addSql('DROP INDEX IDX_3B37B2E8A7C41D6F ON habitat');
        $this->addSql('ALTER TABLE habitat DROP option_id');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
    }
}
