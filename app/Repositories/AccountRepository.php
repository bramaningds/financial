<?php

namespace App\Repositories;

class AccountRepository extends Repository
{
    protected $with = [
        'latest_activity',
        'this_month_activities',
        'latest_transfer_in',
        'this_month_transfers_in',
        'latest_transfer_out',
        'this_month_transfers_out',
    ];
}
