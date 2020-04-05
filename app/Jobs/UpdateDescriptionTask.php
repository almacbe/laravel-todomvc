<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Todo\Application\UpdateTodoDescription;
use Todo\Application\UpdateTodoDescriptionHandler;

class UpdateDescriptionTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var UpdateTodoDescription
     */
    private $updateTodoDescription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UpdateTodoDescription $updateTodoDescription)
    {
        $this->updateTodoDescription = $updateTodoDescription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UpdateTodoDescriptionHandler $handler)
    {
        $handler($this->updateTodoDescription);
    }
}
