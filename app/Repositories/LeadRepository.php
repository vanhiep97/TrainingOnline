<?php

namespace App\Repositories;
use App\Models\Lead;

class LeadRepository
{
    public function get($id)
    {
        return Lead::find($id);
    }

    public function all($columns = ['*'])
    {
        return Lead::get($columns);
    }

    public function findBy($column, $value)
    {
        return Lead::where([$column => $value])->first();
    }

    public function query()
    {
        return Lead::query();
    }

    public function create(array $lead)
    {
        return Lead::create($lead);
    }
}

