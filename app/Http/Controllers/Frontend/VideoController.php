<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\VideoCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;
use Repositories\KeywordRepository;
use Repositories\VideoRepository;
use App\Repositories\ProductRepository;

class VideoController extends Controller {

    public function __construct(VideoRepository $videoRepo, CategoryRepository $categoryRepo, VideoCategoryRepository $videoCategoryRepo, ProductRepository $productRepo,  KeywordRepository $keywordRepo) {
        $this->videoRepo = $videoRepo;
        $this->categoryRepo = $categoryRepo;
        $this->videoCategoryRepo = $videoCategoryRepo;
        $this->productRepo = $productRepo;
        $this->keywordRepo = $keywordRepo;
    }

    public function index() {
        $category_arr = $this->categoryRepo->readVideoCategory();
        $records = $this->videoRepo->readFE($limit = 15);
        $hot_video_arr = $this->videoRepo->readHotVideoArr(10);
        if (config('global.device') != 'pc') {
            return view('mobile/video/list', compact('records', 'hot_video_arr'));
        } else {
            $related_video = $this->videoRepo->getRelatedVideo(8, $hot_video_arr[0]->categories()->orderBy('id', 'desc')->first());
            return view('frontend/video/list', compact('category_arr', 'records', 'hot_video_arr','related_video'));
        }
    }

    public function detail($alias) {
        $record = $this->videoRepo->findByAlias($alias);
        $this->videoRepo->updateViewCount($record->id, $record->view_count);
        $related_video = $this->videoRepo->getRelatedVideo(8, $record->categories()->orderBy('id', 'desc')->first());
        $related_products = $this->productRepo->readRelatedProducts($record->keywords);
        $config = $this->videoRepo->getConfig($record->id);
        if (config('global.device') != 'pc') {
            return view('mobile/video/detail', compact('record','config', 'related_video','related_products'));
        } else {
            return view('frontend/video/detail', compact('record', 'related_video','config','related_products'));
        }
    }
    public function search(Request $request)
    {
        $category_arr = $this->categoryRepo->readVideoCategory();
        $records = $this->videoRepo->readSearch($request, $limit = 15);
        if ($request->get('keyword')) {
            $this->keywordRepo->create(['keyword' => $request->get('keyword')]);
        }
        $search = $request->all();
        $current_category = $this->categoryRepo->getCurrentCategory(isset($search['category_id'])&& $search['category_id'] !=0 ? $search['category_id'] : \App\Category::TYPE_VIDEO);
        return view('frontend/video/search', compact('category_arr','current_category', 'records', 'search'));
    }

}
