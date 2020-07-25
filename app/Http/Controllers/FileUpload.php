<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Regions;

class FileUpload extends Controller
{
    //
  public function createForm(){
    return view('dashboard');
  }

  public function fileUpload(Request $request){
        $request->validate([
        'number'      => 'required',
        'text'        => 'required',
        'file_path1'  => 'required|mimes:pdf|max:5120',
        'file_path2'  => 'required|mimes:pdf|max:5120',
        'region_id'   => 'required',
 /*         'region_name' => 'required',
        'user_email'  => 'required',*/

        ]);

        $file1 = $request->file('file_path1');
        $file2 = $request->file('file_path2');

        $new_name1 = rand() . '.' . $file1->getClientOriginalExtension();
        $new_name2 = rand() . '.' . $file2->getClientOriginalExtension();
        $file1->move(public_path('storage'), $new_name1);
        $file2->move(public_path('storage'), $new_name2);

        $region_name = Regions::select('name')->where('id', $request->region_id)->first()->name;

        $form_data = array(
            'number'           =>   $request->number,
            'text'             =>   $request->text,
            'file_path1'       =>   $new_name1,
            'file_path2'       =>   $new_name2,
            'region_id'		   =>   $request->region_id,
            'region_name'      =>   $region_name,
            'user_email'       =>   Auth()->User()->email,
            'status'           =>   'yuborildi'

        );

        File::create($form_data);

        return redirect('dashboard')->with('success', 'Data Added successfully.');
   }

   public function reprocess(Request $request, $id){

   	    $request->validate([
            'description' => 'required'
        ]);
        $data = array(
        	'status'      => 'Qayta ishlash',
        	'description' => $request->description );
        File::where('id', $id)->update($data);

        return redirect('dashboard')->with('success', 'yuborildi');

   }

   public function acceptForm($id){
   		$data = array('status' => 'Qabul qilindi', );
   		File::where('id', $id)->update($data);
   		return redirect('dashboard')->with('success', 'Qabul qilindi');
   }

}
