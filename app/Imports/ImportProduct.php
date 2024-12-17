<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \Log::info('Importing row: ', $row);
        if (count($row) < 13) {
            Log::warning('Skipping row due to insufficient columns: ', $row);
            return null;
        }
        return new Product([
            'name' => $row[0],
            'slug' => $row[1],
            'category_id' => $row[2],
            'sub_category_id' => $row[3],
            'child_category_id' => $row[4],
            'qty' => $row[5],
            'short_description' => $row[6],
            'long_description' => $row[7],
            'purchase_price' => $row[8],
            'price' => $row[9],
            'offer_price' => $row[10],
            'discount_price' => $row[11],
            'status' => $row[12],
        ]);
    }
}
