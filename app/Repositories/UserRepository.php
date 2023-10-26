<?php

namespace App\Repositories;

class UserRepository extends Repository
{

    protected $with = [
        'latest_activity',
        'this_month_activities',
        'latest_transfer',
        'this_month_transfers'
    ];
}
