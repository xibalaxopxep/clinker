<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\NewsCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\NewsRepository;
use Repositories\CategoryRepository;

class NewsController extends Controller {

    //
    public function __construct(NewsRepository $newsRepo, CategoryRepository $categoryRepo, NewsCategoryRepository $newsCategoryRepo) {
        $this->newsRepo = $newsRepo;
        $this->categoryRepo = $categoryRepo;
        $this->newsCategoryRepo = $newsCategoryRepo;
    }

    public function index(Request $request, $alias = '') {
        if ($alias) {
            $category = $this->categoryRepo->findByAlias($alias);
            $records = $this->newsRepo->readFE($request, $category->id);
        } else {
            $records = $this->newsRepo->readFE($request);
        }
        $category_arr = $this->categoryRepo->readHomeNewsCategory();
        $featured_news = $this->newsRepo->readFeaturedNews($limit = 5);
        if (config('global.device') != 'pc') {
            return view('mobile/news/list', compact('records', 'category_arr', 'featured_news'));
        } else {
            return view('frontend/news/list', compact('records', 'category_arr', 'featured_news'));
        }
    }

    public function detail($alias) {
        $record = $this->newsRepo->findByAlias($alias);
        $this->newsRepo->updateViewCount($record->id, $record->view_count);
        $featured_news = $this->newsRepo->readFeaturedNews($limit = 5);
        $category_arr = $this->categoryRepo->readHomeNewsCategory();
        $news_ids = $this->newsCategoryRepo->getNewsIds($record->categories->pluck('id'));
        $related_news = $this->newsRepo->readRelatedNews($record->id, $news_ids);
        $config = $this->newsRepo->getConfig($record->id);
        $blog = $record;
        //$url = \Illuminate\Support\Facades\Request::url();
        if (config('global.device') != 'pc') {
            return view('mobile/news/detail', compact('record', 'blog', 'config', 'category_arr', 'featured_news'));
        } else {
            return view('frontend/news/detail', compact('record', 'blog', 'config', 'featured_news', 'category_arr', 'related_news'));
        }
    }

}
