<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Project extends Model
{
   use HasFactory;
    protected $guarded = [];

    public function projectClient()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function ProjectImage()
    {
        return $this->hasMany(ProjectFile::class, 'project_id');
    }
}
