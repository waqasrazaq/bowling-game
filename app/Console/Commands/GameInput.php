<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;

class GameInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game-input:frames { frames : an array of arrays of pins knocked down by each throw }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $frames = json_decode($this->argument('frames'));
            
            if ($frames) {
                $score_list = json_encode((new Game)->setFrames($frames)->getScoreList());
                $this->info("Total scores are: {$score_list}");
            } else {
                $this->info('Invalid format of input arguments');   
            }
            
        } catch (Exception $e) {
            $this->info('Invalid format of input arguments');
        }
    }
}
