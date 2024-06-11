<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607093642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays CHANGE slug code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ville ADD latitude NUMERIC(10, 7) NOT NULL, ADD longitude NUMERIC(10, 7) NOT NULL, CHANGE pays_id pays_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville DROP latitude, DROP longitude, CHANGE pays_id pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pays CHANGE code slug VARCHAR(255) NOT NULL');
    }
}
