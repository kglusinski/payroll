<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308095139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Provides table for departments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'EOD'
            CREATE TYPE salary_bonus_type AS ENUM (
                'fixed',
                'percentage'
            );
        EOD);

        $this->addSql(<<<'EOD'
            CREATE TABLE departments (
                id uuid NOT NULL,
                name VARCHAR(255) NOT NULL,
                salary_bonus_type salary_bonus_type NOT NULL,
                salary_bonus_value int NOT NULL,
                PRIMARY KEY(id));
            EOD);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TYPE salary_bonus_type');
    }
}
