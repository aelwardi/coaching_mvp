<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250516144614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE coach (id SERIAL NOT NULL, usere_id INT DEFAULT NULL, speciality VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_3F596DCC12C1BC7E ON coach (usere_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE programme (id SERIAL NOT NULL, coach_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3DDCB9FF3C105691 ON programme (coach_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE seance (id SERIAL NOT NULL, usere_id INT DEFAULT NULL, programme_id INT DEFAULT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DF7DFD0E12C1BC7E ON seance (usere_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DF7DFD0E62BB7AEE ON seance (programme_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, is_banned BOOLEAN NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC12C1BC7E FOREIGN KEY (usere_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF3C105691 FOREIGN KEY (coach_id) REFERENCES coach (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E12C1BC7E FOREIGN KEY (usere_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coach DROP CONSTRAINT FK_3F596DCC12C1BC7E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme DROP CONSTRAINT FK_3DDCB9FF3C105691
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE seance DROP CONSTRAINT FK_DF7DFD0E12C1BC7E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE seance DROP CONSTRAINT FK_DF7DFD0E62BB7AEE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coach
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE programme
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE seance
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
    }
}
