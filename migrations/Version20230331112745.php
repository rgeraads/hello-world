<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230331112745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create post table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE post (
            id CHAR(36) NOT NULL,
            title VARCHAR(255),
            author_id CHAR(36) NOT NULL,
            body TEXT,
            status VARCHAR(255),
            published_at DATETIME,
            PRIMARY KEY(id))'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE post');
    }
}
