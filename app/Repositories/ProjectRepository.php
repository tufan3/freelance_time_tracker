<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Project;


class ProjectRepository
{
    public function index()
    {
        try {
            $projects = Project::with('client')->get();

            return $projects;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client index failed!',
                'error' => $th->getMessage(),
            ];
        }
    }

    public function store($request)
    {
        try {
            $project = new Project();
            $project->client_id = $request->client_id;
            $project->title = $request->title;
            $project->description = $request->description;
            $project->status = $request->status;
            $project->deadline = $request->deadline;
            $project->save();

            return $project;
        } catch (\Throwable $th) {
            return [
                'message' => 'Project store failed!'
            ];
        }
    }

    public function show($project)
    {
        try {
            $project = Project::with('client')->find($project);
            return $project;
        } catch (\Throwable $th) {
            return [
                'message' => 'Project show failed!'
            ];
        }
    }

    public function update($request, $project)
    {
        try {
            $project = Project::with('client')->find($project);
            $project->client_id = $request->client_id;
            $project->title = $request->title;
            $project->description = $request->description;
            $project->status = $request->status;
            $project->deadline = $request->deadline;
            $project->save();
            return $project;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client update failed!'
            ];
        }
    }

    public function destroy($project)
    {
        try {
            $project = Project::with('client')->find($project);
            $project->delete();
            return $project;
        } catch (\Throwable $th) {
            return [
                'message' => 'Project destroy failed!'
            ];
        }
    }
}
