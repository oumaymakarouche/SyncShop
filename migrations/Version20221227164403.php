<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227164403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, discount DOUBLE PRECISION NOT NULL, item VARCHAR(255) NOT NULL, item_description VARCHAR(255) NOT NULL, quantity INT NOT NULL, unit_code VARCHAR(20) NOT NULL, unit_description VARCHAR(50) NOT NULL, unit_price DOUBLE PRECISION NOT NULL, vatamount DOUBLE PRECISION NOT NULL, vatpercentage DOUBLE PRECISION NOT NULL, INDEX IDX_23A0E66FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, idcontact VARCHAR(40) NOT NULL, account_name VARCHAR(255) NOT NULL, address_line1 VARCHAR(255) NOT NULL, address_line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(20) NOT NULL, contact_name VARCHAR(255) NOT NULL, country VARCHAR(100) NOT NULL, zip_code VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, deliver_to_id INT NOT NULL, amount INT NOT NULL, currency VARCHAR(10) NOT NULL, order_id VARCHAR(255) NOT NULL, order_number INT NOT NULL, INDEX IDX_F52993986D7914CF (deliver_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986D7914CF FOREIGN KEY (deliver_to_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FCDAEAAA');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986D7914CF');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE `order`');
    }
}
