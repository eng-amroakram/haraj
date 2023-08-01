<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (auth()->user()->can_add_offer == 'inactive') {
                return response()->json([
                    'status' => false,
                    'code' => 403,
                    'message' => __('You are not allowed to add offers'),
                    'data' => [],
                ], 403);
            }
        }
        return $next($request);
    }
}
