<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Portfolio\StorePortfolio;
use App\Http\Requests\Admin\Portfolio\UpdatePortfolio;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepository;
use App\Services\PortfolioService;
use Illuminate\Http\Request;


/**
 * @group Admin Portfolio Module
 */
class PortfolioController extends Controller
{
    protected $portfolioRepository;
    protected $portfolioService;

    public function __construct(PortfolioRepository $portfolioRepository, PortfolioService $portfolioService) {
        $this->authorizeResource(Portfolio::class, "portfolio");
        $this->portfolioRepository = $portfolioRepository;
        $this->portfolioService = $portfolioService;
    }

    /**
     * Get All Portfolios
     *
     * @header Authorization Bearer Token
     *
     * @queryParam sort Sort Field by name, active,service_id. Example: name,active,service_id
     * @queryParam filter[name] Filter by name. Example: name
     * @queryParam filter[active] Filter by active. Example: active
     * @queryParam filter[service_id] Filter by service_id. Example: service_id
     *
     * @apiResourceCollection App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     */
    public function index()
    {
        return ok_response($this->all());
    }

    /**
     * Create Portfolio
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection 201 App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio paginate=10
     * @responseFile 422 scenario="invalid data passed" responses/unprocessable_entity.json
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * */
    public function store(StorePortfolio $request)
    {
        $this->portfolioService->createPortfolio($request);
        return created_response($this->all());
    }

    /**
     * Show Portfolio
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Portfolio" responses/not_found.json
     * */
    public function show(Portfolio $portfolio)
    {
        return ok_response(new PortfolioResource($portfolio));
    }

    /**
     * Update Portfolio
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Portfolio" responses/not_found.json
     * */
    public function update(UpdatePortfolio $request, Portfolio $portfolio)
    {
        $this->portfolioService->updatePortfolio($request, $portfolio);
        return ok_response($this->all());
    }

    /**
     * Delete Portfolio
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Portfolio" responses/not_found.json
     * */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return ok_response($this->all());
    }

    private function all(){
        return paginatedCollectionFormat(PortfolioResource::class, $this->portfolioRepository->getPortfolios());
    }
}
