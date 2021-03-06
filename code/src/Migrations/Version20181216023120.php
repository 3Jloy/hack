<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216023120 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD mentor INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9801562DE FOREIGN KEY (mentor) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9801562DE ON users (mentor)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9801562DE');
        $this->addSql('DROP INDEX IDX_1483A5E9801562DE ON users');
        $this->addSql('ALTER TABLE users DROP mentor');
    }
}
