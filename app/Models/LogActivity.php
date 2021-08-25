<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Query Builder */

use Illuminate\Support\Facades\DB;

class LogActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'controller_function', 'method', 'ip', 'agent', 'user_id'
    ];

    public static function listRoutes()
    {
        $listRoutes = DB::table('log_activities')
            ->select('log_activities.controller_function')
            ->distinct()
            ->groupBy('log_activities.controller_function')
            ->orderBy('log_activities.controller_function')
            ->get();

        return $listRoutes;
    }
}
