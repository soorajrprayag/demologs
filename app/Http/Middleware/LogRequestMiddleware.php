<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Start the timer
        $startTime = Carbon::now();
        
        // Call the next middleware/controller
        $response = $next($request);

        // Stop the timer
        $endTime = Carbon::now();
        $duration = $startTime->diffInMilliseconds($endTime);
        
        // Check if logging is enabled via configuration
        if (Config::get('logging.log_requests')) {
            // Log the request and response time to SQLite database
            DB::table('request_logs')->insert([
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'ip_address' => $request->ip(),
                'duration' => $duration,
                'created_at' => now(),
            ]);
        }

        return $response;
    }
}
