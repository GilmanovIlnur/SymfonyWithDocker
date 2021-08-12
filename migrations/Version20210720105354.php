<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720105354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE wall_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE wall_message (id INT NOT NULL, user_id INT DEFAULT NULL, message VARCHAR(1000) NOT NULL, time DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6C067FC9A76ED395 ON wall_message (user_id)');
        $this->addSql('ALTER TABLE wall_message ADD CONSTRAINT FK_6C067FC9A76ED395 FOREIGN KEY (user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE wall_message_id_seq CASCADE');
        $this->addSql('DROP TABLE wall_message');
    }
}
