<?php

namespace App\Repositories\Service;

use App\Models\Service;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceRepository
{
    public function getServicesPaginated($page = 10)
    {
        return QueryBuilder::for(Service::class)
        ->paginate($page);
    }

    public function getAllServices()
    {
        return QueryBuilder::for(Service::class)
        ->get();
    }
}
