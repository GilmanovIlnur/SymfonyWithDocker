<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413180950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE friend_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE friend (id INT NOT NULL, user_id_id INT NOT NULL, friend_id_id INT NOT NULL, add_time DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_55EEAC619D86650F ON friend (user_id_id)');
        $this->addSql('CREATE INDEX IDX_55EEAC61DFD406F3 ON friend (friend_id_id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC619D86650F FOREIGN KEY (user_id_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61DFD406F3 FOREIGN KEY (friend_id_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE friend_id_seq CASCADE');

        $this->addSql('DROP TABLE friend');
    }
}
