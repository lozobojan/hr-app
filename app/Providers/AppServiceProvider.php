<?php

namespace App\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        $notificationsEmp = cache()->remember('notifications-emp', 60*60*24, function(){
            return DB::table('employee_job_statuses')
                ->selectRaw('*, datediff(date_hired_till, now()) as days_till')
                ->join('employees', 'employees.id', '=', 'employee_job_statuses.employee_id')
                ->whereRaw('datediff(date_hired_till, now()) < 60 AND datediff(date_hired_till, now()) >0')->get();
        });

        $notificationsDoc = cache()->remember('notifications-doc', 60*60*24, function(){
            return DB::table('documentations')
                ->selectRaw('*, datediff(expiration_date, now()) as days_till')
                ->whereRaw('datediff(expiration_date, now()) < 60 AND datediff(expiration_date, now()) >0')->get();
        });

        $totalNotifications = cache()->remember('total-notifications', 60*60*24, function() use ($notificationsEmp, $notificationsDoc) {
            return count($notificationsDoc) + count($notificationsEmp);
        });
            $data = [
                'notificationsEmp' => $notificationsEmp,
                'notificationsDoc' => $notificationsDoc,
                'totalNotifications' => $totalNotifications

            ];
        View::share(['notificationsEmp' => $notificationsEmp, 'notificationsDoc' => $notificationsDoc, 'totalNotifications' => $totalNotifications]);

    }
}
