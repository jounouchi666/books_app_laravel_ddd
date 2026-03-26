<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);

        return response()->json(['message' => 'Database reset success'], 200);
    }
}
