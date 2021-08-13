<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct(ContactRepository $contactRepo) {
        $this->contactRepo = $contactRepo;
    }

    public function index()
    {
        $records = $this->contactRepo->all();
        return view('backend/contact/index', compact('records'));
    }

    public function show($id)
    {
        $record = $this->contactRepo->find($id);
        return view('backend/contact/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->contactRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
