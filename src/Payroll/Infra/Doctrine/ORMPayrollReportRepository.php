<?php
declare(strict_types=1);

namespace App\Payroll\Infra\Doctrine;

use App\Payroll\Domain\PayrollReport;
use App\Payroll\Domain\PayrollReportRepository;
use Doctrine\ORM\EntityManagerInterface;

class ORMPayrollReportRepository implements PayrollReportRepository
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    public function save(PayrollReport $report): void
    {
        $this->em->persist($report);
        $this->em->flush();
    }

    public function findByName(string $name): ?PayrollReport
    {
        return $this->em->createQueryBuilder()
            ->select('r')
            ->from(PayrollReport::class, 'r')
            ->where('r.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }
}