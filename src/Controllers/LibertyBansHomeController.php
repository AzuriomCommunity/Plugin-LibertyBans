<?php

namespace Azuriom\Plugin\LibertyBans\Controllers;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LibertyBansHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('libertybans.view');

        if (config()->get('database.connections.libertybans') === null) {
            abort_if(setting('libertybans.host') === null, 404);

            config()->set('database.connections.libertybans', [
                'driver' => setting('libertybans.driver', 'mysql'),
                'host' => setting('libertybans.host', '127.0.0.1'),
                'port' => setting('libertybans.port', '3306'),
                'database' => setting('libertybans.database', 'libertybans'),
                'username' => setting('libertybans.username', 'libertybans'),
                'password' => setting('libertybans.password'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => 'libertybans_',
                'strict' => true,
            ]);
        }

        $query = $request->input('q');

        $punishmentQuery = DB::connection('libertybans')
            ->table('simple_history')
            ->leftJoin('names AS victim_name', 'simple_history.victim_uuid', '=', 'victim_name.uuid')
            ->leftJoin('names AS operator_name', 'simple_history.operator', '=', 'operator_name.uuid')
            ->orderBy('start', 'desc')
            ->select(
                'id',
                'type',
                'victim_name.name AS victim_name',
                'operator_name.name AS operator_name',
                'reason',
                'start',
                'end',
                DB::raw('CASE WHEN type = 0 THEN EXISTS(SELECT 1 FROM libertybans_bans WHERE id = libertybans_simple_history.id) 
                            WHEN type = 1 THEN EXISTS(SELECT 1 FROM libertybans_mutes WHERE id = libertybans_simple_history.id)
                            WHEN type = 2 THEN EXISTS(SELECT 1 FROM libertybans_warns WHERE id = libertybans_simple_history.id)
                            ELSE false END AS active')
            );

        $driverName = DB::connection('libertybans')->getDriverName();

        if ($driverName === 'mysql') {
            $punishmentQuery = $punishmentQuery->addSelect(
                DB::raw('LOWER(HEX(victim_uuid)) AS victim_uuid'),
                DB::raw('LOWER(HEX(operator)) AS operator_uuid'),
            );
        } else if ($driverName === 'pgsql') {
            $punishmentQuery = $punishmentQuery->addSelect(
                DB::raw("REPLACE(victim_uuid::text, '-', '') AS victim_uuid"),
                DB::raw("REPLACE(operator::text, '-', '') AS operator_uuid"),
            );
        }

        if ($query) {
            $punishmentQuery = $punishmentQuery->where('victim_name.name', 'LIKE', "%{$query}%")
                ->orWhere('operator_name.name', 'LIKE', "%{$query}%")
                ->orWhere('reason', 'LIKE', "%{$query}%")
                ->orWhere('type', 'LIKE', "%{$query}%");
        }

        $punishments = $punishmentQuery->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = setting('libertybans.perPage', 10);

        $paginator = new LengthAwarePaginator(
            $punishments->forPage($currentPage, $perPage),
            $punishments->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('libertybans::index', [
            'punishments' => $paginator,
        ]);
    }
}
