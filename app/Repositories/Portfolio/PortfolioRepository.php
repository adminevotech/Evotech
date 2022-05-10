<?php

namespace App\Repositories\Portfolio;

use App\Models\Portfolio;
use Spatie\QueryBuilder\QueryBuilder;

class PortfolioRepository
{
    public function getPortfoliosPaginated()
    {
        return QueryBuilder::for(Portfolio::class)
        ->allowedFilters(['service_id', 'active'])
        ->paginate(request()->input("pagination", 10));
    }

    public function getPortfolios()
    {
        return QueryBuilder::for(Portfolio::class)
        ->allowedFilters(['service_id', 'active'])
        ->get();
    }

}
