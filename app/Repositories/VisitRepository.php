<?php

namespace App\Repositories;

use App\Interfaces\VisitInterface;
use App\Models\Visit;

class VisitRepository implements VisitInterface
{
    public function createVisit(array $visit)
    {
       $visit = Visit::create(array_merge($visit, [
            'user_id' => auth()->id(),
        ]));

        return $visit;
    }

    public function getVisitById(int $id)
    {
        return Visit::with('user')->find($id);
    }

    public function updateVisit(int $id, array $data)
    {
        $visit = Visit::find($id);
        if ($visit) {
            $visit->update($data);
            return $visit;
        }
        return null;
    }
    public function deleteVisit(int $id)
    {
        $visit = Visit::find($id);
        if ($visit) {
            $visit->delete();
            return true;
        }
        return false;
    }

    public function getAllVisits()
    {
        return Visit::all();
    }

    public function getAllVisitsPaginate(){
        return Visit::paginate(5);
    }
}
