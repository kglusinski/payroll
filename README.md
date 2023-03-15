# Payroll System

This is a payroll system that calculates the salary of an employee based on the experience and department of the employee.

## Pre-requisites
- PHP 8.2
- Docker & Docker Compose
- Composer

## Run application
```bash
$ composer install
$ composer run start
```

## Commands
Find single employee by id
```bash
$ php bin/console app:employee:find-by-id <uuid>
```

```bash
$ php bin/console app:payroll:get [date] [--options]

Arguments:
    date                Optional: Date in format YYYY-MM-DD (default: today)

Options:
  --sortBy <value>      Optional: Sort by any of: employeeName, surname, department, baseSalary, bonusType, bonusValue, totalSalary
  --sortDir <value>     Optional: Sort direction: asc or desc (default: asc)
  --filterBy <value>    Optional: Filter by department, name, or surname
  --filterValue <value> Filter value for filterBy option
  
Example:
$ php bin/console app:payroll:get --sortBy=department --sortDir=desc --filterBy=name --filterValue=Joe
```

### TODO:
- [ ] Use eg. `moneyphp/money` for `MoneyValue`
- [ ] Add validation
- [ ] extract filtering and sorting out of the `PayrollReport`
- [ ] Add proper error handling. Make use of `munusphp/munus`
- [ ] More commands and queires in Employee and Department areas
- [ ] Dockerize application
- [ ] Add ADR
