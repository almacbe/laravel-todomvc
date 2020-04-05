<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Todo\Application\IncompleteTodo;
use Todo\Application\IncompleteTodoHandler;

class IncompleteTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var IncompleteTodo
     */
    private $incompleteTodo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(IncompleteTodo $incompleteTodo)
    {
        $this->incompleteTodo = $incompleteTodo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IncompleteTodoHandler $handler)
    {
        $handler($this->incompleteTodo);
    }
}
