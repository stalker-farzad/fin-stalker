<?php

namespace App\Providers;

use App\Repositories\V1\Contract\ContractRepository;
use App\Repositories\V1\Contract\IContractRepository;
use App\Repositories\V1\Desk\Account\AccountRepository;
use App\Repositories\V1\Desk\Account\IAccountRepository;
use App\Repositories\V1\Desk\DeskRepository;
use App\Repositories\V1\Desk\IDeskRepository;
use App\Repositories\V1\my\Contract\ContractRepository as MyContractRepository;
use App\Repositories\V1\my\Contract\IContractRepository as MyIContractRepository;
use App\Repositories\V1\my\Desk\Account\AccountRepository as MyAccountRepository;
use App\Repositories\V1\my\Desk\Account\IAccountRepository as MyIAccountRepository;
use App\Repositories\V1\my\Desk\DeskRepository as MyDeskRepository;
use App\Repositories\V1\my\Desk\IDeskRepository as MyIDeskRepository;
use App\Repositories\V1\my\Team\ITeamRepository as MyITeamRepository;
use App\Repositories\V1\my\Team\TeamRepository as MyTeamRepository;
use App\Repositories\V1\my\TeamTrader\IMyTeamTraderRepository;
use App\Repositories\V1\my\TeamTrader\MyTeamTraderRepository;
use App\Repositories\V1\Team\ITeamRepository;
use App\Repositories\V1\Team\TeamRepository;
use App\Repositories\V1\Team\Trader\ITeamTraderRepository;
use App\Repositories\V1\Team\Trader\TeamTraderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        app()->bind(ITeamTraderRepository::class, TeamTraderRepository::class);
        app()->bind(IMyTeamTraderRepository::class, MyTeamTraderRepository::class);
        app()->bind(ITeamRepository::class,TeamRepository::class);
        app()->bind(IDeskRepository::class, DeskRepository::class);
        app()->bind(IAccountRepository::class, AccountRepository::class);
        app()->bind(MyIDeskRepository::class, MyDeskRepository::class);
        app()->bind(MyIAccountRepository::class, MyAccountRepository::class);
        app()->bind(IContractRepository::class , ContractRepository::class);
        app()->bind(MyIContractRepository::class , MyContractRepository::class);
        app()->bind(MyITeamRepository::class, MyTeamRepository::class);
    }
}
