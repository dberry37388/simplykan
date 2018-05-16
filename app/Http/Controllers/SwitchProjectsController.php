<?php

namespace App\Http\Controllers;

use App\Project;

class SwitchProjectsController extends Controller
{
    /**
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        try {
          auth()->user()->switchProjects($project);
        } catch (\Exception $e) {
        
        }
        
        if (request()->wantsJson()) {
            return response("Current project switched to {$project->title}");
        }
        
        return redirect(route("showProject", $project));
    }
}
