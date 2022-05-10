<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Portfolio\PortfolioResource;
use App\Models\Portfolio;
use App\Repositories\Portfolio\PortfolioRepository;
use Illuminate\Http\Request;

/**
 * @group Portfolio Module
 */
class PortfolioController extends Controller
{
    protected $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository) {
        $this->portfolioRepository = $portfolioRepository;
    }

    /**
     * Get All Portfolios
     *
     * @apiResourceCollection App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio
     */
    public function index(Request $request)
    {
        return ok_response($this->all($request));
    }

    /**
     * Show Portfolio
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Portfolio\PortfolioResource
     * @apiResourceModel App\Models\Portfolio
     * @responseFile 404 scenario="not found Portfolio " responses/not_found.json
     * */
    public function show(Portfolio $portfolio)
    {
        return ok_response(new PortfolioResource($portfolio));
    }

    private function all($request){
        return collectionFormat(PortfolioResource::class, $this->portfolioRepository->getPortfolios($request));
    }
}
