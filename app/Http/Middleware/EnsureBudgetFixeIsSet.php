<?php

namespace App\Http\Middleware;

use App\Services\BudgetAnnuelService;
use App\Services\util\Common;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class EnsureBudgetFixeIsSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $budgetAnnuelService;
    public function __construct(BudgetAnnuelService $b)
    {

        $this->budgetAnnuelService = $b;
    }

    public function handle(Request $request, Closure $next)
    {

        $res = $this->budgetAnnuelService->findBudgetParAnnee(Common::getAnneeActuelle());
        if (!empty($res)) {
            return $next($request);
        } else {
            return redirect()->route('edit.budgetFixe');
        }
    }
}
