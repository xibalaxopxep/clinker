<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ProjectRepository;
use Repositories\ConstructionRepository;
use Repositories\CategoryRepository;

class ProjectController extends Controller {

    //
    public function __construct(CategoryRepository $categoryRepo,ProjectRepository $projectRepo, ConstructionRepository $constructionRepo) {
        $this->projectRepo = $projectRepo;
        $this->constructionRepo = $constructionRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function detail($alias) {
        $project = $this->projectRepo->findByAlias($alias);
        $record = $this->constructionRepo->find($project->construction_id);
        $category_arr = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_CONSTRUCTION);
        if (config('global.device') != 'pc') {
            return view('mobile/project/detail', compact('record', 'project','category_arr'));
        }
        else{
            return view('frontend/project/detail', compact('record', 'project'));
        }
    }

}
