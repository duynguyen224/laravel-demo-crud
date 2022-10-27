<?php

namespace App\Imports;

use App\Models\Product;
use App\Rules\MustBeNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // name, price, description, category_id, user_id
        return new Product([
            "name" => $row["name"],
            "price" => $row["price"],
            "description" => $row["description"],
            "category_id" => $row["category_id"],
            "user_id" => auth()->id(),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $categoryIds = DB::table('categories')->where('id', '>', 0)->pluck('id')->toArray();

        return [
            'name' => ['required'],
            'price' => ['required', new MustBeNumber()],
            'description' => ['required'],
            'category_id' => Rule::in($categoryIds),
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        $categoryIds = DB::table('categories')->where('id', '>', 0)->pluck('id')->toArray();

        return [
            'category_id.in' => 'Not valid :attribute. Category_id must be in [' . implode(", ", $categoryIds) . ']',
            'price.in' => 'Not valid :attribute. Price must be number]',
        ];
    }
}
