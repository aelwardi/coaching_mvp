<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250517144629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE seance (id SERIAL NOT NULL, programme_id INT DEFAULT NULL, date DATE NOT NULL, start_at TIME(0) WITHOUT TIME ZONE NOT NULL, end_at TIME(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DF7DFD0E62BB7AEE ON seance (programme_id)
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
            ALTER TABLE seance DROP CONSTRAINT FK_DF7DFD0E62BB7AEE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE seance
        SQL);
    }
}
