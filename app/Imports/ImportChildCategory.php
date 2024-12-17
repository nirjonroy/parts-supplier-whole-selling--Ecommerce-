<?php

namespace App\Imports;

use App\Models\ChildCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportChildCategory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ChildCategory([
            //
            'category_id' => $row[0],
            'sub_category_id' => $row[1],
            'name' => $row[2],
            'slug' => $row[3],
            'status' => $row[4],
        ]);
    }
}
