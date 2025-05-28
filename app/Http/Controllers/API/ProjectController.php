<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProjectRepository;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        $projects = $this->projectRepository->index();
        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully',
            'projects' => $projects
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $project = $this->projectRepository->store($request);
        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }

    public function show($project)
    {
        $project = $this->projectRepository->show($project);
        return response()->json([
            'success' => true,
            'message' => 'Project fetched successfully',
            'project' => $project
        ]);
    }

    public function update(ProjectRequest $request, $project)
    {
        $project = $this->projectRepository->update($request, $project);
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    public function destroy($project)
    {
        $this->projectRepository->destroy($project);
        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully',
        ]);
    }
}
