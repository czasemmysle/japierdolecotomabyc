<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522001056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE vm_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE backup_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vm (id INT NOT NULL, id_vm INT NOT NULL, nazwa_vm VARCHAR(255) NOT NULL, ip VARCHAR(15) DEFAULT NULL, klucz_ssh VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plan (id INT NOT NULL, etykieta_plan VARCHAR(255) NOT NULL, data_start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, lista_vm TEXT NOT NULL, ip_storage_f VARCHAR(15) NOT NULL, ip_storage_db VARCHAR(15) NOT NULL, ip_storage_vm VARCHAR(15) NOT NULL, ip_final_storage VARCHAR(15) NOT NULL, flag INT NOT NULL, number INT DEFAULT NULL, interval VARCHAR(20) DEFAULT NULL, days TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN plan.lista_vm IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN plan.days IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE backup (id INT NOT NULL, plan_id INT NOT NULL, vm_id INT NOT NULL, id_vm INT NOT NULL, data DATE NOT NULL, hash VARCHAR(5) NOT NULL, etykieta_plan VARCHAR(255) NOT NULL, fbackup INT NOT NULL, komunikat TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3FF0D1ACE899029B ON backup (plan_id)');
        $this->addSql('CREATE INDEX IDX_3FF0D1ACE0FCD18E ON backup (vm_id)');
        $this->addSql('ALTER TABLE backup ADD CONSTRAINT FK_3FF0D1ACE899029B FOREIGN KEY (plan_id) REFERENCES plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE backup ADD CONSTRAINT FK_3FF0D1ACE0FCD18E FOREIGN KEY (vm_id) REFERENCES vm (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE backup DROP CONSTRAINT FK_3FF0D1ACE0FCD18E');
        $this->addSql('ALTER TABLE backup DROP CONSTRAINT FK_3FF0D1ACE899029B');
        $this->addSql('DROP SEQUENCE vm_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plan_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE backup_id_seq CASCADE');
        $this->addSql('DROP TABLE vm');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE backup');
    }
}
