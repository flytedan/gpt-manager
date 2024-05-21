<?php

namespace App\WorkflowTools;

use App\Models\Workflow\WorkflowJobRun;
use App\Models\Workflow\WorkflowTask;
use Flytedan\DanxLaravel\Exceptions\ApiException;
use Flytedan\DanxLaravel\Services\TranscodeFileService;

class TranscodeInputSourceWorkflowTool extends WorkflowTool
{
    public function assignTasks(WorkflowJobRun $workflowJobRun, array $dependsOnJobs): void
    {
        // Always create 1 task to transcode the input source
        $workflowJobRun->tasks()->create([
            'user_id'         => user()->id,
            'workflow_job_id' => $workflowJobRun->workflow_job_id,
            'group'           => '',
            'status'          => WorkflowTask::STATUS_PENDING,
        ]);
    }

    /**
     * @param WorkflowTask $workflowTask
     * @return void
     * @throws ApiException
     */
    public function runTask(WorkflowTask $workflowTask): void
    {
        $inputSource = $workflowTask->workflowJobRun->workflowRun->inputSource;

        if (!$inputSource->is_transcoded) {
            foreach($inputSource->storedFiles as $storedFile) {
                app(TranscodeFileService::class)->pdfToImages($storedFile);
            }
        }
    }
}
