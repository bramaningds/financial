<?php

namespace App\Repositories;

class CategoryRepository extends Repository
{
    protected $with = ['latest_activity', 'this_month_activities'];
}
