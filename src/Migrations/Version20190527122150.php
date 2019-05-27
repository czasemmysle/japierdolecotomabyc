<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527122150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE backup (id INT AUTO_INCREMENT NOT NULL, plan_id INT NOT NULL, vm_id INT NOT NULL, id_vm INT NOT NULL, data DATE NOT NULL, hash VARCHAR(5) NOT NULL, etykieta_plan VARCHAR(255) NOT NULL, fbackup INT NOT NULL, komunikat LONGTEXT DEFAULT NULL, INDEX IDX_3FF0D1ACE899029B (plan_id), INDEX IDX_3FF0D1ACE0FCD18E (vm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, etykieta_plan VARCHAR(255) NOT NULL, data_start DATETIME NOT NULL, lista_vm LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ip_storage_f VARCHAR(15) NOT NULL, ip_storage_db VARCHAR(15) NOT NULL, ip_storage_vm VARCHAR(15) NOT NULL, ip_final_storage VARCHAR(15) NOT NULL, flag INT NOT NULL, number INT DEFAULT NULL, `interval` VARCHAR(20) DEFAULT NULL, days LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vm (id INT AUTO_INCREMENT NOT NULL, id_vm INT NOT NULL, nazwa_vm VARCHAR(255) NOT NULL, ip VARCHAR(15) DEFAULT NULL, klucz_ssh VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE backup ADD CONSTRAINT FK_3FF0D1ACE899029B FOREIGN KEY (plan_id) REFERENCES plan (id)');
        $this->addSql('ALTER TABLE backup ADD CONSTRAINT FK_3FF0D1ACE0FCD18E FOREIGN KEY (vm_id) REFERENCES vm (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE backup DROP FOREIGN KEY FK_3FF0D1ACE899029B');
        $this->addSql('ALTER TABLE backup DROP FOREIGN KEY FK_3FF0D1ACE0FCD18E');
        $this->addSql('DROP TABLE backup');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE vm');
    }
}
