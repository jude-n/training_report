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
        echo $fiscalYear;
        $selectedTrainings = $request->input('selectedTrainings');
//        dd($selectedTrainings);
        $expiryDate = $request->input('expiryDate');


        $fileName = time() . '.' . $request->file->extension();

        $fileContent = file_get_contents($request->file);
//        dd($fileContent);
        $trainings = json_decode($fileContent);
//        dd($fileContent, $trainings);
//        $trainingParticipantCount = $this->trainingReportService->calculateCompletedTrainings($trainings);
        $participants = $this->trainingReportService->getParticipantsForTrainingInFiscalYear($trainings, $selectedTrainings, $fiscalYear);
//        $peopleWithExpiredTrainings = $this->trainingReportService->findPeopleWithExpiredOrSoonExpiringTrainings($trainings, $expiryDate);

        dd($participants);
//        dd($trainingParticipantCount, $participants, $peopleWithExpiredTrainings);
//        $request->file->move(public_path('uploads'), $fileName);
//
//        return back()
//            ->with('success','You have successfully upload file.')
//            ->with('file',$fileName);
    }
}
