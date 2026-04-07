<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DbResetController extends Controller
{    
    /**
     * 初期化実行
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function execute(Request $request): JsonResponse
    {
        if ($request->header('X-App-Token') !== env('DB_RESET_TOKEN')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $command = 'php ' . base_path('artisan') . ' migrate:fresh --seed --force > /dev/null 2>&1 &';
        exec($command);

        return response()->json(['message' => 'Database reset started in background'], 202);
    }
}
