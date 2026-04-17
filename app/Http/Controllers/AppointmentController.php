<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        return view("homepage");
    }

    public function admin()
    {
        return view("admin_dashboard");
    }

    public function create(Request $request)
    {
        $user_id = session('user_id');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'reason' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            "user_id" => $user_id,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "preferred_date" => $request->preferred_date,
            "preferred_time" => $request->preferred_time,
            "reason" => $request->reason,
        ]);

        return redirect('homepage')->with(['message' => 'The appointment was booked.']);
    }

    public function display()
    {
        $user_id = session('user_id');

        $data = Appointment::where('user_id', $user_id)->get();

        return $data;
    }

    public function appointments()
    {
        if (Auth::user()->role == 'admin') {
            $pending = Appointment::where('status', 'Pending')->get();
            $others = Appointment::where('status', '!=', 'Pending')->get();

            $data = $pending->merge($others);

            return $data;
        } else {
            return view('error') . with(['status' => 'error', 'message' => 'Your are not authorized to check this recieve this data.']);
        }
    }

    public function edit_note($id)
    {
        $data = Appointment::where('id', $id)->first();
        return  view('edit_note', compact('data'));
    }

    public function change_note(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'admin_note' => 'required|min:2'
        ]);

        $data = Appointment::where('id', $request->id)->update(['status' => $request->status, 'admin_note' => $request->admin_note, 'preferred_date' => $request->suggested_date, 'preferred_time' => $request->suggested_time]);

        return redirect('/admin_dashboard');
    }
}
