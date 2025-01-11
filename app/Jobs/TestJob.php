<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Queueable;

    public $test;
    /**
     * Create a new job instance.
     */
    public function __construct($test)
    {
        $this->test=$test;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        print_r( $this->test);
    }
}
