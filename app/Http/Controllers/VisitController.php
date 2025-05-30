<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResource;
use App\Http\Requests\Visit\VisitCreateRequest;
use App\Services\VisitServices;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    private VisitServices $visitServices;

    public function __construct(VisitServices $visitServices)
    {
        $this->visitServices = $visitServices;
    }

    public function index()
    {
        $visits = $this->visitServices->getAllVisits();
        return ApiResource::success($visits, 'Visits retrieved successfully');
    }
    
    public function paginate(){
         $visits = $this->visitServices->getAllVisitsPaginate();
        return ApiResource::success($visits, 'Visits retrieved successfully');
    }
    public function store(VisitCreateRequest $request)
    {
        $visit = $this->visitServices->createVisit($request->validated());
        return ApiResource::success($visit, 'Visit created successfully', 201);
    }

    public function show(int $id)
    {
        $visit = $this->visitServices->getVisitById($id);

        if (!$visit) {
            return ApiResource::error('Visit not found', 404);
        }
        return ApiResource::success($visit, 'Visit retrieved successfully');
    }

    public function update(Request $request, int $id)
    {
        $visit = $this->visitServices->updateVisit($id, $request->all());

        if (!$visit) {
            return ApiResource::error('Visit not found', 404);
        }
        return ApiResource::success($visit, 'Visit updated successfully');
    }

    public function destroy(int $id)
    {
        $deleted = $this->visitServices->deleteVisit($id);

        if (!$deleted) {
            return ApiResource::error('Visit not found', 404);
        }
        return ApiResource::success(null, 'Visit deleted successfully');
    }
}
