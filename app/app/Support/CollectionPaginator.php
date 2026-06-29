<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CollectionPaginator
{
    public static function paginate(Collection $items, int $perPage = 15, ?int $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: LengthAwarePaginator::resolveCurrentPage();
        $total = $items->count();
        $results = $items->forPage($page, $perPage)->values();

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
            ...$options,
        ]);
    }
}
