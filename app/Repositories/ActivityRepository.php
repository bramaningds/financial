<?php

namespace App\Repositories;

class ActivityRepository extends TransactionableRepository
{
    protected $with = ['user', 'account', 'category'];
    protected $paginate = true;
}
