<?php

namespace App\Console\Commands;

use App\Jobs\VaccineCenterRegistrations;
use App\Jobs\VaccineCentersJob;
use App\Models\User;
use App\Models\Vaccination;
use App\Notifications\VaccinateDateNotification;
use App\Services\Core\ChunkService;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VaccineDateSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:date-notification {disease}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to users their vaccine date.';

    /**
     * Execute the console command.
     */
    public function handle(ChunkService $chunkService)
    {
        $disease = $this->argument('disease');
        //As we may have 10,000 of vaccine center we shouldn't use model here and we also don't need model here too.

        $query = DB::table('vaccine_centers')
            ->select([
                'vaccine_centers.id', 'vaccine_centers.name', 'vaccine_centers.district',
                'disease_vaccine_center.daily_limit', 'disease_vaccine_center.disease_id'
            ])
            ->leftJoin('disease_vaccine_center', 'disease_vaccine_center.vaccine_center_id', '=',
                'vaccine_centers.id')
            ->where(function (Builder $builder) use ($disease) {
                $builder->whereExists(function ($query) use ($disease) {
                    $query->select(DB::raw(1))
                        ->from('diseases')
                        ->whereColumn('diseases.id', 'disease_vaccine_center.disease_id')
                        ->where('diseases.name', $disease);
                })->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('registrations')
                        ->whereColumn('registrations.vaccine_center_id', 'vaccine_centers.id')
                        ->whereColumn('registrations.disease_id', 'disease_vaccine_center.disease_id');
                });
            });

        $chunkService->chunkById($query, 10, function (Collection $vaccineCenters) {
            VaccineCentersJob::dispatch($vaccineCenters);

            return false;
        }, 'vaccine_centers.id');

        return 0;
    }

}
