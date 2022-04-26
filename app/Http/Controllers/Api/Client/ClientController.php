<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Client\ShowClientResource;
use App\Models\Client;
use App\Repositories\Client\ClientRepository;
use Illuminate\Http\Request;

/**
 * @group Client Module
 */
class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Get All Clients
     *
     * @apiResourceCollection App\Http\Resources\Client\ClientResource
     * @apiResourceModel App\Models\Client
     */
    public function index(Request $request)
    {
        return ok_response($this->all($request));
    }

    /**
     * Show Client
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Client\ShowClientResource
     * @apiResourceModel App\Models\Client
     * @responseFile 404 scenario="not found Client " responses/not_found.json
     * */
    public function show(Client $client)
    {
        return ok_response(new ShowClientResource($client));
    }

    private function all($request){
        return collectionFormat(ClientResource::class, $this->clientRepository->getClients($request));
    }
}
