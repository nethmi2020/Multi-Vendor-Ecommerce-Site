<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * Fetch the required columns along with related data
     */
    public function query()
    {

        return Product::with(['category', 'seller'])->select('id', 'name', 'description', 'price', 'qty', 'category_id', 'seller_id');
    }

    /**
     * Define custom column headers for the Excel file
     */

    public function headings(): array
    {
        return [
            'Product ID',
            'Product Name',
            'Product Description',
            'Product Price',
            'Product Quantity',
            'Category Name',
            'Seller Name',
        ];
    }

    public function map($product): array
    {
        return [
        $product->id,
        $product->name,
        $product->description,
        $product->price,
        $product->qty,
        $product->category ? $product->category->name : 'N/A',  
        $product->seller ? $product->seller->name : 'N/A',      
        ];
    }
}
