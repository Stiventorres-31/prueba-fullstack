<?php

namespace App\Interfaces;

interface VisitInterface
{
    public function createVisit(array $visit);
    public function getVisitById(int $id);
    public function updateVisit(int $id, array $data);
    public function deleteVisit(int $id);
    public function getAllVisits();
    public function getAllVisitsPaginate();
}
