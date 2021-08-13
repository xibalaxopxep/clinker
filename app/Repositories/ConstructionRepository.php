<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ConstructionRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Construction';
    }

    public function validateCreate() {
        return $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'full_name' => 'required',
            'alias' => 'required',
        ];
    }

    public function readHomeConstruction($limit = 10) {
        return $this->model->where('state', '1')->orderBy('vip', 'desc')->take($limit)->get();
    }

    public function checkUser($username) {
        return $this->model->where('username', $username)->first();
    }


    public function checkactivation($key) {
        return $this->model->where('activation', $key)->first();
    }

    public function readFE($request) {
        $limit = 10;
        $query = $this->model;
        if ($request->get('construction_category_id')) {
            $item_ids = \Db::table('item')->where('category_id', $request->get('construction_category_id'))->pluck('id');
            $construction_ids = \Db::table('construction_item')->whereIn('item_id', $item_ids)->pluck('construction_id');
            $query = $query->whereIn('id', $construction_ids);
        }
        if ($request->get('item_id')) {
            $construction_ids = \Db::table('construction_item')->where('item_id', $request->get('item_id'))->pluck('construction_id');
            $query = $query->whereIn('id', $construction_ids);
        }
        if ($request->get('keyword')) {
            $query = $query->where(function($que) use ($request){
                return $que->where('full_name', 'like', '%'.$request->get('keyword').'%')
                        ->orWhere('description', 'like', '%'.$request->get('keyword').'%');
            });
        }
        if ($request->get('province')) {
            $query = $query->where('address', 'like', '%'.$request->get('province').'%');
        }
        return $query->where('status', '1')->where('state','1')->orderBy('created_at', 'desc')->paginate($limit);
    }

}
