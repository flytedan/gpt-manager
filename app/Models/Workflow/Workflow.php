<?php

namespace App\Models\Workflow;

use App\Models\Team\Team;
use Flytedan\DanxLaravel\Contracts\AuditableContract;
use Flytedan\DanxLaravel\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workflow extends Model implements AuditableContract
{
    use HasFactory, AuditableTrait, SoftDeletes;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function workflowJobs()
    {
        return $this->hasMany(WorkflowJob::class);
    }
}
