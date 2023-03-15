<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315211112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Provides table for reports';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'EOD'
            CREATE TABLE reports (
                id uuid NOT NULL,
                name VARCHAR(255) NOT NULL,
                payroll_entries jsonb NOT NULL,
                
                PRIMARY KEY(id));
            EOD);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE reports');
    }
}
