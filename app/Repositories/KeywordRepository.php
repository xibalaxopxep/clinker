<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class KeywordRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Keyword';
    }

    public function create(array $input) {
        $check_exist = $this->model->where('keyword', $input['keyword'])->first();
        if ($check_exist) {
            $input['count'] = $check_exist['count']+1;
            return $this->model->where('id', $check_exist['id'])->update($input);
        } else {
            $input['count'] = 1;
            return $this->model->create($input);
        }
        
    }
    public function readHomeRecentKeyword($limit = 10){
        return $this->model->orderBy('updated_at', 'desc')->take($limit)->get();
    }
}
