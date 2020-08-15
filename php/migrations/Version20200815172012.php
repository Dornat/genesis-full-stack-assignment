<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200815172012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_astrologer (service_id INT NOT NULL, astrologer_id INT NOT NULL, INDEX IDX_FC010D35ED5CA9E6 (service_id), INDEX IDX_FC010D3556F716EE (astrologer_id), PRIMARY KEY(service_id, astrologer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_astrologer ADD CONSTRAINT FK_FC010D35ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_astrologer ADD CONSTRAINT FK_FC010D3556F716EE FOREIGN KEY (astrologer_id) REFERENCES astrologer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_astrologer DROP FOREIGN KEY FK_FC010D35ED5CA9E6');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_astrologer');
    }
}
