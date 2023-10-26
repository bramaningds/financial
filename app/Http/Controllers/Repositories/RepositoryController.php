<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Controllers\Controller;

class RepositoryController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ('App\\Repositories\\' . str_replace([__NAMESPACE__, 'Controller', '\\'], '', get_class($this)) . 'Repository');
    }

}