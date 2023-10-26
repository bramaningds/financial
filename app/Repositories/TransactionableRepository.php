<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class TransactionableRepository extends Repository {

    public function store(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            return parent::store($attributes);
        });
    }

    public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
            return parent::update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            return parent::delete($id);
        });
    }

}