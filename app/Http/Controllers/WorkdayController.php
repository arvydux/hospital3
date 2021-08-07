<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    public function create($id)
    {
        $doctor = doctor::find($id);
        return view('workdays.create', compact( 'doctor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'=>'required',
            'from'=>'required|date_format:H:i',
            'to'=>'required|date_format:H:i',
            'doctor-id' => 'required|exists:doctors,id',
        ]);

        $workday = new Workday([
            'date' => $request->get('date'),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'doctor_id' => $request->get('doctor-id')
        ]);
        $workday->save();

        $doctors = Doctor::all();
        return redirect(route('doctors.index'))->with('doctors', $doctors)->with('success', 'Workday was added successfully!');
    }
}
