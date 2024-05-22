<?php

namespace App\Models\Workflow;

use App\Models\Team\Team;
use Newms87\Danx\Contracts\AuditableContract;
use Newms87\Danx\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workflow extends Model implements AuditableContract
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function workflowJobs()
    {
        return $this->hasMany(WorkflowJob::class);
    }

    public function workflowRuns()
    {
        return $this->hasMany(WorkflowRun::class);
    }

    public function sortedAgentWorkflowJobs()
    {
        return $this->workflowJobs()->orderBy('dependency_level')->orderBy('name');
    }

    public function __toString()
    {
        return "<Workflow ($this->id) $this->name>";
    }
}
