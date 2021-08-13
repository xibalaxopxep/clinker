<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\TagRepository;

class TagController extends Controller {

    public function __construct(TagRepository $tagRepo) {
        $this->tagRepo = $tagRepo;
    }

    public function getTagsByGalleryId(Request $request) {
        $records = $this->tagRepo->getTagsByGalleryId($request->get('gallery_id'));
        return response()->json(array('success' => true, 'records' => $records));
    }

    public function add(Request $request) {
        $input['gallery_id'] = $request->get('gallery_id');
        $input['image'] = $request->get('image');
        $input['title'] = $request->get('title');
        $input['position_x'] = $request->get('position_x');
        $input['position_y'] = $request->get('position_y');
        $tag = $this->tagRepo->create($input);
        return response()->json(array('success' => true, 'id' => $tag->id));
    }
    public function update(Request $request) {
        $id = $request->get('id');
        $input['title'] = $request->get('title');
        $this->tagRepo->update($input, $id);
        return response()->json(array('success' => true, 'id' => $id));
    }

    public function delete(Request $request) {
        $res = $this->tagRepo->delete($request->get('id'));
        return response()->json(array('success' => true));
    }

}
