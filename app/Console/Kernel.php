<?php

namespace App\Console;

use App\Http\Livewire\Alerts;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Company;
use Livewire\Livewire;
use Illuminate\Support\Facades\Event;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            if($company->hora_abertura){
                $schedule->command('alerta:abertura --company='.$company->id)->dailyAt(date('H:i', strtotime($company->hora_abertura)));
            }

            if($company->hora_fecho){
                $schedule->command('alerta:fecho --company='.$company->id)->dailyAt(date('H:i', strtotime($company->hota_fecho)));
            }
        }
    }

    protected function clearScheduledTasksForCompany($companyId){
        $this->app[Schedule::class]->events()->filter(function ($event) use ($companyId) {
            return $event instanceof CallbackEvent &&
                $event->command === 'alerta:abertura' &&
                $event->parameters[0]['--company'] == $companyId;
        })->each(function ($event) {
            $event->disable();
        });

        $this->app[Schedule::class]->events()->filter(function ($event) use ($companyId) {
            return $event instanceof CallbackEvent &&
                $event->command === 'alerta:fecho' &&
                $event->parameters[0]['--company'] == $companyId;
        })->each(function ($event) {
            $event->disable();
        });
    }

    protected function scheduleTasksForCompany($companyId){
        $this->clearScheduledTasksForCompany($companyId);

        $empresa = Company::where('id', $companyId)->first();

        $this->app[Schedule::class]->command('alerta:abertura', ['--company' => $companyId])
            ->dailyAt($empresa->hora_abertura);
            $this->app[Schedule::class]->command('alerta:fecho', ['--company' => $companyId])
            ->dailyAt($empresa->hora_fecho);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
