<?php

namespace App\Http\Controllers\Repositories;

use App\Models\User;
use App\Models\Account;
use App\Models\Activity;
use App\Models\Category;
use App\Http\Requests\BrowseRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends RepositoryController
{

    public function index(BrowseRequest $request)
    {
        $request->merge(['period' => $request->input('period') ?? 'this-month']);

        return view('activity', [
            'accounts'      => Account::all(),
            'activities'    => $this->repository->browse($request->all()),
            'categories'    => Category::OfActivityType($request->input('activity_type'))->get(),
            'users'         => User::all(),
        ]);
    }

    public function create()
    {
        if (! request()->input('activity_type', false)) {
            return abort(404);
        }

        return view('activity-' . request()->input('activity_type') . '-form', [
            'accounts'      => Account::get(),
            'categories'    => Category::ofActivityType(request()->input('activity_type'))->get(),
        ]);
    }

    public function store(StoreActivityRequest $request)
    {
        $this->repository->store(
            array_merge($request->validated(), ['user_id' => $request->user()->id])
        );

        return redirect('/activity');
    }

    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        return view("activity-{$activity->activity_type}-form", [
            'activity'      => $activity,
            'accounts'      => Account::withTrashed()->get(),
            'categories'    => Category::withTrashed()->ofActivityType($activity->activity_type)->get(),
        ]);
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $this->authorize('update', $activity);

        $this->repository->update($activity, $request->validated());

        return redirect('/activity');
    }

    public function destroy(Activity $activity)
    {
        $this->authorize('delete', $activity);

        $this->repository->delete($activity);

        return redirect('/activity');
    }
}
