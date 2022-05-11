<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Repositories\Employee\EmployeeRepository;
use Illuminate\Http\Request;

/**
 * @group Employee Module
 */
class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Get All Employees
     *
     * @apiResourceCollection App\Http\Resources\Employee\EmployeeResource
     * @apiResourceModel App\Models\Employee
     */
    public function index(Request $request)
    {
        return ok_response($this->all($request));
    }

    private function all($request){
        return collectionFormat(EmployeeResource::class, $this->employeeRepository->getEmployeesLimited($request));
    }
}
