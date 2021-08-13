<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class RankRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Rank';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:rank',
            'discount_percent' => 'required',
            'condition' => 'required',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:rank,title,'.$id.',id',
            'discount_percent' => 'required',
            'condition' => 'required',
        ];
    }

}
