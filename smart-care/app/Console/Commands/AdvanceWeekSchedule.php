<?php

namespace App\Console\Commands;

use App\Models\LearningSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AdvanceWeekSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:advance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advance the learning schedule to the next week, skipping Sunday.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->startOfWeek()->addWeek();
        LearningSchedule::where('date', '>=', $date)
                        ->where('date', '<', $date->endOfWeek())
                        ->each(function ($schedule) {
                            LearningSchedule::create([
                                'name' => $schedule->name,
                                'date' => $schedule->date->addWeek(),
                                'morning' => $schedule->morning,
                                'noon' => $schedule->noon,
                                'afternoon' => $schedule->afternoon,
                            ]);
                        });

        $this->info('Schedule advanced successfully to next week.');
    }
}
