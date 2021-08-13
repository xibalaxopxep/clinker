<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ProjectRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Project';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:project',
            'alias' => 'required',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:project,title,' . $id . ',id',
            'alias' => 'required',
        ];
    }

}
