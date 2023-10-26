<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Requests\BrowseRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends RepositoryController
{

    public function index(BrowseRequest $request)
    {
        return view('category', [
            'categories' => $this->repository->browse($request->all())
        ]);
    }

    public function create()
    {
        return view('category-form');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect('/category');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('category-form', [
            'category' => $this->repository->find($id)
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->repository->update($id, $request->validated());

        return redirect('/category');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect('/category');
    }
}
