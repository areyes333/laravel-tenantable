<?php

namespace BinarCode\Tenantable\Tenant;

use App\Exceptions\InvalidConfiguration;
use BinarCode\Tenantable\Tenant\Contracts\Pipelineable;
use BinarCode\Tenantable\Tenant\Contracts\Tenant;
use Illuminate\Support\Facades\DB;

class DatabaseSwitchingPipe implements Pipelineable
{
    public function __invoke(Tenant $tenant, callable $next)
    {
        $tenantConnectionName = $tenant->tenantDatabaseConnectionName();

        if (is_null(config("database.connections.{$tenantConnectionName}"))) {
            throw InvalidConfiguration::tenantConnectionDoesNotExist($tenantConnectionName);
        }

        config([
            'database.connections.tenant.database' => $tenant->databaseConfig()->name(),
        ]);


        DB::purge($tenantConnectionName);

        DB::reconnect($tenantConnectionName);

        return $next($tenant);
    }
}