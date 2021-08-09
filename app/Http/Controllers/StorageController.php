<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StorageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            [$year, $month] = explode('-', Carbon::now()->format('Y-m'));
            $image = $request->file('image');
            $path = "uploads/{$year}/{$month}";
            $name = $image->getClientOriginalName() . '_' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path($path), $name);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset("{$path}/{$name}"),
                ],
            ]);
        }
    }
}
