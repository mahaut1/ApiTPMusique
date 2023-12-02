<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202130951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album ADD artiste_id INT NOT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E4321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_39986E4321D25844 ON album (artiste_id)');
        $this->addSql('ALTER TABLE song ADD song_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA1A0BDB2F3 FOREIGN KEY (song_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_33EDEEA1A0BDB2F3 ON song (song_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E4321D25844');
        $this->addSql('DROP INDEX IDX_39986E4321D25844 ON album');
        $this->addSql('ALTER TABLE album DROP artiste_id');
        $this->addSql('ALTER TABLE song DROP FOREIGN KEY FK_33EDEEA1A0BDB2F3');
        $this->addSql('DROP INDEX IDX_33EDEEA1A0BDB2F3 ON song');
        $this->addSql('ALTER TABLE song DROP song_id');
    }
}
