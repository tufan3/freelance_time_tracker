<?php

namespace App\Repositories;

use App\Models\TimeLog;
use App\Models\Project;
use App\Models\Client;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class TimeLogRepository
{
    public function index($request)
    {
        try {
            $query = TimeLog::with('project', 'user');

        // Filter by project
        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        // Filter by date range
        if ($request->has('from') && $request->has('to')) {
            $query->whereBetween('start_time', [
                Carbon::parse($request->from)->startOfDay(),
                Carbon::parse($request->to)->endOfDay()
            ]);
        }

        // Filter by day
        if ($request->has('day')) {
            $query->whereDate('start_time', Carbon::parse($request->day));
        }

        $timeLogs = $query->orderBy('created_at', 'desc')->get();
        return $timeLogs;
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
            $timeLog = new TimeLog();
            $timeLog->user_id = auth()->user()->id;
            $timeLog->project_id = $request->project_id;
            $timeLog->start_time = $request->start_time;
            $timeLog->end_time = $request->end_time;
            $timeLog->description = $request->description;
            $timeLog->save();
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log store failed!'
            ];
        }
    }

    public function show($timeLog)
    {
        try {
            $timeLog = TimeLog::with('project', 'user')->find($timeLog);
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log show failed!'
            ];
        }
    }

    public function update($request, $timeLog)
    {
        try {
            $timeLog->user_id = auth()->user()->id;
            $timeLog->project_id = $request->project_id;
            $timeLog->start_time = $request->start_time;
            $timeLog->end_time = $request->end_time;
            $timeLog->description = $request->description;
            $timeLog->save();
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log update failed!'
            ];
        }
    }

    public function destroy($timeLog)
    {
        try {
            $timeLog->delete();
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Project destroy failed!'
            ];
        }
    }

    public function startTimeLog($request)
    {
        try {
            $timeLog = new TimeLog();
            $timeLog->user_id = auth()->user()->id;
            $timeLog->project_id = $request->project_id;
            $timeLog->start_time = now();
            $timeLog->end_time = null;
            $timeLog->description = $request->description;
            $timeLog->save();
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log start failed!'
            ];
        }
    }

    public function checkActiveStartTimeLog($request)
    {
        $timeLog = TimeLog::where('user_id', auth()->user()->id)->whereNull('end_time')->first();
        if ($timeLog) {
            return true;
        }
        return false;
    }

    public function checkActiveEndTimeLog($request)
    {
        $timeLog = TimeLog::where('user_id', auth()->user()->id)->whereNotNull('start_time')->first();
        if ($timeLog) {
            return true;
        }
        return false;
    }

    public function endTimeLog($request)
    {
        try {
            $timeLog = TimeLog::where('user_id', auth()->user()->id)->whereNull('end_time')->first();
            $timeLog->end_time = now();
            $timeLog->hours = round(now()->diffInMinutes($timeLog->start_time) / 60, 2);
            $timeLog->save();
            return $timeLog;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log end failed!'
            ];
        }
    }

        public function reportTimeLogs($userId, array $filters = [])
        {
            try {

            $query = TimeLog::where('user_id', $userId);

            if (!empty($filters['project_id'])) {
                $query->where('project_id', $filters['project_id']);
            }

            if (!empty($filters['client_id'])) {
                $query->whereHas('project', function($q) use ($filters) {
                    $q->where('client_id', $filters['client_id']);
                });
            }

            if (!empty($filters['from'])) {
                $query->whereDate('start_time', '>=', $filters['from']);
            }

            if (!empty($filters['to'])) {
                $query->whereDate('start_time', '<=', $filters['to']);
            }

            $logs = $query->get();

            $totalHours = $logs->sum('hours');

            $byProject = $logs->groupBy('project_id')->map(function($projectLogs) {
                return [
                    'project' => $projectLogs->first()->project->title,
                    'hours' => $projectLogs->sum('hours'),
                    'logs' => $projectLogs
                ];
            });

            $byClient = $logs->groupBy('project.client_id')->map(function($clientLogs) {
                return [
                    'client' => $clientLogs->first()->project->client->name,
                    'hours' => $clientLogs->sum('hours'),
                    'projects' => $clientLogs->groupBy('project_id')->map(function($projectLogs) {
                        return [
                            'project' => $projectLogs->first()->project->title,
                            'hours' => $projectLogs->sum('hours')
                        ];
                    })
                ];
            });

            $byDate = $logs->groupBy(function($log) {
                return Carbon::parse($log->start_time)->format('Y-m-d');
            })->map(function($dateLogs, $date) {
                return [
                    'date' => $date,
                    'hours' => $dateLogs->sum('hours'),
                    'logs' => $dateLogs
                ];
            });

            return [
                'total_hours' => $totalHours,
                'by_project' => $byProject,
                'by_client' => $byClient,
                'by_date' => $byDate
            ];


        } catch (\Throwable $th) {
            return [
                'message' => 'Time log report failed!'
            ];
        }
    }

    public function getTotalHours($userId, array $filters = [])
    {
        $query = TimeLog::where('user_id', $userId);

        if (!empty($filters['project_id'])) {
            $query->where('project_id', $filters['project_id']);
        }

        if (!empty($filters['client_id'])) {
            $query->whereHas('project', function($q) use ($filters) {
                $q->where('client_id', $filters['client_id']);
            });
        }

        if (!empty($filters['date'])) {
            $query->whereDate('start_time', $filters['date']);
        }

        return $query->sum('hours');
    }

    public function getUserLogs($userId, array $filters = [])
    {
        $query = TimeLog::where('user_id', $userId)
            ->with(['project.client'])
            ->orderBy('start_time', 'desc');

        if (!empty($filters['project_id'])) {
            $query->where('project_id', $filters['project_id']);
        }

        if (!empty($filters['client_id'])) {
            $query->whereHas('project', function($q) use ($filters) {
                $q->where('client_id', $filters['client_id']);
            });
        }

        if (!empty($filters['from'])) {
            $query->whereDate('start_time', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('start_time', '<=', $filters['to']);
        }

        if (!empty($filters['date'])) {
            $query->whereDate('start_time', $filters['date']);
        }

        return $query->get();
    }

    public function generatePdf($userId, array $filters = [])
    {
        try {
            $logs = $this->reportTimeLogs($userId, $filters);
            $totalHours = $this->getTotalHours($userId, $filters);
            $pdf = PDF::loadView('pdf.time_logs', [
                'logs' => $logs,
                'totalHours' => $totalHours,
                'filters' => $filters
            ]);
            return $pdf;
        } catch (\Throwable $th) {
            return [
                'message' => 'Time log report failed!'
            ];
        }
    }
}
