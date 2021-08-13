<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class RoleRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Role';
    }

    function getAllRole() {
        $roles = $this->model->where('id', '<>', 1)->get();
        return $roles;
    }

    public static function getSelectOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }

}
