<?php

namespace App\Services;

use App\Constants\Media_Collections;
use App\Models\Service;

class ServiceService
{
    public function createService($request)
    {
        $Service = Service::create($request->validated());
        add_media_item($Service, $request->photo, Media_Collections::SERVICES);
        return $Service;
    }

    public function updateService($request, $Service)
    {
        $Service->update($request->validated());
        add_media_item($Service, $request->photo, Media_Collections::SERVICES);
        return $Service;
    }
}
