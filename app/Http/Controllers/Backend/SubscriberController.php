<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\SubscriberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function __construct(SubscriberRepository $subscriberRepo) {
        $this->subscriberRepo = $subscriberRepo;
    }

    public function index()
    {
        $records = $this->subscriberRepo->all();
        return view('backend\subscriber\index', compact('records'));
    }

    public function destroy($id)
    {
        $this->subscriberRepo->delete($id);
        return  redirect()->back()->with('success','Xóa thành công');
    }
}
