<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreService;
use App\Http\Requests\Admin\Service\UpdateService;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\Service\ShowServiceResource;
use App\Models\Service;
use App\Repositories\Service\ServiceRepository;
use App\Services\ServiceService;
use Illuminate\Http\Request;

/**
 * @group Admin Service Module
 */
class ServiceController extends Controller
{
    protected $serviceRepository;
    protected $serviceService;

    public function __construct(ServiceRepository $serviceRepository, ServiceService $serviceService) {
        $this->authorizeResource(Service::class, "service");
        $this->serviceRepository = $serviceRepository;
        $this->serviceService = $serviceService;
    }

    /**
     * Get All Services
     *
     * @header Authorization Bearer Token
     *
     * @queryParam sort Sort Field by title,active. Example: title,active
     * @queryParam filter[title] Filter by title. Example: title
     * @queryParam filter[active] Filter by active. Example: active
     *
     * @apiResourceCollection App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     */
    public function index()
    {
        return ok_response($this->all());
    }

    /**
     * Create Service
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection 201 App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service paginate=10
     * @responseFile 422 scenario="invalid data passed" responses/unprocessable_entity.json
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * */
    public function store(StoreService $request)
    {
        $this->serviceService->createService($request);
        return created_response($this->all());
    }

    /**
     * Show Service
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Service\ShowServiceResource
     * @apiResourceModel App\Models\Service paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Service " responses/not_found.json
     * */
    public function show(Service $service)
    {
        return ok_response(new ShowServiceResource($service));
    }

    /**
     * Update Service
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Service " responses/not_found.json
     * */
    public function update(UpdateService $request, Service $service)
    {
        $this->serviceService->updateService($request, $service);
        return ok_response($this->all());
    }

    /**
     * Delete Service
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Service\ServiceResource
     * @apiResourceModel App\Models\Service paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Service " responses/not_found.json
     * */
    public function destroy(Service $service)
    {
        $service->delete();
        return ok_response($this->all());
    }

    private function all(){
        return paginatedCollectionFormat(ShowServiceResource::class, $this->serviceRepository->getServicesPaginated());
    }
}
