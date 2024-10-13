<?php

namespace App\Jobs;

use App\Services\Core\ChunkService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class VaccineCenterRegistrations implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public stdClass $vaccineCenter
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ChunkService $chunkService): void
    {
        $limit = $this->vaccineCenter->daily_limit ?? 10;
        $processed = 0;

        //
        $activeDoses = [1];

        $query = DB::table('registrations')
            ->select([
                'registrations.*', 'vaccinations.scheduled_at', 'vaccinations.vaccinated_at',
                'vaccinations.dose_number'
            ])
            ->leftJoin('vaccinations', 'vaccinations.registration_id', '=', 'registrations.id')
            ->where([
                'registrations.vaccine_center_id' => $this->vaccineCenter->id,
                'registrations.disease_id'        => $this->vaccineCenter->disease_id
            ])
            ->whereNull('vaccinations.scheduled_at')
            ->whereNull('vaccinations.vaccinated_at')
            ->whereIn('vaccinations.dose_number', $activeDoses);

        $chunkService->chunkById($query, $limit, function (Collection $registrations) use (&$processed, $limit) {

            foreach ($registrations as $registration) {
                //Dose One
                $scheduleDate = now()->addDay()->setTime(10, 0);
                $dose = 1;
                //N Number Of dose From 2nd
                if ($registration->dose_number && $registration->dose_number > 1) {

                    $lastDoseNumber = $registration->dose_number - 1;
                    $lastDose = DB::table('vaccinations')
                        ->select([
                            'vaccinations.id',
                            'vaccinations.scheduled_at',
                            'vaccinations.vaccinated_at',
                            'vaccinations.dose_number',
                            'vaccine_doses.next_dose_interval'
                        ])
                        ->leftJoin('vaccine_doses', function (JoinClause $join) use ($registration) {
                            $join->on('vaccine_doses.dose_number', '=', 'vaccinations.dose_number')
                                ->where('vaccine_doses.vaccine_id', '=', $registration->vaccine_id);
                        })
                        ->where('vaccinations.dose_number', $lastDoseNumber)
                        ->where('vaccinations.registration_id', $registration->id)
                        ->first();

                    //N number of dose
                    $vaccinatedInDays = Carbon::parse($lastDose->vaccinated_at)->diffInDays(now());

                    if ($lastDose->next_dose_interval < $vaccinatedInDays) {
                        $scheduleDate = now()->addDay()->setTime(10, 0);
                        $dose = $registration->dose_number;
                    } else {
                        $scheduleDate = null;
                    }
                }

                //Add schedule Date
                if ($scheduleDate) {
                    VaccineScheduleDate::dispatch(
                        $this->vaccineCenter,
                        $registration,
                        $scheduleDate,
                        $dose
                    );
                    //
                    $processed++;
                }

                if ($processed >= $limit) {
                    return false;
                }
            }
            return true;
        }, 'registrations.id');

    }

    protected function updateSchedule()
    {

    }
}
