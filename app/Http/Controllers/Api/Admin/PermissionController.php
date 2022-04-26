<?php

namespace App\Http\Controllers\Api\Admin;

use App\Constants\Status_Responses;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\Permission\PermissionRepository;
use App\Models\SystemPermission as Permission;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository) {
        $this->authorizeResource(Permission::class, 'permission');
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return ok_response(PermissionResource::collection($this->permissionRepository->getPermissions())->response()->getData(true));
    }
}
