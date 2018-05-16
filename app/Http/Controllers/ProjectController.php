<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Project);
        
        $project = Project::create([
            'owner_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'prefix' => $request->prefix
        ]);
        
        auth()->user()->assignProject($project);
        auth()->user()->setCurrentProject($project);
        
        if ($request->wantsJson()) {
            return response($project);
        }
        
        return redirect(route('showProject', $project));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $project->update([
            'title' => $request->title ?: $project->title,
            'description' => $request->description ?: $project->description,
            'prefix' => ucwords($request->prefix) ?: $project->prefix,
        ]);
        
        return response($project);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        
        try {
            $project->delete();
        } catch (\Exception $e) {
            return response("Project could not be deleted.", 400);
        }
        
        return response("Project was deleted.");
    }
}
