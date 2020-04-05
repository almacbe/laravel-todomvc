<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Todo\Application\CreateTodo;
use Todo\Application\CreateTodoHandler;

class CreateTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var CreateTodo
     */
    private $command;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CreateTodo $createTodo)
    {
        $this->command = $createTodo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CreateTodoHandler $handler)
    {
        $handler($this->command);
    }
}
