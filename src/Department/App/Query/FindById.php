<?php
declare(strict_types=1);

namespace App\Department\App\Query;

use App\Common\Identity;

class FindById
{
    public function __construct(
        public readonly Identity $id,
    ) {}
}