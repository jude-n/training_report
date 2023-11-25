<?php

namespace App\Services;

use InvalidArgumentException;

class TrainingReportService
{
    public function calculateCompletedTrainings($trainings)
    {
//        dd($trainings);
        if (!is_array($trainings)) {
            throw new InvalidArgumentException('Training data must be an array.');
        }

//    array to store completed trainings
        $completedTrainings = [];
//    loop through each person
        foreach ($trainings as $person) {
            if (!isset($person->completions) || !is_array($person->completions)) {
                continue; // Skip if no 'completions' key or if it's not an array
            }
//        temp array for each training
            $tempTrainingArray = [];
//        loop through each training
            foreach ($person->completions as $completedTraining) {
//            get training name
                $trainingName = $completedTraining->name;
//            check if training is already completed
                if (!isset($completedTrainings[$trainingName])) {
                    $completedTrainings[$trainingName] = 0;
                } else {
//                check if training has been done once already by user
                    if (!isset($tempTrainingArray[$trainingName])) {
                        $completedTrainings[$trainingName]++;
                    }
                }
//            add training to temp array
                $tempTrainingArray[$trainingName] = 1;
            }
        }
        return $completedTrainings;
    }

    public function getParticipantsForTrainingInFiscalYear($trainings, $selectedTrainings, $fiscalYear)
    {
        $startOfFiscalYear = strtotime('07/01/' . $fiscalYear - 1);
        $endOfFiscalYear = strtotime('06/30/' . ($fiscalYear));
        $cleanedSelectedTrainings = $this->cleanUpSelectedTrainings($selectedTrainings);

        $attendance = [];
        foreach ($cleanedSelectedTrainings as $training) {
            $names = [];
            foreach ($trainings as $person) {

                $filteredCompletions = $this->filterTrainingCompletionByName($person, $training);

                if (empty($filteredCompletions)) {
                    continue;
                }

                $completions = $this->filterByFiscalYear($filteredCompletions, $startOfFiscalYear, $endOfFiscalYear);
                if (count($completions) > 0) {
                    $names[] = $person->name;
                }
            }
            if (count($names) > 0) {
                $attendance[$training] = $names;
            }
        }
        return $attendance;
    }

    public function findPeopleWithExpiredOrSoonExpiringTrainings($trainings, $dateGiven)
    {
        $sortedData = [];
        $expired_or_expiring_trainings = [];
        $date = strtotime($dateGiven);
        $newDate = date('m/d/Y ', $date);

        foreach ($trainings as $person) {
            usort($person->completions, function ($a, $b) {
                return strtotime($b->timestamp) - strtotime($a->timestamp);
            });
            $encountered = [];
            foreach ($person->completions as $training) {
                $tempArray = [];
                $trainingName = $training->name;
                $trainingDate = $training->timestamp;
                if (!isset($encountered[$trainingName])) {
                    if ($trainingDate < $newDate) {
                        $tempArray['name'] = $trainingName;
                        $tempArray['timestamp'] = $trainingDate;
                        $tempArray['status'] = 'Expired';
                    } else if ($trainingDate <= date('m/d/Y', strtotime("+1 month", $date))) {
                        $tempArray['name'] = $trainingName;
                        $tempArray['timestamp'] = $trainingDate;
                        $tempArray['status'] = 'Expires soon';
                    }
                    $encountered[$trainingName] = 1;
                }
                if (!empty($tempArray)) {
                    $expired_or_expiring_trainings[$person->name]['completions'][] = $tempArray;
                }
            }
        }
        return $expired_or_expiring_trainings;
    }

    /**
     * @param $selectedTrainings
     * @return array|string[]
     */
    private function cleanUpSelectedTrainings($selectedTrainings): array
    {
        $selectedTrainings = explode(',', $selectedTrainings);
        $selectedTrainings = array_map(function ($item) {
            return trim($item, '"');
        }, $selectedTrainings);
        return array_map('trim', $selectedTrainings);
    }

    /**
     * @param mixed $person
     * @param string $training
     * @return array
     */
    private function filterTrainingCompletionByName(mixed $person, string $training): array
    {
        $trainingNames = array_filter($person->completions, function ($item) use ($training) {
            return $item->name === $training;
        });
        return $trainingNames;
    }

    /**
     * @param mixed $person
     * @param bool|int $startOfFiscalYear
     * @param bool|int $endOfFiscalYear
     * @return array
     */
    private function filterByFiscalYear(mixed $completions, bool|int $startOfFiscalYear, bool|int $endOfFiscalYear): array
    {
        $filteredCompletions = array_filter($completions, function ($item) use ($startOfFiscalYear, $endOfFiscalYear) {
            $date = strtotime($item->timestamp);
            return $date >= $startOfFiscalYear && $date <= $endOfFiscalYear;
        });
        return $filteredCompletions;
    }

}