<?php

namespace App\Resources\InputSource;

use App\Models\Shared\InputSource;
use Newms87\Danx\Resources\ActionResource;
use Newms87\Danx\Resources\StoredFileResource;

/**
 * @mixin InputSource
 * @property InputSource $resource
 */
class InputSourceResource extends ActionResource
{
    protected static string $type = 'InputSource';

    public function data(): array
    {
        $thumbFile = $this->storedFiles()->first();

        return [
            'id'                      => $this->id,
            'name'                    => $this->name,
            'description'             => $this->description,
            'workflow_runs_count'     => $this->workflow_runs_count,
            'thumb'                   => $thumbFile ? StoredFileResource::make($thumbFile) : null,
            'has_active_workflow_run' => $this->activeWorkflowRuns()->exists(),
            'created_at'              => $this->created_at,
            'updated_at'              => $this->updated_at,
        ];
    }
}
