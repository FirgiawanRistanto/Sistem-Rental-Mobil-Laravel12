<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('LogVisitor middleware: Request received.');

        $ipAddress = $request->ip();
        $today = now()->toDateString();

        Log::info('LogVisitor middleware: IP Address - ' . $ipAddress . ', Today - ' . $today);

        $visitor = Visitor::where('ip_address', $ipAddress)
                          ->whereDate('visited_at', $today)
                          ->first();

        if (!$visitor) {
            Log::info('LogVisitor middleware: No existing visitor found for ' . $ipAddress . ' today. Creating new entry.');
            Visitor::create([
                'ip_address' => $ipAddress,
                'visited_at' => now(),
            ]);
            Log::info('LogVisitor middleware: New visitor entry created.');
        } else {
            Log::info('LogVisitor middleware: Existing visitor found for ' . $ipAddress . ' today. Skipping new entry.');
        }

        return $next($request);
    }
}
