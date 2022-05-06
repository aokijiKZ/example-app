<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    //
    public function index(){
        return view('admin.department.index');
    }

    public function store(Request $request){
        // dd($request->department_name); //ชื่อ tag html name=''
        $request->validate([
            'department_name'=>'required|unique:departments|max:100',    //table departments ต้องไม่มีชื่อซ้ำ
        ],
        [
            'department_name.required'=>'Please input department name.',  //ปรับ error message
            'department_name.max'=>'Input values up to 100 characters.',
        ]);

        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();

        return redirect()->back()->with('success','Save data successfully!');
    }

}
