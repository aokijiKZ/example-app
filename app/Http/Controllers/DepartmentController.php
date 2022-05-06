<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::orderBy('id', 'asc')->paginate(5);
        return view('admin.department.index', compact('departments'));
    }

    public function store(Request $request){
        // dd($request->department_name); //ชื่อ tag html name=''
        $request->validate([
            'department_name'=>'required|unique:departments|max:100',    //table departments ต้องไม่มีชื่อซ้ำ
        ],
        [
            'department_name.required'=>'Please input department name.',  //ปรับ error message
            'department_name.max'=>'Input values up to 100 characters.',
            'department_name.unique'=>'This department already has a name.'
        ]);

        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();   //สามารถบันทึกข้อมูลอีกเเบบได้ โดย insert data ลง db โดยตรงโดยใช้ Query builder

        return redirect()->back()->with('success','Saved data successfully!');
    }

    public function edit($id){
        $department = Department::find($id);

        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'department_name'=>'required|unique:departments|max:100',    //table departments ต้องไม่มีชื่อซ้ำ
        ],
        [
            'department_name.required'=>'Please input department name.',  //ปรับ error message
            'department_name.max'=>'Input values up to 100 characters.',
            'department_name.unique'=>'This department already has a name.'
        ]);

        $department = Department::find($id)->update([
           'department_name' => $request->department_name,
           'user_id' => Auth::user()->id,
        ]);
        
        return redirect()->route('department')->with('success','Updated data successfully!');
    }

}
