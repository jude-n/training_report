@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Data Overview</h1>
            <form method="post" target="_blank" action="{{ route('training.data.export') }}">
                @csrf
                <input type="hidden" name="trainingParticipantCount" value="{{ serialize($trainingParticipantCount) }}">
                <input type="hidden" name="participants" value="{{ serialize($participants) }}">
                <input type="hidden" name="peopleWithExpiredTrainings" value="{{ serialize($peopleWithExpiredTrainings) }}">
            <button class="bg-primary text-white px-4 py-2 rounded">Export All</button>
            </form>
        </div>

        <div class="mt-8">
            <div class="flex flex-wrap -mb-4">
                <h2 class="text-3xl mb-6 text-gray-700">Overview of Training Completion - Task One</h2>
                <table class="w-full table-auto border-collapse  rounded shadow-lg">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Participant Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trainingParticipantCount as $training)
                        <tr>
                            <td class="px-4 py-2 border">{{ $training['name'] }}</td>
                            <td class="px-4 py-2 border">{{ $training['count'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-t border-gray-300 mt-16"></div>

        <div class="bg-gray-100 py-6 mt-8">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl mb-6 text-gray-700">Completion Record for Trainings - Task Two</h2>
                <div class="flex flex-wrap items-start justify-start mt-8">
                    @foreach ($participants as $training)
                        <div class="p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4">
                            <div class="h-full bg-white rounded shadow-lg">
                                <div class="p-6">
                                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:truncate">
                                        {{ $training['name'] }}
                                    </h2>
                                    <div class="pt-4 text-base leading-6 text-gray-500 overflow-auto pb-5">
                                        <ul class="list-disc list-inside">
                                            @foreach ($training['attendees'] as $attendee)
                                                <li class="border-b border-gray-300 py-1">{{ $attendee['name'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-gray-300 mt-16"></div>

        <div class="bg-white py-6 mt-8">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl mb-6 text-gray-700">Training Expiry Status For Individuals - Task Three</h2>
                <div class="flex flex-wrap justify-start mt-8">
                    @foreach ($peopleWithExpiredTrainings as $person)
                        <div class="p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4">
                            <div class="h-full bg-white rounded shadow-lg">
                                <div class="p-6">
                                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:truncate">
                                        {{ $person['name']}}
                                    </h2>
                                    <div class="pt-6 text-base leading-6 text-gray-500 overflow-auto">
                                        @foreach ($person['completions'] as $completedTraining)
                                            <div class="mb-4">
                                                <p><strong>Training:</strong>{{ $completedTraining['name'] }}</p>
                                                <p><strong>Date:</strong> {{ $completedTraining['timestamp'] }}</p>
                                                <p><strong>Status:</strong> {{ $completedTraining['status'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
@endsection