<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Spatie\QueryBuilder\QueryBuilder;

class ClientRepository
{
    public function getClientsPaginated()
    {
        return QueryBuilder::for(Client::class)
        ->paginate(request()->input("pagination", 10));
    }

    public function getClients()
    {
        return QueryBuilder::for(Client::class)
        ->get();
    }

}
