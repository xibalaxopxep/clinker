<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\RoleRepository;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RoleRepository $roleRepo) {
        $this->roleRepo = $roleRepo;
    }
    public function index()
    {
        $records = $this->roleRepo->getAllRole();
        return view('backend/role/index', compact('records'));
    }
    public function create()
    {
        $routeCollection = Route::getRoutes();
        foreach($routeCollection as $value){
            if(strpos($value->getName(), 'admin') > -1 && $value->getName() != 'admin.index'){
                $routename = explode('.',$value->getName());
                $public_route[] = $routename[1];
            }
        }
        $public_route = array_unique($public_route);
        return view('backend.role.create',compact('public_route'));
    }
    public function store(Request $request)
        {
            $input = $request->all();
            $routeCollection = Route::getRoutes();
            foreach($routeCollection as $value){
                if(strpos($value->getName(), 'api') > -1 || $value->getName() == 'admin.index' || $value->getName() == 'login' || $value->getName() == 'logout' || $value->getName() == 'admin.user.index_profile' || $value->getName() == 'admin.user.update_profile')
                    $route[] = $value->getName();
            }
            foreach($input['route'] as $val){
                foreach($routeCollection as $value){
                    if(strpos($value->getName(), 'admin') > -1 && strpos($value->getName(), $val) > -1){
                        $route[] = $value->getName();
                    }
                }
            }
            $input['route'] = implode(',',$route);

            $role = $this->roleRepo->create($input);
            return redirect()->route('admin.role.index')->with('sucess','Tạo mới thành công');

        }
    public function edit($id)
    {
        $record = $this->roleRepo->find($id);
        $routeCollection = Route::getRoutes();
        if($record->route){
            $routes = explode(',',$record->route);
            foreach($routes as $value){
                if(strpos($value, 'admin') > -1 && $value != 'admin.index'){
                    $routename = explode('.',$value);
                    $route[] = $routename[1];
                }
            }
            $route = array_unique($route);
        }else{
           $route=[];
        }
        foreach($routeCollection as $val){
            if(strpos($val->getName(), 'admin') > -1 && $val->getName() != 'admin.index'){
                $router = explode('.',$val->getName());
                $public_route[] = $router[1];
            }
        }
        $public_route = array_unique($public_route);
        return view('backend.role.update',compact('public_route','record','route'));
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $routeCollection = Route::getRoutes();
        foreach($routeCollection as $value){
            if(strpos($value->getName(), 'api') > -1 || $value->getName() == 'admin.index')
            $route[] = $value->getName();
        }
        foreach($input['route'] as $val){
            foreach($routeCollection as $value){
                if(strpos($value->getName(), 'admin') > -1 && strpos($value->getName(), $val) > -1)
                $route[] = $value->getName();
            }
        }
        $input['route'] = implode(',',$route);
        $role = $this->roleRepo->update($input,$id);
        return redirect()->route('admin.role.index')->with('success','Cập nhật thành công');
    }
    public function destroy($id)
    {
        $this->roleRepo->delete($id);
        return redirect()->route('admin.role.index')->with('success','Xóa thành công');
    }
}
