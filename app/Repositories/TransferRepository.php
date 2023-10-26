<?php

namespace App\Repositories;

class TransferRepository extends TransactionableRepository
{

    protected $with = ['user', 'from_account', 'to_account'];
    protected $paginate = true;
}
