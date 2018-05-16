<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @var \App\Project
     */
    protected $project;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->project = create(Project::class);
    }
    
    /**
     * Tests that a project has an Owner that is an
     * instance of \App\User.
     */
    public function testAProjectHasAnOwner()
    {
        $this->assertInstanceOf(User::class, $this->project->owner);
    }
    
    /**
     * Tests that a project has a title
     */
    public function testAProjectHasATitle()
    {
        $this->assertDatabaseHas('projects', [
            'title' => $this->project->title
        ]);
    }
    
    /**
     * Tests that a project has a title
     */
    public function testAProjectHasADescription()
    {
        $this->assertDatabaseHas('projects', [
            'description' => $this->project->description
        ]);
    }
}
