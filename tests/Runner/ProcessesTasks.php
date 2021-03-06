<?php

namespace ByRobots\Multithread\Tests\Runner;

use ByRobots\Multithread\Runner\Runner;
use ByRobots\Multithread\Tasks\TaskInterface;
use ByRobots\Multithread\Tests\TestCase;
use Mockery;

class ProcessesTasks extends TestCase
{
    public function testProcessesOneTask()
    {
        $runner = new Runner;
        $task   = Mockery::mock(TaskInterface::class);

        $task->shouldReceive('process')->once();
        $runner->setTaskList([$task]);
        $runner->run();
    }

    public function testProcessesManyTasks()
    {
        $runner = new Runner;
        $tasks  = [];

        for ($index = 0; $index < 5; $index++) {
            $task = Mockery::mock(TaskInterface::class);
            $task->shouldReceive('process')->once();

            $tasks[] = $task;
        }

        $runner->setTaskList($tasks);
        $runner->run();
    }
}
