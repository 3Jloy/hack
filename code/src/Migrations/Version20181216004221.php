<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216004221 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_tickets ADD event INT DEFAULT NULL, ADD user INT DEFAULT NULL, ADD is_confirmed TINYINT(1) DEFAULT \'0\' NOT NULL, ADD is_visited TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE event_tickets ADD CONSTRAINT FK_D111345B3BAE0AA7 FOREIGN KEY (event) REFERENCES events (id)');
        $this->addSql('ALTER TABLE event_tickets ADD CONSTRAINT FK_D111345B8D93D649 FOREIGN KEY (user) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D111345B3BAE0AA7 ON event_tickets (event)');
        $this->addSql('CREATE INDEX IDX_D111345B8D93D649 ON event_tickets (user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_tickets DROP FOREIGN KEY FK_D111345B3BAE0AA7');
        $this->addSql('ALTER TABLE event_tickets DROP FOREIGN KEY FK_D111345B8D93D649');
        $this->addSql('DROP INDEX UNIQ_D111345B3BAE0AA7 ON event_tickets');
        $this->addSql('DROP INDEX IDX_D111345B8D93D649 ON event_tickets');
        $this->addSql('ALTER TABLE event_tickets DROP event, DROP user, DROP is_confirmed, DROP is_visited');
    }
}
