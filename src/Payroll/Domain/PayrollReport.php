<?php
declare(strict_types=1);

namespace App\Payroll\Domain;

use App\Common\Identity;

class PayrollReport
{
    public readonly Identity $id;

    public readonly string $name;
    /** @var PayrollEntry[] */
    private array $payrollEntries;

    public function __construct(Identity $id, \DateTimeImmutable $date)
    {
        $this->id = $id;
        $this->name = $date->format('F Y');
        $this->payrollEntries = [];
    }

    public function addPayrollEntry(PayrollEntry $payrollEntry): void
    {
        $this->payrollEntries[] = $payrollEntry;
    }

    /**
     * @return PayrollEntry[]
     */
    public function getPayrollEntries(): array
    {
        return $this->payrollEntries;
    }

    public function filter(string $field, mixed $value): void
    {
        $this->payrollEntries = array_filter($this->payrollEntries, function (PayrollEntry $payrollEntry) use ($field, $value) {
            return $payrollEntry->$field === $value;
        });
    }

    public function sort(string $field, string $direction = 'asc'): void
    {
        usort($this->payrollEntries, function (PayrollEntry $payrollEntry1, PayrollEntry $payrollEntry2) use ($field, $direction) {
            if ($payrollEntry1->$field === $payrollEntry2->$field) {
                return 0;
            }

            if ($direction === 'asc') {
                return $payrollEntry1->$field < $payrollEntry2->$field ? -1 : 1;
            }

            return $payrollEntry1->$field < $payrollEntry2->$field ? 1 : -1;
        });
    }
}