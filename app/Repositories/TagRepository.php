<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class TagRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Tag';
    }
    public function getTagsByGalleryId($gallery_id){
        return $this->model->where('gallery_id', $gallery_id)->get();
    }
}
