<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\TimeLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\TimeLogRepository;
use App\Http\Requests\TimeLogRequest;
use Illuminate\Support\Facades\Auth;


class TimeLogController extends Controller
{
    protected $timeLogRepository;

    public function __construct(TimeLogRepository $timeLogRepository)
    {
        $this->timeLogRepository = $timeLogRepository;
    }

    public function index(Request $request)
    {
        $timeLogs = $this->timeLogRepository->index($request);

        return response()->json([
            'success' => true,
            'message' => 'Time logs fetched successfully',
            'time_logs' => $timeLogs
        ]);
    }

    public function store(TimeLogRequest $request)
    {
        $timeLog = $this->timeLogRepository->store($request);

        return response()->json([
            'success' => true,
            'message' => 'Time log created successfully',
            'time_log' => $timeLog
        ], 201);
    }

    public function show(TimeLog $timeLog)
    {
        $timeLog = $this->timeLogRepository->show($timeLog);
        return response()->json([
            'success' => true,
            'message' => 'Time log fetched successfully',
            'time_log' => $timeLog
        ]);
    }

    public function update(Request $request, TimeLog $timeLog)
    {
        $timeLog = $this->timeLogRepository->update($request, $timeLog);

        return response()->json([
            'success' => true,
            'message' => 'Time log updated successfully',
            'time_log' => $timeLog
        ]);
    }

    public function destroy(TimeLog $timeLog)
    {
        $timeLog = $this->timeLogRepository->destroy($timeLog);

        return response()->json([
            'success' => true,
            'message' => 'Time log deleted successfully'
        ]);
    }

    public function startLog(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
        ]);

        $checkActiveTimeLog = $this->timeLogRepository->checkActiveStartTimeLog($request);
        if ($checkActiveTimeLog) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active time log'
            ], 400);
        }

        $timeLog = $this->timeLogRepository->startTimeLog($request);

        return response()->json([
            'success' => true,
            'message' => 'Time tracking started',
            'time_log' => $timeLog
        ], 201);
    }

    public function endLog(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
        ]);

        $checkActiveTimeLog = $this->timeLogRepository->checkActiveEndTimeLog($request);
        if (!$checkActiveTimeLog) {
            return response()->json([
                'success' => false,
                'message' => 'No active time log found'
            ], 400);
        }
        $timeLog = $this->timeLogRepository->endTimeLog($request);

        return response()->json([
            'success' => true,
            'message' => 'Time tracking stopped',
            'time_log' => $timeLog
        ]);
    }

    public function report(Request $request)
    {
        $report = $this->timeLogRepository->reportTimeLogs(auth()->user()->id, [
                'client_id' => $request->client_id,
                'project_id' => $request->project_id,
                'from' => $request->from,
                'to' => $request->to
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Time logs fetched successfully',
            'report' => $report
        ]);
    }

    public function exportPdf(Request $request)
    {
        $filters = [
            'project_id' => $request->project_id,
            'client_id' => $request->client_id,
            'from' => $request->from,
            'to' => $request->to
        ];

        $pdf = $this->timeLogRepository->generatePdf(Auth::id(), $filters);

        return $pdf->download('time_logs_'.now()->format('Y-m-d').'.pdf');
    }
}
