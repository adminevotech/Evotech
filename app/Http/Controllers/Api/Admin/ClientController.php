<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreClient;
use App\Http\Requests\Admin\Client\UpdateClient;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Client\ShowClientResource;
use App\Models\Client;
use App\Repositories\Client\ClientRepository;
use App\Services\ClientService;
use Illuminate\Http\Request;


/**
 * @group Admin Client Module
 */
class ClientController extends Controller
{
    protected $clientRepository;
    protected $clientService;

    public function __construct(ClientRepository $clientRepository, ClientService $clientService) {
        $this->authorizeResource(Client::class, "client");
        $this->clientRepository = $clientRepository;
        $this->clientService = $clientService;
    }

    /**
     * Get All Clients
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Client\ClientResource
     * @apiResourceModel App\Models\Client paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     */
    public function index()
    {
        return ok_response($this->all());
    }

    /**
     * Create Client
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection 201 App\Http\Resources\Client\ClientResource
     * @apiResourceModel App\Models\Client paginate=10
     * @responseFile 422 scenario="invalid data passed" responses/unprocessable_entity.json
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * */
    public function store(StoreClient $request)
    {
        $this->clientService->createClient($request);
        return created_response($this->all());
    }

    /**
     * Show Client
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Client\ShowClientResource
     * @apiResourceModel App\Models\Client paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Client" responses/not_found.json
     * */
    public function show(Client $client)
    {
        return ok_response(new ShowClientResource($client));
    }

    /**
     * Update Client
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Client\ClientResource
     * @apiResourceModel App\Models\Client paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Client" responses/not_found.json
     * */
    public function update(UpdateClient $request, Client $client)
    {
        $this->clientService->updateClient($request, $client);
        return ok_response($this->all());
    }

    /**
     * Delete Client
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Client\ClientResource
     * @apiResourceModel App\Models\Client paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Client" responses/not_found.json
     * */
    public function destroy(Client $client)
    {
        $client->delete();
        return ok_response($this->all());
    }

    private function all(){
        return paginatedCollectionFormat(ClientResource::class, $this->clientRepository->getClients());
    }
}
