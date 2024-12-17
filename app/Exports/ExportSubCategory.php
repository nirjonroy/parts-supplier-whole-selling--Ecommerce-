<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log; // Add this line
class ExportSubCategory implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = SubCategory::select('category_id', 'name', 'slug', 'status')->get();
        Log::info('Exporting SubCategories: ', $data->toArray());
        return $data;
    }
}
