<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181215201138 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE resourselinks (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cources (id INT AUTO_INCREMENT NOT NULL, region INT DEFAULT NULL, title VARCHAR(50) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_B583F93CF62F176 (region), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, surname VARCHAR(50) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, email VARCHAR(30) NOT NULL, photo VARCHAR(255) DEFAULT NULL, current_job VARCHAR(50) DEFAULT NULL, about VARCHAR(255) DEFAULT NULL, is_mentor TINYINT(1) DEFAULT \'0\' NOT NULL, home_works LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', UNIQUE INDEX UNIQ_1483A5E9444F97DD (phone), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, mentor INT DEFAULT NULL, title VARCHAR(50) NOT NULL, number INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, description VARCHAR(255) NOT NULL, notes LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', location_title VARCHAR(255) NOT NULL, location_logo VARCHAR(255) NOT NULL, location_long NUMERIC(10, 7) NOT NULL, location_lat NUMERIC(10, 7) NOT NULL, location_description VARCHAR(255) NOT NULL, location_wifi_name VARCHAR(255) NOT NULL, location_wifi_login VARCHAR(255) NOT NULL, location_wifi_password VARCHAR(255) NOT NULL, INDEX IDX_5387574A801562DE (mentor), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_resourselinks (event_id INT NOT NULL, resourselink_id INT NOT NULL, INDEX IDX_597D8C5071F7E88B (event_id), UNIQUE INDEX UNIQ_597D8C5030AB4D79 (resourselink_id), PRIMARY KEY(event_id, resourselink_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cources ADD CONSTRAINT FK_B583F93CF62F176 FOREIGN KEY (region) REFERENCES regions (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A801562DE FOREIGN KEY (mentor) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events_resourselinks ADD CONSTRAINT FK_597D8C5071F7E88B FOREIGN KEY (event_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE events_resourselinks ADD CONSTRAINT FK_597D8C5030AB4D79 FOREIGN KEY (resourselink_id) REFERENCES resourselinks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE events_resourselinks DROP FOREIGN KEY FK_597D8C5030AB4D79');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A801562DE');
        $this->addSql('ALTER TABLE cources DROP FOREIGN KEY FK_B583F93CF62F176');
        $this->addSql('ALTER TABLE events_resourselinks DROP FOREIGN KEY FK_597D8C5071F7E88B');
        $this->addSql('DROP TABLE resourselinks');
        $this->addSql('DROP TABLE cources');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE regions');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE events_resourselinks');
    }
}
