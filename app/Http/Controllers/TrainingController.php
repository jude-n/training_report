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
            'fiscalYear' => 'required',
            'selectedTrainings' => 'required',
            'expiryDate' => 'required',
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

    public function export(Request $request)
    {

        if ($request->has('trainingParticipantCount')) {
            $unserializedTrainingData = unserialize($request->trainingParticipantCount);
            $trainingParticipantCount = json_encode($unserializedTrainingData);
            file_put_contents('trainingParticipantCount-TaskOne.json', $trainingParticipantCount);
        }
        if ($request->has('participants')) {
            $unserializedParticipantData = unserialize($request->participants);
            $particapanst = json_encode($unserializedParticipantData);
            file_put_contents('participants-TaskTwo.json', $particapanst);
        }
        if ($request->has('peopleWithExpiredTrainings')) {
            $unserializedExpiredData = unserialize($request->peopleWithExpiredTrainings);
            $peopleWithExpiredTrainings = json_encode($unserializedExpiredData);
            file_put_contents('peopleWithExpiredTrainings-TaskThree.json', $peopleWithExpiredTrainings);
        }

        $files = array('trainingParticipantCount-TaskOne.json', 'participants-TaskTwo.json', 'peopleWithExpiredTrainings-TaskThree.json');
        $zipname = 'trainingReports.zip';
        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file);
        }
        $zip->close();
        chmod($zipname, 0755);
        return response()->download($zipname);
    }
}
