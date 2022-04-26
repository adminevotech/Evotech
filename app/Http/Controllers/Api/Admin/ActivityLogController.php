<?php

namespace App\Http\Controllers\Api\Admin;

use App\Constants\Status_Responses;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepository;

class ActivityLogController extends Controller
{
    protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository) {
        $this->authorizeResource(Activity::class);
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        return ok_response(ActivityLogResource::collection($this->activityRepository->getActivities())->response()->getData(true));
    }
}
