<?php

namespace App\Services;

use App\Helpers\ApiResource;
use App\Repositories\VisitRepository;

class VisitServices
{
    private VisitRepository $visitRepository;

    public function __construct(VisitRepository $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function createVisit(array $visit)
    {
        return $this->visitRepository->createVisit($visit);
    }

    public function getVisitById(int $id)
    {
        return $this->visitRepository->getVisitById($id);
    }
    public function updateVisit(int $id, array $data)
    {
        return $this->visitRepository->updateVisit($id, $data);
    }

    
    public function deleteVisit(int $id)
    {
        return $this->visitRepository->deleteVisit($id);
    }

    public function getAllVisits()
    {
        return $this->visitRepository->getAllVisits();
    }

    public function getAllVisitsPaginate()
    {
        return $this->visitRepository->getAllVisitsPaginate();
    }
}
