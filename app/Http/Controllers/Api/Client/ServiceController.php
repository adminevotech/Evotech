<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\Service\ShowServiceResource;
use App\Models\Service;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Http\Request;


/**
 * @group Service Module
 */
class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository) {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Get All Services
     *
     * @apiResourceCollection App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service
     */
    public function index(Request $request)
    {
        return ok_response($this->all($request));
    }

    /**
     * Show Service
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service
     * @responseFile 404 scenario="not found Service " responses/not_found.json
     * */
    public function show(Service $service)
    {
        return ok_response(new ServiceResource($service));
    }

    private function all($request){
        return collectionFormat(ServiceResource::class, $this->serviceRepository->getAllServices($request));
    }
}
