<?php

namespace App\Jobs;

use App\Models\Registration;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Notifications\VaccinateDateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class VaccineScheduleDate implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public stdClass|VaccineCenter $vaccineCenter,
        public stdClass $registration,
        public Carbon $scheduleDate,
        public int $dose
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        //Update Schedule
        DB::table('vaccinations')->updateOrInsert([
            'registration_id' => $this->registration->id,
            'dose_number'            => $this->dose,
        ], [
            'scheduled_at' => $this->scheduleDate,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        //Send Notification
        //NOTE: Vaccine, Doses, Disease Single Query will perform better IF Database Server is nearest of your web server. So, Based on DB server we will update this query for better performance
        $user = User::query()->find($this->registration->user_id);
        $vaccine = DB::table('vaccines')
            ->select([
                'vaccines.name', 'diseases.name as disease_name', 'diseases.display_name as diseases_display_name',
                'vaccine_doses.name as vaccine_dose_name',
            ])
            ->leftJoin('diseases', 'diseases.id', '=', 'vaccines.disease_id')
            ->leftJoin('vaccine_doses', function (JoinClause $join) {
                $join->on('vaccine_doses.vaccine_id', '=', 'vaccines.id')
                    ->where('vaccine_doses.dose_number', '=', $this->dose);
            })
            ->where('vaccines.id', $this->registration->vaccine_id)
            ->first();

        $user->notify(new VaccinateDateNotification(
            $this->vaccineCenter, $this->registration, $vaccine, $this->scheduleDate
        ));
    }
}
