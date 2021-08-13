<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class UserRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\User';
    }

    public function validateCreate() {
        return $rules = [
            'username' => 'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role_id' => 'required',
            //'email' => 'required|email',
        ];
    }
    public function validateUpdate($id) {
        return $rules = [
            'username' => 'required|unique:user,username,' . $id . ',id',
            'role_id' => 'required'
        ];
    }

    function getAllUser() {
        $users = $this->model->where('role_id', '<>', \App\User::ROLE_ADMIN)->get();
        return $users;
    }
}
