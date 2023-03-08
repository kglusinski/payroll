<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308144911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Provides table for departments';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'EOD'
            CREATE TABLE employees (
                id uuid NOT NULL,
                name VARCHAR(255) NOT NULL,
                surname VARCHAR(255) NOT NULL,
                salary INT NOT NULL,
                department_id uuid NOT NULL,
                employment_date DATE NOT NULL,
                
                PRIMARY KEY(id));
            EOD);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE employees');
    }
}
