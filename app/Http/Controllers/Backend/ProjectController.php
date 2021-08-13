<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ProjectRepository;


class ProjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjectRepository $projectRepo) {
        $this->projectRepo = $projectRepo;
  
    }

    public function index() {
        $records = $this->projectRepo->all();
        return view('backend/project/index', compact('records'));
    }

    public function create() {
        return view('backend/project/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
         $input = $request->all();
        if(($request->get('status'))){
           $input['status']=1; 
        }else{
           $input['status']=0;  
        };
      
        
        $input['alias'] = \App\Helpers\StringHelper::getAlias($input['title']);
        $res = $project = $this->projectRepo->create($input);
        if ($res) {
            return redirect()->route('admin.project.index')->with('success', 'Thêm mới thành công');
        } else {
            return redirect()->route('admin.project.index')->with('error', 'Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = $this->projectRepo->find($id);
        return view('backend/project/update', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        if(($request->get('status'))){
           $input['status']=1; 
        }else{
           $input['status']=0;  
        };
      
        
        $input['alias'] = \App\Helpers\StringHelper::getAlias($input['title']);
        $res = $project = $this->projectRepo->update($input,$id);
        if ($res) {
            return redirect()->route('admin.project.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.project.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $project=$this->projectRepo->find($id);

        $this->projectRepo->delete($project->id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
