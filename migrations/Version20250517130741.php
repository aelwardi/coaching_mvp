<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250517130741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE coach (id SERIAL NOT NULL, usere_id INT DEFAULT NULL, speciality VARCHAR(255) NOT NULL, description TEXT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3F596DCC12C1BC7E ON coach (usere_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC12C1BC7E FOREIGN KEY (usere_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
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
            DROP TABLE coach
        SQL);
    }
}
