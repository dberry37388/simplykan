<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'projects',
        'currentProject'
    ];
    
    /**
     * Projects the user belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withPivot(['last_accessed_at'])
            ->withTimestamps();
    }
    
    /**
     * The user's current project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentProject()
    {
        return $this->hasOne(Project::class, 'id', 'current_project_id');
    }
    
    /**
     * Switches the user's current project.
     *
     * @param \App\Project $project
     */
    public function switchProjects(Project $project)
    {
        $this->setCurrentProject($project);
    }
    
    /**
     * Assigns a project to the user.
     *
     * @param \App\Project $project
     */
    public function assignProject(Project $project)
    {
        $this->projects()->attach($project->id);
        
        if (empty($this->current_project_id)) {
            $this->setCurrentProject($project);
        }
    }
    
    /**
     * Sets the project that the user is currently working on.
     * 
     * @param \App\Project $project
     * @return $this
     */
    public function setCurrentProject(Project $project)
    {
        if ($this->projects->contains('id', $project->id)) {
            $this->current_project_id = $project->id;
            $this->save();
            
            $this->projects()->updateExistingPivot($project->id, [
                'last_accessed_at' => Carbon::now()
            ]);
        }
        
        return $this;
    }
    
    /**
     * Scopes the latest projects.
     *
     * @param $query
     * @return mixed
     */
    public function scopeRecentProjects($query)
    {
        return $query->orderBy('pivot_last_accessed_at', 'desc');
    }
}
