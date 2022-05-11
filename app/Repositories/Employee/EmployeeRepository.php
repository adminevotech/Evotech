<?php

namespace App\Repositories\Employee;

use App\Models\Employee;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeRepository
{
    public function getEmployees()
    {
        return QueryBuilder::for(Employee::class)
        ->allowedFilters(['name','position','active'])
        ->allowedSorts(['name','position','active'])
        ->paginate(10);
    }

    public function getEmployeesLimited($request)
    {
        return QueryBuilder::for(Employee::class)
        ->allowedFilters(['name','position','active'])
        ->limit($request->limit)
        ->get();
    }

}
