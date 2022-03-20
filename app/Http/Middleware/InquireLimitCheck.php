<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InquireLimitCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->totalInquiries->count() > 0 && auth()->user()->plan_id == null):
            return response()->json([
                'status' => false,
                'message' => 'You have reached the limit of inquiries for your plan.'
            ]);
        endif;
        return $next($request);
    }
}
