<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230404091533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create author table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE author (
            id CHAR(36) NOT NULL,
            first_name VARCHAR(255),
            last_name VARCHAR(255),
            PRIMARY KEY(id))'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE author');
    }
}
