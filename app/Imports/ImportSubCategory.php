<?php

namespace App\Imports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSubCategory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubCategory([
            //
            'category_id' => $row[0],
            'name' => $row[1],
            'slug' => $row[2],
            'status' => $row[3],
        ]);
    }
}
