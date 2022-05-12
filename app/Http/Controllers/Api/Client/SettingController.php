<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Http\Request;

/**
 * @group Setting Module
 */
class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Get All Settings
     *
     * @queryParam filter[group] Filter by group , should be home_header or partner. Example: group
     * @queryParam filter[key] Filter by key , should be home_header or partner. Example: key
     */
    public function index()
    {
        return ok_response(collectionFormat(SettingResource::class, $this->settingRepository->getSettings()));
    }
}
