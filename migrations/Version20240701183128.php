<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701183128 extends AbstractMigration
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
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636AE632A35');
        $this->addSql('DROP INDEX IDX_9FF31636AE632A35 ON quantity');
        $this->addSql('ALTER TABLE quantity ADD option_id INT DEFAULT NULL, DROP commodite_id');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_9FF31636A7C41D6F ON quantity (option_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BAFFE2D26');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BA7C41D6F');
        $this->addSql('DROP TABLE habitat_option');
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636A7C41D6F');
        $this->addSql('DROP INDEX IDX_9FF31636A7C41D6F ON quantity');
        $this->addSql('ALTER TABLE quantity ADD commodite_id INT NOT NULL, DROP option_id');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636AE632A35 FOREIGN KEY (commodite_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_9FF31636AE632A35 ON quantity (commodite_id)');
    }
}
