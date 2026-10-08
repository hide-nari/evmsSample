<?php

namespace App\Imports;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class ProjectImport implements ToModel
{
    public function model(array $row): Model|null
    {
        return new Project([
            'name' => $row[0],
        ]);
    }
}
