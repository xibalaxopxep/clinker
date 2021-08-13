<?php

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class TemplateAttributeRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\TemplateAttribute';
    }
    public function getAll(){
        return $this->model->get();
    }
}