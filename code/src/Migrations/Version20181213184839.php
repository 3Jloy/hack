<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181213184839 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, email_confirmed TINYINT(1) DEFAULT \'0\' NOT NULL, avatar VARCHAR(255) DEFAULT NULL, social_fb VARCHAR(255) DEFAULT NULL, social_tw VARCHAR(255) DEFAULT NULL, social_ok VARCHAR(255) DEFAULT NULL, social_gl VARCHAR(255) DEFAULT NULL, social_vk VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9444F97DD (phone), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX credentials_idx (phone, email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
    }
}
