<?php
namespace App\Helpers;
use Request;
use App\Models\LogActivity as LogActivityModel;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public static function addToLog($subject)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['controller_function'] = \Route::current()->getActionName();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = Auth::check() ? Auth::user()->id : 1;
        LogActivityModel::create($log);
    }

    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}