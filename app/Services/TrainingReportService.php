<?php

namespace App\Services;

use InvalidArgumentException;

/**
 *
 */
class TrainingReportService
{
    /**
     * @param $trainings
     * @return array
     */
    public function calculateCompletedTrainings($trainings)
    {
        if (!is_array($trainings)) {
            throw new InvalidArgumentException('Training data must be an array.');
        }

        $completedTrainings = [];
        foreach ($trainings as $person) {
            if (!isset($person->completions) || !is_array($person->completions)) {
                continue;
            }
            $tempTrainingArray = [];

            foreach ($person->completions as $completedTraining) {

                $trainingName = $completedTraining->name;

                if (!isset($completedTrainings[$trainingName])) {
                    $completedTrainings[$trainingName]['name'] = $trainingName;
                    $completedTrainings[$trainingName]['count'] = 0;
                } else {

                    if (!isset($tempTrainingArray[$trainingName])) {
                        $completedTrainings[$trainingName]['count']++;
                    }
                }
                $tempTrainingArray[$trainingName] = 1;
            }
        }
        return array_values($completedTrainings);
    }

    /**
     * @param $trainings
     * @param $selectedTrainings
     * @param $fiscalYear
     * @return array
     */
    public function getParticipantsForTrainingInFiscalYear($trainings, $selectedTrainings, $fiscalYear)
    {
        $startOfFiscalYear = strtotime('07/01/' . $fiscalYear - 1);
        $endOfFiscalYear = strtotime('06/30/' . ($fiscalYear));
        $cleanedSelectedTrainings = $this->cleanUpSelectedTrainings($selectedTrainings);

        $attendance = [];
        foreach ($cleanedSelectedTrainings as $training) {
            $names = [];
            foreach ($trainings as $person) {

                $completions = $this->getTrainingCompletionsForFiscalYear($person, $training, $startOfFiscalYear, $endOfFiscalYear);
                if (!empty($completions)) {
                    $names[]['name'] = $person->name;
                }
            }
            if (!empty($names)) {
                $attendance[$training]['name'] = $training;
                $attendance[$training]['attendees'] = $names;
            }
        }
        return array_values($attendance);
    }

    /**
     * @param $trainings
     * @param $dateGiven
     * @return array
     */
    public function findPeopleWithExpiredOrSoonExpiringTrainings($trainings, $dateGiven)
    {
        $expired_or_expiring_trainings = [];
        $date = strtotime($dateGiven);
        $newDate = date('m/d/Y ', $date);
        $nextMonthDate = date('m/d/Y', strtotime("+1 month", $date));

        foreach ($trainings as $person) {
            usort($person->completions, function ($a, $b) {
                return strtotime($b->timestamp) - strtotime($a->timestamp);
            });
            $encountered = [];
            foreach ($person->completions as $training) {
                $trainingName = $training->name;
                $trainingDate = $training->timestamp;
                if (!isset($encountered[$trainingName])) {
                    $status = $this->getTrainingStatus($training,  $newDate, $nextMonthDate);
                    if (isset($status)) {
                        $details['name'] = $trainingName;
                        $details['timestamp'] = $trainingDate;
                        $details['status'] = $status;
                        $expired_or_expiring_trainings[$person->name]['name'] = $person->name;
                        $expired_or_expiring_trainings[$person->name]['completions'][] = $details;
                    }
                    $encountered[$trainingName] = 1;
                }
            }
        }
        return array_values($expired_or_expiring_trainings);
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
    private function filterTrainingsByFiscalYear(mixed $completions, bool|int $startOfFiscalYear, bool|int $endOfFiscalYear): array
    {
        $filteredCompletions = array_filter($completions, function ($item) use ($startOfFiscalYear, $endOfFiscalYear) {
            $date = strtotime($item->timestamp);
            return $date >= $startOfFiscalYear && $date <= $endOfFiscalYear;
        });
        return $filteredCompletions;
    }

    /**
     * @param mixed $person
     * @param string $training
     * @param bool|int $startOfFiscalYear
     * @param bool|int $endOfFiscalYear
     * @return array
     */
    private function getTrainingCompletionsForFiscalYear(mixed $person, string $training, bool|int $startOfFiscalYear, bool|int $endOfFiscalYear): array
    {
        $filteredCompletions = $this->filterTrainingCompletionByName($person, $training);

        if (empty($filteredCompletions)) {
            return [];
        }

        return $this->filterTrainingsByFiscalYear($filteredCompletions, $startOfFiscalYear, $endOfFiscalYear);
    }

    /**
     * @param mixed $training
     * @param array $encountered
     * @param string $newDate
     * @param string $nextMonthDate
     * @return array
     */
    private function getTrainingStatus(mixed $training, string $newDate, string $nextMonthDate): string|null
    {
        $trainingDate = $training->timestamp;
        if ($trainingDate < $newDate) {
            return 'Expired';
        }
        if ($trainingDate <= $nextMonthDate) {
            return 'Expires soon';
        }
        return null;
    }
}