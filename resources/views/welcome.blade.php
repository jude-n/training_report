@extends('layouts.app')

@section('content')
    <div class="container mx-auto pt-10">
        <div class="max-w-6xl bg-primary-80 p-4 text-white border-2 border-orange px-8 mx-auto mt-8 rounded-lg w-full py-12">
            <h1 class="font-bold text-3xl mb-4">Welcome to the Training Tracker</h1>
            <p class="text-lg">Ever wonder what this marvelous tracker does? It's like a personal assistant, but without the coffee runs. Just nudge it by uploading your training data below and filling in each field. Think of it as a digital version of "connect-the-dots", but much more thrilling!</p>
        </div>
        <div class="flex justify-center content-end rounded-lg mt-16">
            <div class="w-1/2 bg-primary-80 text-white border-2 border-orange p-4 rounded shadow">
                <h1 class="text-2xl font-bold text-center mb-4">Upload a file</h1>
                <!-- Display the success message if any -->
                @if (session('success'))
                    <div class="bg-green-80 border-l-4 border-green-60 text-green-80 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display the validation errors if any -->
                @if ($errors->any())
                    <div class="border-l-4 border-red-80 text-red p-4 mb-4" role="alert">
                        <ul class="list-none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('training.upload') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="flex items-center mb-4">
                        <label for="file" class="w-1/4 text-right mr-4">Select a file:</label>
                        <input type="file" accept=".txt" name="file" id="file" class="w-3/4">
                    </div>
                    <div class="flex items-center mb-4">
                        <label for="fiscalYear" class="w-1/4 text-right mr-4">Fiscal Year:</label>
                        <select required name="fiscalYear" id="fiscalYear" class="w-3/4 h-10 pl-3 pr-6 text-base border rounded-lg appearance-none text-primary">
                            <option value="">Select Fiscal Year</option>
                            @for ($year = date('Y'); $year >= 2000; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex items-start mb-4">
                        <label for="selectedTrainings" class="w-1/4 text-right mr-4 pt-2">Trainings:</label>
                        <div class="w-3/4">
                            <input required type="text" placeholder="e.g. Electrical Safety for Labs, X-Ray Safety" name="selectedTrainings" id="selectedTrainings" class="w-full bg-white text-primary focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block appearance-none">
                            <small class="text-gray-500">Please enter the trainings you would like to see</small>
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <label for="expiryDate" class="w-1/4 text-right mr-4">Expiry:</label>
                        <input required type="date" name="expiryDate" id="expiryDate" class="w-3/4 text-primary">
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-orange border-white uppercase hover:bg-primary-80 text-white font-bold py-2 px-4 rounded">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
