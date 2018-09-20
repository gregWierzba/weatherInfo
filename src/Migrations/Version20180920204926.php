<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180920204926 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE location (id INT NOT NULL, lat NUMERIC(6, 3) NOT NULL, lon NUMERIC(6, 3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE city ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city DROP lat');
        $this->addSql('ALTER TABLE city DROP lon');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023464D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B023464D218E ON city (location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B023464D218E');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP INDEX UNIQ_2D5B023464D218E');
        $this->addSql('ALTER TABLE city ADD lat NUMERIC(6, 3) NOT NULL');
        $this->addSql('ALTER TABLE city ADD lon NUMERIC(6, 3) NOT NULL');
        $this->addSql('ALTER TABLE city DROP location_id');
    }
}
