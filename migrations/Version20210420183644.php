<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420183644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friends (user_id INT NOT NULL, friend_user_id INT NOT NULL, PRIMARY KEY(user_id, friend_user_id))');
        $this->addSql('CREATE INDEX IDX_21EE7069A76ED395 ON friends (user_id)');
        $this->addSql('CREATE INDEX IDX_21EE706993D1119E ON friends (friend_user_id)');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE7069A76ED395 FOREIGN KEY (user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE friends ADD CONSTRAINT FK_21EE706993D1119E FOREIGN KEY (friend_user_id) REFERENCES "usr" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usr DROP CONSTRAINT fk_1762498c6a5458e8');
        $this->addSql('DROP INDEX idx_1762498c6a5458e8');
        $this->addSql('ALTER TABLE usr DROP friend_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE friends');
        $this->addSql('ALTER TABLE "usr" ADD friend_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "usr" ADD CONSTRAINT fk_1762498c6a5458e8 FOREIGN KEY (friend_id) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1762498c6a5458e8 ON "usr" (friend_id)');
    }
}
