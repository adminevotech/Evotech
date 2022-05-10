<?php

namespace App\Services;

use App\Constants\Media_Collections;
use App\Models\Portfolio;

class PortfolioService
{
    public function createPortfolio($request)
    {
        $portfolio = Portfolio::create($request->validated());
        add_media_item($portfolio, $request->photo, Media_Collections::PORTFOLIO);

    }

    public function updatePortfolio($request, $portfolio)
    {
        $portfolio->update($request->validated());
        add_media_item($portfolio, $request->photo, Media_Collections::PORTFOLIO);
    }
}
