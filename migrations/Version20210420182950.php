<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420182950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE friend_id_seq CASCADE');
        $this->addSql('DROP TABLE friend');
        $this->addSql('ALTER TABLE usr ADD friend_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usr ADD CONSTRAINT FK_1762498C6A5458E8 FOREIGN KEY (friend_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1762498C6A5458E8 ON usr (friend_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE friend_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE friend (id INT NOT NULL, user_id INT NOT NULL, friend_id INT NOT NULL, add_time DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_55eeac619d86650f ON friend (user_id)');
        $this->addSql('CREATE INDEX idx_55eeac61dfd406f3 ON friend (friend_id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT fk_55eeac619d86650f FOREIGN KEY (user_id) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT fk_55eeac61dfd406f3 FOREIGN KEY (friend_id) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "usr" DROP CONSTRAINT FK_1762498C6A5458E8');
        $this->addSql('DROP INDEX IDX_1762498C6A5458E8');
        $this->addSql('ALTER TABLE "usr" DROP friend_id');
    }
}
