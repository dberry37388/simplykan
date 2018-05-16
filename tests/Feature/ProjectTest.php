<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RegisterTest
 *
 * @package Tests\Feature
 * @group auth
 */
class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * The registration form can be displayed.
     *
     * @return void
     */
    public function testAGuestMayNotCreateProjects()
    {
        $this->withExceptionHandling();
        
        $this->get(route('createProject'))
            ->assertRedirect('login');
        
        $this->post(route('storeProject'))
            ->assertRedirect('login');
        
        $this->withoutExceptionHandling()
            ->signIn();
        
        $this->expectException(AuthorizationException::class);
        
        $this->post(route('storeProject'));
    }
    
    /**
     * Tests that an authenticated and authorized user can
     * create projects.
     *
     * Currently anyone on the team is authorized to create projects.
     */
    public function testAnAuthorizedUserCanCreateProjects()
    {
        $this->signIn(create(User::class, [
            'is_admin' => true
        ]));
        
        $project = make(Project::class, [
            'owner_id' => auth()->id()
        ]);
        
        $this->post(route('storeProject'), $project->toArray());
        
        $this->assertDatabaseHas('projects', [
            'owner_id' => auth()->id(),
            'title' => $project->title,
        ]);
    }
    
    /**
     * Tests that a user who is not authenticated and/or is
     * not authorized, cannot update a project.
     */
    public function testAnUnauthorizedUserMayNotUpdateAProject()
    {
        $this->withExceptionHandling();
    
        $project = create(Project::class);
    
        $this->put(route('updateProject', $project))
            ->assertRedirect('login');
    
        $this->withoutExceptionHandling()
            ->signIn();
    
        $this->expectException(AuthorizationException::class);
    
        $this->put(route('updateProject', $project));
    }
    
    /**
     * Tests that an authorized user can update an
     * existing project.
     */
    public function testAnAuthorizedUserCanUpdateAProject()
    {
        $this->signIn(create(User::class));
    
        $project = create(Project::class, [
            'owner_id' => auth()->id()
        ]);
    
        $newValues = [
            'title' => 'New Title'
        ];
        
        $this->put(route('updateProject', $project->id), $newValues);
        
        $this->assertDatabaseHas('projects', $newValues);
    }
    
    /**
     * Tests that an authorized user can update an
     * existing project.
     */
    public function testAnUnauthorizedUserMayNotDeleteAProject()
    {
        $this->withExceptionHandling();
        
        $project = create(Project::class);
        
        $this->delete(route('deleteProject', $project->id))
            ->assertRedirect('login');
    
        $this->withoutExceptionHandling()
            ->signIn();
    
        $this->expectException(AuthorizationException::class);
    
        $this->put(route('deleteProject', $project));
    }
    
    /**
     * Tests that an authorized user can update an
     * existing project.
     */
    public function testAnAuthorizedUserCanDeleteAProject()
    {
        $this->signIn(create(User::class));
        
        $project = create(Project::class, [
            'owner_id' => auth()->id()
        ]);
        
        $this->delete(route('updateProject', $project->id));
        
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id
        ]);
    }
}