<?php

namespace App\Models\Scopes;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();
        # for Admin ...
        if ($user->store_id == 2) {
            $builder->where('store_id', '!=', $user->store_id)
                    ->orwhere('store_id', NULL);
        } elseif ($user->store_id) {
            $builder->where('store_id', $user->store_id);
        }
    }
}