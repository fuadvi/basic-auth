<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class Authorize
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

        $token = $request->header('token');
        $custumer = Customer::where('token', $token)->first();

        if (!$custumer || $token == '') {
            return response()->json(
                [
                    'status' => 'Invalid',
                    'data' => null,
                    'error' => ['Token invalid, unauthorized!']
                ],
                401
            );
        }

        $request->setUserResolver(function () use ($custumer) {
            return $custumer;
        });

        return $next($request);
    }
}
