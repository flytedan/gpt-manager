<?php

namespace App\Models\Workflow;

use App\Models\Agent\Agent;
use Flytedan\DanxLaravel\Contracts\AuditableContract;
use Flytedan\DanxLaravel\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkflowJob extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function casts()
    {
        return [
            'config' => 'array',
        ];
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function workflowJobRuns()
    {
        return $this->hasMany(WorkflowRun::class);
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class);
    }
}
