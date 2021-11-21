<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UriController extends Controller
{
    public function get_request_obj(Request $request)
    {
        $path = $request->path();
        $pattern = $request->is('foo/bar');
        $url = $request->url();

        return response()->json([
            'status' => true,
            'data' => [
                'request' => [
                    'request_path' => $path,
                    'pattern' => $pattern,
                    'url method' => $url
                ],
            ]
        ], 200);
    }
}
