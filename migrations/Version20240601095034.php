<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601095034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays ADD slug VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ville ADD pays_id INT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD file VARCHAR(255) DEFAULT NULL, DROP nom, CHANGE pays name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C3A6E44244 ON ville (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3A6E44244');
        $this->addSql('DROP INDEX IDX_43C3D9C3A6E44244 ON ville');
        $this->addSql('ALTER TABLE ville ADD nom VARCHAR(100) NOT NULL, ADD pays VARCHAR(255) NOT NULL, DROP pays_id, DROP name, DROP slug, DROP created_at, DROP updated_at, DROP file');
        $this->addSql('ALTER TABLE pays ADD nom VARCHAR(255) NOT NULL, DROP name, DROP slug, DROP created_at, DROP updated_at');
    }
}
