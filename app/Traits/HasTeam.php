<?php

namespace App\Traits;

use App\Team;

trait HasTeam
{
    /**
     * The team that the user currently belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentTeam()
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot([
            'enabled'
        ]);
    }

    /**
     * Sets the user's current team.
     *
     * You can pass either the team id or an instance of
     * the team. If neither is passed, an exception will be thrown.
     *
     * @param $teamId
     * @return bool
     * @throws \Exception
     */
    public function setCurrentTeam($teamId)
    {
        if (! $teamId instanceof Team && ! is_int($teamId)) {
            throw new \Exception("To join a team, you must either pass an instance of the team, or the team id.");
        }

        if ($teamId instanceof Team) {
            $teamId = $teamId->id;
        }

        return $this->update([
            'current_team_id' => $teamId
        ]);
    }

    /**
     * Attaches the user to the given team.
     *
     * If the user does not currently have a current_team_id or
     * setToCurrent is true, the user's current_team_id will also
     * be set to the given team.
     *
     * @param \App\Team $team
     * @param bool $setToCurrent
     * @throws \Exception
     */
    public function joinTeam(Team $team, $setToCurrent = false)
    {
        $team->users()->attach($this->id);

        if (is_null($this->current_team_id) || $setToCurrent) {
            $this->setCurrentTeam($team);
        }
    }

    /**
     * Checks to see if the user owns the given team.
     *
     * @param \App\Team $team
     * @return bool
     */
    public function ownsTeam(Team $team)
    {
        if ($team->owner_id == $this->id) {
            return true;
        }

        return false;
    }
}
