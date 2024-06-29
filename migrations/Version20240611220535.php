<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611220535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(100) NOT NULL, slug VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal VARCHAR(10) NOT NULL, pays VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat_option (habitat_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_F0D3A60BAFFE2D26 (habitat_id), INDEX IDX_F0D3A60BA7C41D6F (option_id), PRIMARY KEY(habitat_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, rs VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_43C3D9C3A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE habitat ADD ville_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD address LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A73F0036 ON habitat (ville_id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A76ED395 ON habitat (user_id)');
        $this->addSql('ALTER TABLE user ADD profile_id INT DEFAULT NULL, ADD api_token VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CCFA12B8 ON user (profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A73F0036');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BAFFE2D26');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BA7C41D6F');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE habitat_option');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP INDEX UNIQ_8D93D649CCFA12B8 ON user');
        $this->addSql('ALTER TABLE user DROP profile_id, DROP api_token');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A76ED395');
        $this->addSql('DROP INDEX IDX_3B37B2E8A73F0036 ON habitat');
        $this->addSql('DROP INDEX IDX_3B37B2E8A76ED395 ON habitat');
        $this->addSql('ALTER TABLE habitat DROP ville_id, DROP user_id, DROP address');
    }
}
