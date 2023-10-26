<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Transfer;
use Exception;

class TransferObserver
{

    public function creating(Transfer $transfer): void
    {
        //
        Account::where('id', $transfer->from_id)
            ->decrement('balance', $transfer->amount)
            || throw new Exception('Cannot update balance on source account.');
        //
        Account::where('id', $transfer->to_id)
            ->increment('balance', $transfer->amount)
            || throw new Exception('Cannot update balance on destination account.');
    }

    public function updating(Transfer $transfer): void
    {
        if ($transfer->isDirty('from_id')) {
            // 
            Account::where('id', $transfer->getOriginal('from_id'))
                ->increment('balance', $transfer->getOriginal('amount'))
                || throw new Exception('Cannot update balance on OLD source account.');
            //
            Account::where('id', $transfer->from_id)
                ->decrement('balance', $transfer->amount)
                || throw new Exception('Cannot update balance on NEW source account.');
        } elseif ($transfer->isDirty('amount')) {
            //
            Account::where('id', $transfer->from_id)
                ->increment('balance', $transfer->amount - $transfer->getOriginal('amount'))
                || throw new Exception('Cannot update balance on source account.');
        }

        if ($transfer->isDirty('to_id')) {
            //
            Account::where('id', $transfer->getOriginal('to_id'))
                ->decrement('balance', $transfer->getOriginal('amount'))
                || throw new Exception('Cannot update balance on OLD destination account.');
            //
            Account::where('id', $transfer->to_id)
                ->increment('balance', $transfer->amount)
                || throw new Exception('Cannot update balance on NEW destination account.');
        } elseif ($transfer->isDirty('amount')) {
            //
            Account::where('id', $transfer->to_id)
                ->decrement('balance', $transfer->amount - $transfer->getOriginal('amount'))
                || throw new Exception('Cannot update balance on destination account.');
        }
    }

    public function deleting(Transfer $transfer): void
    {
        //
        Account::where('id', $transfer->from_id)
            ->increment('balance', $transfer->amount)
            || throw new Exception('Cannot update balance on source account.');
        //
        Account::where('id', $transfer->to_id)
            ->decrement('balance', $transfer->amount)
            || throw new Exception('Cannot update balance on destination account.');
    }
}
