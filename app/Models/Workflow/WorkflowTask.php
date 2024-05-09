<?php

namespace App\Models\Workflow;

use App\Models\Agent\Thread;
use Flytedan\DanxLaravel\Contracts\AuditableContract;
use Flytedan\DanxLaravel\Contracts\ComputedStatusContract;
use Flytedan\DanxLaravel\Models\Job\JobDispatch;
use Flytedan\DanxLaravel\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkflowTask extends Model implements AuditableContract, ComputedStatusContract
{
    use HasFactory, SoftDeletes, AuditableTrait;

    const string
        STATUS_PENDING = 'Pending',
        STATUS_RUNNING = 'Running',
        STATUS_COMPLETED = 'Completed',
        STATUS_FAILED = 'Failed';

    const array STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_RUNNING,
        self::STATUS_COMPLETED,
        self::STATUS_FAILED,
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function booted()
    {
        static::saving(function ($workflowTask) {
            $workflowTask->computeStatus();
        });
    }

    public function workflowRun()
    {
        return $this->belongsTo(WorkflowRun::class);
    }

    public function workflowJob()
    {
        return $this->belongsTo(WorkflowJob::class);
    }

    public function workflowAssignment()
    {
        return $this->belongsTo(WorkflowAssignment::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function jobDispatch()
    {
        return $this->belongsTo(JobDispatch::class);
    }

    public function computeStatus(): static
    {
        if ($this->started_at === null) {
            $this->status = self::STATUS_PENDING;
        } elseif ($this->failed_at !== null) {
            $this->status = self::STATUS_FAILED;
        } elseif ($this->completed_at === null) {
            $this->status = self::STATUS_RUNNING;
        } else {
            $this->status = self::STATUS_COMPLETED;
        }

        return $this;
    }
}
