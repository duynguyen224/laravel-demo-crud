<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function map($product): array
    {
        return [
            $product->id,
            $product->created_by_user,
            $product->category_name,
            $product->name,
            $product->price,
            $product->description,
            $product->created_at,
            $product->updated_at
        ];
    }

    public function collection()
    {
        $results = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('users', 'products.user_id', '=', 'users.id');

        $results = $results->select('products.*', 'categories.name as category_name', 'users.name as created_by_user')->get();

        return $results;
    }


    // With headings
    public function headings(): array
    {
        return [
            "#", "Create by user", "Category", "Product name", "Price", "Description", "Created at", "Updated at"
        ];
    }
}
