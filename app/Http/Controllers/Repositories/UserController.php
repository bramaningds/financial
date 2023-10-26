<?php

namespace App\Http\Controllers\Repositories;

use App\Models\User;
use App\Http\Requests\BrowseRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends RepositoryController
{

    public function index(BrowseRequest $request)
    {
        $this->authorize('viewAny', User::class);

        return view('user', [
            'users' => $this->repository->browse($request->all())
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('user-form');
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $this->repository->store($request->validated());

        return redirect('/user');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('user-form', [
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $this->repository->update($user, $request->validated());

        return redirect('/user');
    }

    public function destroy(User $user)
    {
        $this->authorize('update', $user);

        $this->repository->delete($user);

        return redirect('/user');
    }
}
