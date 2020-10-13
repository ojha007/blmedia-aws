<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SwitchDatabaseConnectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected $edition;

    public function register()
    {
        $this->changeDatabaseConnection();
    }

    protected function changeDatabaseConnection()
    {

        $edition = $this->getEditions();
        DB::purge('mysql');
        DB::disconnect();
        $diskName = $edition == 'en' ? 'english' : $edition;
        Config::set('elfinder.disks', $diskName);
        $timeZone = 'America/Los_Angeles';
        if ($edition == 'nepali') {
            $timeZone = 'Asia/Kathmandu';
        }
        if ($edition == 'hindi') {
            $timeZone = 'Asia/Kolkata';
        }
        Config::set('app.timezone', $timeZone);
        Config::set('CACHE_PREFIX', $edition);
        Config::set('elfinder.route.prefix', $edition . '/bl-secure/elfinder');
        Config::set('database.default', $edition);
        DB::reconnect();
    }

    protected function getEditions()
    {
        $edition = null;
        if (in_array(request()->segment(1), config('editions'))) {
            $edition = request()->segment(1);
        }
        if (is_null($edition)) {
            $edition = 'en';
        }
        return $edition;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()

    {
        $language = [
            'nepali' => 'ne',
            'en' => 'en',
            'english' => 'en',
            'hindi' => 'hi'
        ];
        $edition = null;
        if (in_array(request()->segment(1), config('editions'))) {
            $edition = request()->segment(1);
        }
        if (is_null($edition)) {
            $edition = 'en';
        }
        App::setLocale($language[$edition]);
    }

    protected function getTimeZoneByIp()
    {
        $ip = request()->ip();
        if ($ip) {
            $data = \Location::get($ip);
            if ($data) {
                if ($data->countryName == 'Nepal') {
                    return 'Asia/Kathmandu';
                }
                if ($data->countryName == 'India') {
                    return 'Asia/Kolkata';
                }
                return 'America/Los_Angeles';
            }
            return 'Asia/Kathmandu';
        }

    }
}
