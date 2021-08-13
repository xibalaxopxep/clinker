<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel
{
    // public function headingRow() : int
    // {
    //     return 1;
    // }
 
    // public function model(array $row)
    // {
    //     return new Product([
    //         'username' => $row['username'] ?? $row['ten_tai_khoan'],
    //         'email' => $row['email'],
    //         'password' => Hash::make($row['password'] ?? $row['mat_khau'],
    //         'type' => $row['type'] ?? $row['loai']
    //     ]);
    // }
}
