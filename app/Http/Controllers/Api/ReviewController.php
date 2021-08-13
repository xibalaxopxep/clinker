<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ReviewRepository;

class ReviewController extends Controller {

    //
    public function __construct(ReviewRepository $reviewRepo) {
        $this->reviewRepo = $reviewRepo;
    }
    public function addReview(Request $request) {
        $input = $request->all();
        $this->reviewRepo->create($input);
        return response()->json(array('success' => true));
    }
}
