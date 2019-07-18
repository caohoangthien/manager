<?php

namespace App\Services\Frontend;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionService
{

    /**
     * Get transaction
     *
     * @return Collection
     */
    public function getTransactions()
    {
        return Transaction::where('company_id', Auth::user()->company_id)
            ->paginate(15,['money', 'reason', 'causer', 'note', 'status', 'date', 'created_at']);
    }
}
