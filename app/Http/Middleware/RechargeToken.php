<?php

namespace App\Http\Middleware;

use App\Models\UserCredit\UserCredit;
use Closure;
use Illuminate\Http\Request;

class RechargeToken
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
        $credit = UserCredit::select('last_recharge_date')->orderBy('last_recharge_date', 'asc')->first();
        if ($credit) {
            $last_recharge = substr($credit['last_recharge_date'], 0, 7);
            $date = date("Y-m");

            if ($date !== $last_recharge) {
                $now = date('Y-m-d');
                UserCredit::where('role_id', 2)->update([
                    'credit' => 40,
                    'last_recharge_date' => $now,
                ]);

                UserCredit::where('role_id', 3)->update([
                    'credit' => 20,
                    'last_recharge_date' => $now,
                ]);
            }
        }

        return $next($request);
    }
}
