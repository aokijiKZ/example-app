<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //
    public function index(){
        $services = Service::orderBy('id', 'asc')->paginate(5);
        return view('admin.service.index', compact('services'));
    }

    public function store(Request $request){
        $request->validate([
            'service_name'=>'required|unique:services|max:100',    //table departments ต้องไม่มีชื่อซ้ำ
            'service_image'=>'required|mimes:jpg,png,jpeg',
        ],
        [
            'service_name.required'=>'Please input service name.',  //ปรับ error message
            'service_name.max'=>'Input values up to 100 characters.',
            'service_name.unique'=>'This service already has a name.',
            'service_image.required'=>'Please insert a image.',
            'service_image.mimes'=>'Only supports .png, .jpg, jpeg files.',
        ]);

        // //เเปลงรหัสรูปภาพ
        $service_image = $request->file('service_image');
        $name_gen = hexdec(uniqid()); //เเปลงรหัสรูปเป็นเลขฐาน 16 ให้ไม่ซ้ำ
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;

        //อัพโหลดรูป
        $upload_location = 'image/services/';
        $full_path = $upload_location.$img_name;

        //บันทึก path รูป ลง db
        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now(),
        ]);

        //เก็บรูปลงโฟลเดอร์โปรเจกต์
        $service_image->move($upload_location,$img_name);
        
        return redirect()->back()->with('success','Saved data successfully!');
    }


}
