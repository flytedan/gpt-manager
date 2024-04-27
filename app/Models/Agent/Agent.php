<?php

namespace App\Models\Agent;

use App\Models\Team\Team;
use App\Models\Workflow\WorkflowJob;
use Flytedan\DanxLaravel\Contracts\AuditableContract;
use Flytedan\DanxLaravel\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model implements AuditableContract
{
    use HasFactory, AuditableTrait, SoftDeletes;
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function knowledge()
    {
        return $this->belongsTo(Knowledge::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function workflowJobs()
    {
        return $this->belongsToMany(WorkflowJob::class);
    }
}
