<?php

namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class SupplierRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Supplier';
    }

    public function validateCreate() {
        return $rules = [
            'supplier_name' => 'required|unique:supplier',
            'email'=> 'required|email'
            
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'supplier_name' => 'required',
            'email'=> 'required|email'
            ];
    }

    


}
