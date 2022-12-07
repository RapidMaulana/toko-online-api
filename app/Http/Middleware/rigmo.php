<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class rigmo
{
    public function rigmo(Request $request, Closure $next)
    {
        if (auth()->user()->role != "user"){
            return response()->json([
                'message' => 'Endpoint diutamakan untuk user'
            ]);
        }
    }
}
