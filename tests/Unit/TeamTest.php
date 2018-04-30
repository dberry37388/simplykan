<?php

namespace Tests\Unit;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\Team
     */
    protected $team;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->team = factory(Team::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testATeamHasAnOwner()
    {
        $this->assertInstanceOf(User::class, $this->team->owner);
    }
}
