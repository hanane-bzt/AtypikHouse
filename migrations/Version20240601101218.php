<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601101218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat ADD ville_id INT DEFAULT NULL, ADD address LONGTEXT NOT NULL, ADD code_postal VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A73F0036 ON habitat (ville_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A73F0036');
        $this->addSql('DROP INDEX IDX_3B37B2E8A73F0036 ON habitat');
        $this->addSql('ALTER TABLE habitat DROP ville_id, DROP address, DROP code_postal');
    }
}
