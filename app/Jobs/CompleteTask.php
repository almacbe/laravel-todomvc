<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Todo\Application\CompleteTodo;
use Todo\Application\CompleteTodoHandler;

class CompleteTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var CompleteTodo
     */
    private $completeTodo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CompleteTodo $completeTodo)
    {
        $this->completeTodo = $completeTodo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CompleteTodoHandler $handler)
    {
        $handler($this->completeTodo);
    }
}
