<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Todo\Application\RemoveTodo;
use Todo\Application\RemoveTodoHandler;

class RemoveTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var RemoveTodo
     */
    private $command;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RemoveTodo $removeTodo)
    {
        $this->command = $removeTodo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RemoveTodoHandler $handler)
    {
        $handler($this->command);
    }
}
