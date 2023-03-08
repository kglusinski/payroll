<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

class PayrollReport
{
    private array $payrollEntries;

    public function __construct()
    {
        $this->payrollEntries = [];
    }

    public function addPayrollEntry(PayrollEntry $payrollEntry): void
    {
        $this->payrollEntries[] = $payrollEntry;
    }

    public function getPayrollEntries(): array
    {
        return $this->payrollEntries;
    }
}