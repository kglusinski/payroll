<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

interface PayrollReportRepository
{
    public function findByName(string $name): ?PayrollReport;
    public function save(PayrollReport $report): void;
}