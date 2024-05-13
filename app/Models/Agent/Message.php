<?php

namespace App\Models\Agent;

use Flytedan\DanxLaravel\Contracts\AuditableContract;
use Flytedan\DanxLaravel\Models\Utilities\StoredFile;
use Flytedan\DanxLaravel\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model implements AuditableContract
{
    use HasFactory, AuditableTrait, SoftDeletes;

    const string
        ROLE_USER = 'user',
        ROLE_ASSISTANT = 'assistant',
        ROLE_TOOL = 'tool';

    protected $fillable = [
        'role',
        'title',
        'summary',
        'content',
        'data',
    ];

    public function casts()
    {
        return [
            'data' => 'json',
        ];
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function storedFiles(): MorphToMany|StoredFile
    {
        return $this->morphToMany(StoredFile::class, 'storable', 'stored_file_storables');
    }
}
