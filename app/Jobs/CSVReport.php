<?php

namespace App\Jobs;

use App\Models\Vinyl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CSVReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vinyls = Vinyl::all();
        $filename = date("Y-m-d H:i:s");
        $report = fopen("$filename.csv", 'w+', '/reports');
        fputcsv($report, [
            'id',
            'name',
            'quantity'
        ], '|');
        foreach ($vinyls as $vinyl) {
            fputcsv($report, [
                $vinyl->id,
                $vinyl->name,
                $vinyl->quantity,
            ], '|');
        }
        fclose($report);
    }
}
