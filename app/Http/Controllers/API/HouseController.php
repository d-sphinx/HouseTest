<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = DB::table('houses');

        if ($request->has('name') && $request->input('name') != '') {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('bedrooms') && $request->input('bedrooms') != '') {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->has('bathrooms') && $request->input('bathrooms') != '') {
            $query->where('bathrooms', $request->input('bathrooms'));
        }

        if ($request->has('storeys') && $request->input('storeys') != '') {
            $query->where('storeys', $request->input('storeys'));
        }

        if ($request->has('garages') && $request->input('garages') != '') {
            $query->where('garages', $request->input('garages'));
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        $houses = $query->get();

        return response()->json($houses);
    }
}
