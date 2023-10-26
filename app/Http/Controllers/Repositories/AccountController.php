<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Requests\BrowseRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends RepositoryController
{

    public function index(BrowseRequest $request)
    {
        return view('account', [
            'accounts' => $this->repository->browse($request->all())
        ]);
    }

    public function create()
    {
        return view('account-form');
    }

    public function store(StoreAccountRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect('/account');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('account-form', [
            'account' => $this->repository->find($id)
        ]);
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $this->repository->update($id, $request->validated());

        return redirect('/account');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect('/account');
    }
}
