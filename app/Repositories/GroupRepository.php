<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/09/2019
 * Time: 10:39 AM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class GroupRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Group';
    }
    public function validateCreate() {
        return $rules = [
            'name' => 'required',
           // 'password' => 'required',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
            //'alias' => 'required',
        ];
    }
    public function readGroup(){
        return $this->model->get();
    }
    
    
}
