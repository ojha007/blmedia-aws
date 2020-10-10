<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

//to get configuration data
class DatabaseSwitcher
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle(Request $request, Closure $next)
    {
        //check if user logged in
        if (!$this->auth->guest()) {
            //get authenticate user information
            $user = $this->auth->user();
            dd($user);
            //get user's database
            $user_db = $user->user_database;
            //first get default mysql connection array and use in new variable for new connection which will create dynamically.(default connection is defined in database.php config file)
            $dbConfig = config('database.connections.mysql');
            //now use database name which is in user record;
            $dbConfig['database'] = $user_db;
            //now set a new database connection name is mysql_new in my case
            Config::set("database.connections.mysql_new", $dbConfig);
            //now set default connection which is created for the user
            Config::set("database.default", 'mysql_new');
            //now there are two connection one for master (mysql) and other for user(mysql_new) and default connection is (mysql_new)
            //we can access these two connection in every models by using $connection as mentioned in Larave documentation.
        }
        return $next($request);
    }
}
