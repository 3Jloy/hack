<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216033253 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, event INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_11BA68C8D93D649 (user), INDEX IDX_11BA68C3BAE0AA7 (event), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C8D93D649 FOREIGN KEY (user) REFERENCES users (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C3BAE0AA7 FOREIGN KEY (event) REFERENCES events (id)');
        $this->addSql('ALTER TABLE events DROP notes');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE notes');
        $this->addSql('ALTER TABLE events ADD notes LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:simple_array)\'');
    }
}
