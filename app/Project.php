<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'prefix'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_accessed_at'
    ];
    
    public function getRouteKeyName()
    {
        return 'prefix';
    }
    
    /**
     * The user that owns the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['last_accessed_at'])
            ->withTimestamps();
    }
}
