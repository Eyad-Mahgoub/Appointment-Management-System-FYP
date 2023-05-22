<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Speciality;
use Database\Factories\DoctorFactory;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // $specs = Speciality::factory()->count(10)->create();
        // $doctors = Doctor::factory()->count(20)->create();
        $specs = Speciality::all();
        // dd($specs);
        return view('test.test', compact('specs'));
    }
}
