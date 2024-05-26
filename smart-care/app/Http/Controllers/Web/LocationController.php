<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
    {
        return response()->json(Province::all());
    }

    public function getDistricts($province_id)
    {
        return response()->json(District::where('province_id', $province_id)->get());
    }

    public function getWards($district_id)
    {
        return response()->json(Ward::where('district_id', $district_id)->get());
    }
}
