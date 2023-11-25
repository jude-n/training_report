<?php

namespace App\Http\Controllers;

use App\Services\TrainingReportService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    protected $trainingReportService;

    public function __construct(TrainingReportService $trainingReportService)
    {
        $this->trainingReportService = $trainingReportService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt,json',
        ]);
        $fiscalYear = $request->input('fiscalYear');
        $selectedTrainings = $request->input('selectedTrainings');
        $expiryDate = $request->input('expiryDate');

        $fileContent = file_get_contents($request->file);

        $trainings = json_decode($fileContent);

        $trainingParticipantCount = $this->trainingReportService->calculateCompletedTrainings($trainings);

        $participants = $this->trainingReportService->getParticipantsForTrainingInFiscalYear($trainings, $selectedTrainings, $fiscalYear);

        $peopleWithExpiredTrainings = $this->trainingReportService->findPeopleWithExpiredOrSoonExpiringTrainings($trainings, $expiryDate);

        return view('pages.display', compact('trainingParticipantCount', 'participants', 'peopleWithExpiredTrainings'));

    }

    public function display()
    {
        return view('pages.display');
    }
}
