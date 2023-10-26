<?php

namespace App\Observers;

use Exception;
use App\Models\Account;
use App\Models\Activity;

class ActivityObserver
{

    public function creating(Activity $activity): void
    {
        //
        Account::where('id', $activity->account_id)
            ->increment('balance', $activity->debit - $activity->credit)
            || throw new Exception('Cannot update balance on source account.');
    }

    public function updating(Activity $activity): void
    {
        if ($activity->isDirty('account_id')) {
            //
            Account::where('id', $activity->getOriginal('account_id'))
                ->decrement('balance', $activity->getOriginal('debit') - $activity->getOriginal('credit'))
                || throw new Exception('Cannot update balance on OLD source account.');
            //
            Account::where('id', $activity->account_id)
                ->increment('balance', $activity->debit - $activity->credit)
                || throw new Exception('Cannot update balance on OLD source account.');
        }
        else if ($activity->isDirty('debit') || $activity->isDirty('credit')) {
            //
            Account::where('id', $activity->account_id)
                ->increment('balance', $activity->getOriginal('debit') - $activity->getOriginal('credit') - $activity->debit + $activity->credit)
                || throw new Exception('Cannot update balance on source account.');
        }
    }

    public function deleting(Activity $activity): void
    {
        //
        Account::where('id', $activity->account_id)
            ->decrement('balance', $activity->debit - $activity->credit)
            || throw new Exception('Cannot update balance on source account.');
    }

    public function restoring(Activity $activity): void
    {
        //
        Account::where('id', $activity->account_id)
            ->increment('balance', $activity->debit - $activity->credit)
            || throw new Exception('Cannot update balance on source account.');
    }

    public function forceDeleting(Activity $activity): void
    {
        //
        Account::where('id', $activity->account_id)
            ->decrement('balance', $activity->debit - $activity->credit)
            || throw new Exception('Cannot update balance on source account.');
    }
}
