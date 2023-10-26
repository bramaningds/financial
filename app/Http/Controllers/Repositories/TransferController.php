<?php

namespace App\Http\Controllers\Repositories;

use App\Models\User;
use App\Models\Account;
use App\Http\Requests\BrowseRequest;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;

class TransferController extends RepositoryController
{

    public function index(BrowseRequest $request)
    {
        $request->merge(['period' => request('period') ?? 'this-month']);

        return view('transfer', [
            'transfers' => $this->repository->browse($request->all()),
            'users' => User::withTrashed()->get(),
            'accounts' => Account::withTrashed()->get(),
        ]);
    }


    public function create()
    {
        return view('transfer-form', [
            'accounts' => Account::withTrashed()->get(),
        ]);
    }

    public function store(StoreTransferRequest $request)
    {
        $this->repository->store(
            array_merge($request->validated(), ['user_id' => $request->user()->id])
        );

        return redirect('/transfer');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('transfer-form', [
            'transfer' => $this->repository->find($id),
            'accounts' => Account::withTrashed()->get(),
        ]);
    }

    public function update(UpdateTransferRequest $request, $id)
    {
        $transfer = $this->repository->find($id);

        $this->authorize('update', $transfer);

        $this->repository->update($transfer, $request->validated());

        return redirect('/transfer');
    }

    public function destroy($id)
    {
        $transfer = $this->repository->find($id);

        $this->authorize('delete', $transfer);

        $this->repository->delete($id);

        return redirect('/transfer');
    }
}
