<?php

namespace App\Http\Controllers;

use Auth;
use App\Doctor;
use Carbon\Carbon;
use App\Events\DoctorEvent;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('doctor.index')->withDoctors(Doctor::withTrashed()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {

        $doctor->delete();
        $event='Blocked';
        event(new DoctorEvent($doctor,$event));
        return '0';

    }

    public function massDestroy(Request $request)
    {
        $id = $request->input('selected_doctors');
        foreach($id as $did){

            $doctor=Doctor::find($did);
            $doctor->delete();

         }

        return '0';

    }

    /**
     * Restore the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $id = $request->input('id');
        $doctor= Doctor::withTrashed()->find($id);
        $doctor->restore();
        $event='Restored';

        event(new DoctorEvent($doctor,$event));
        return $id;

    }
    public function massRestore(Request $request)
    {
        $id = $request->input('selected_doctors');
        foreach($id as $did){

            $doctor=Doctor::withTrashed()->find($did);
            $doctor->restore();

         }

        return '0';

    }

    public function exportDoctors(Request $request)
    {
        $data=$request->get('data');
        $filename="doctors-".Carbon::today()->toDateString().".csv";
        $ids=explode(',',$data[0]);
        $users=[];
        $csvExporter = new \Laracsv\Export(null,$filename);
        $users=Doctor::withTrashed()->find($ids);
        $csvExporter->build($users, ['name','created_at','updated_at','deleted_at'])->download();
        return redirect('doctors');

    }



}
