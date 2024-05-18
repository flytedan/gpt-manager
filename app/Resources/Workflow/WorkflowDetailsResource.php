<?php

namespace App\Resources\Workflow;

use App\Models\Workflow\Workflow;

/**
 * @mixin Workflow
 * @property Workflow $resource
 */
class WorkflowDetailsResource extends WorkflowResource
{
    public function data(): array
    {
        $jobs = $this->workflowJobs()->get();
        $runs = $this->workflowRuns()->get();

        return [
                'jobs' => $jobs ? WorkflowJobResource::collection($jobs) : [],
                'runs' => $runs ? WorkflowRunDetailsResource::collection($runs) : [],
            ] + parent::data();
    }
}
