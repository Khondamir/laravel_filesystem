<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\SecondForm;

class SecondFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('secondform', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //

         $request->validate([
        'file_path1'        => 'required|mimes:pdf|max:5120',
        'file_path2'        => 'required|mimes:pdf|max:5120',
        'file_path3'        => 'required|mimes:pdf|max:5120',
        'length_optic'      => 'required',
        'mobile_technology' => 'required',
        'object_type'       => 'required',
        ]);

        $file1 = $request->file('file_path1');
        $file2 = $request->file('file_path2');
        $file3 = $request->file('file_path3');

        $new_name1 = rand() . '.' . $file1->getClientOriginalExtension();
        $new_name2 = rand() . '.' . $file2->getClientOriginalExtension();
        $new_name3 = rand() . '.' . $file3->getClientOriginalExtension();

        $file1->move(public_path('storage'), $new_name1);
        $file2->move(public_path('storage'), $new_name2);
        $file3->move(public_path('storage'), $new_name3);

        $region_id = File::select('region_id')->where('id', $id)->first()->region_id;

        $form_data = array(
            'first_id'         =>   $id,
            'file_path1'       =>   $new_name1,
            'file_path2'       =>   $new_name2,
            'file_path3'       =>   $new_name3,
            'length_optic'     =>   $request->length_optic,
            'mobile_technology'=>   $request->mobile_technology,
            'object_type'      =>   $request->object_type,
            'region_id'        =>   $region_id,
            'status'           =>   'yuborildi'

        );

        $data = array('status' => 'Yakunlandi');

        SecondForm::create($form_data);
        File::where('id', $id)->update($data);

        return redirect('dashboard')->with('success', 'Data Added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'description2' => 'required'
        ]);
        $data = array(
            'status'      => 'Qayta ishlash',
            'description' => $request->description2 );
        SecondForm::where('id', $id)->update($data);

        return redirect('dashboard')->with('success', 'Yuborildi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        //
        $data = array('status' => 'Yakunlandi', );
        SecondForm::where('id', $id)->update($data);
        return redirect('dashboard')->with('success', 'Qabul qilindi');
    }

    public function getInformation(Request $request){

        $request->validate([

            'from_date' => 'required',
            'to_date'   => 'required',
            'region_id' => 'required'

        ]);

        $data = SecondForm::select('length_optic', 'mobile_technology', 'object_type')->where('region_id', $request->region_id)->whereBetween('created_at', [$request->from_date, $request->to_date])->get();
        
        $info_data = array('km' => 0, 'four' => 0, 'three' => 0, 'two' => 0, 'switch' => 0, 'hub' => 0, 'msan' => 0, 'ats' => 0);

        foreach($data as $info){
        $info_data['km'] = $info_data['km'] + $info->length_optic;
        switch ($info->mobile_technology) {
          case "4G":
          $info_data['four']++;
          break;
          case "3G":
          $info_data['three']++;
          break;
          case "2G":
          $info_data['two']++;
          break;
        }
        switch ($info->object_type) {
          case "Switch":
          $info_data['switch']++;
          break;
          case "Hub":
          $info_data['hub']++;
          break;
          case "MSAN":
          $info_data['msan']++;
          break;
          case "ATS":
          $info_data['ats']++;
          break;
        }
        }

        return redirect('admin')->with('info_data', $info_data);


    }

}
