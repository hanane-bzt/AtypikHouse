<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716124643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reservation_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526CB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, payment_date DATETIME NOT NULL, amount NUMERIC(10, 2) NOT NULL, payment_method VARCHAR(255) NOT NULL, is_successful TINYINT(1) NOT NULL, INDEX IDX_6D28840DB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, habitat_id INT NOT NULL, option_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, INDEX IDX_9FF31636AFFE2D26 (habitat_id), INDEX IDX_9FF31636A7C41D6F (option_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BA7C41D6F');
        $this->addSql('ALTER TABLE habitat_option DROP FOREIGN KEY FK_F0D3A60BAFFE2D26');
        $this->addSql('DROP TABLE habitat_option');
        $this->addSql('DROP TABLE address');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E812469DE2');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A73F0036');
        $this->addSql('DROP INDEX IDX_3B37B2E8A73F0036 ON habitat');
        $this->addSql('DROP INDEX IDX_3B37B2E812469DE2 ON habitat');
        $this->addSql('ALTER TABLE habitat ADD name VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD price_per_night NUMERIC(10, 2) NOT NULL, ADD location VARCHAR(255) NOT NULL, DROP category_id, DROP ville_id, DROP title, DROP nombre_de_couchage, DROP price, DROP en_vente, DROP content, DROP created_at, DROP updated_at, DROP slug, DROP file, DROP address, CHANGE user_id user_id INT NOT NULL, CHANGE capacity capacity INT NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD payment_id INT DEFAULT NULL, ADD is_paid TINYINT(1) NOT NULL, DROP status, DROP created_at, DROP updated_at, DROP comments');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_4DA2394C3A3BB ON reservations (payment_id)');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT \'\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394C3A3BB');
        $this->addSql('CREATE TABLE habitat_option (habitat_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_F0D3A60BAFFE2D26 (habitat_id), INDEX IDX_F0D3A60BA7C41D6F (option_id), PRIMARY KEY(habitat_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, rue VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code_postal VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE habitat_option ADD CONSTRAINT FK_F0D3A60BAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB83297E7');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DB83297E7');
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636AFFE2D26');
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF31636A7C41D6F');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('ALTER TABLE user CHANGE api_token api_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_4DA2394C3A3BB ON reservations');
        $this->addSql('ALTER TABLE reservations ADD status VARCHAR(20) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD comments LONGTEXT DEFAULT NULL, DROP payment_id, DROP is_paid');
        $this->addSql('ALTER TABLE habitat ADD category_id INT DEFAULT NULL, ADD ville_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL, ADD nombre_de_couchage INT NOT NULL, ADD price NUMERIC(6, 2) NOT NULL, ADD en_vente TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD slug VARCHAR(255) NOT NULL, ADD file VARCHAR(255) DEFAULT NULL, ADD address LONGTEXT NOT NULL, DROP name, DROP price_per_night, DROP location, CHANGE user_id user_id INT DEFAULT NULL, CHANGE capacity capacity NUMERIC(6, 2) NOT NULL, CHANGE description content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A73F0036 ON habitat (ville_id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E812469DE2 ON habitat (category_id)');
    }
}
