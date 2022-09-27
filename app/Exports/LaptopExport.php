<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaptopExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
       return Product::where('products.is_deleted',0)
       ->where('products.product_category',2)
         ->select('products.title', 'products.product_performance', 'products.product_link', 'products.view_counter', 'products.click_count', 'product_categories.name')
         ->join('product_categories', 'product_categories.id', '=', 'products.product_category')
        ->orderBy('products.id', 'ASC')->get();
    }

        public function headings(): array
    {
        return [
            'Product Title',
            'Product Performance',
            'Product Link',
            'View',
            'Click',
            'Product Category',
        ];

    }
}