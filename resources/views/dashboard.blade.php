@php
    $tasks = array(
        (object) [
            "id" => 1,
            "submitted" => true,
            "link" => "testovac.com"
        ],
        (object) [
            "id" => 2,
            "submitted" => false,
            "link" => "matusmokranhehehe.com"
        ]
    );
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-3 mb-5">
            {{ __('welcome') . " " . Auth::user()->name . " " . Auth::user()->surname }}
        </h2>
    </x-slot>

    @if (Auth::user()->role == "Student")
        <!-- <div>
            <h4 class='dashboard-title d-inline-block'>{{__('generate-tasks')}}</h4>
            <x-button>{{__('generate-button')}}</x-button>
        </div>

        <div class="mt-4">
            <h4 class='dashboard-title'>{{__('tasks')}}</h4>
            <div class="row">
                @foreach ($tasks as $task)
                    <x-problem-card :title="$task->id" :submitted="$task->submitted" :link="$task->link"></x-problem-card>
                @endforeach
            </div>
        </div> -->
        <div>
            <h4 class="dashboard-title d-inline-block">{{ __('generate-tasks') }}</h4>
            <x-button>{{ __('generate-button') }}</x-button>
        </div>

        <div class="mt-4">
            <h4 class="dashboard-title">{{ __('tasks') }}</h4>
            <div class="row">
                @foreach ($exerciseSets as $exerciseSet)
                    <div class="col-md-4">
                        <div class="card @if ($exerciseSet->state === 'open') border-success @else border-danger @endif">
                            <div class="card-body">
                                <h5 class="card-title">{{ $exerciseSet->name }}</h5>
                                <p class="card-text">{{ __('From') }}: {{ $exerciseSet->from_date }}</p>
                                <p class="card-text">{{ __('To') }}: {{ $exerciseSet->to_date }}</p>

                                <form action="{{ route('exercise_files.generate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="exercise_set_id" value="{{ $exerciseSet->id }}">
                                    <div class="form-group">
                                        <label for="file">Choose Files:</label>
                                        @foreach ($exerciseSetFiles[$exerciseSet->id] as $file)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="file[]" value="{{ $file->file_id }}">
                                                <label class="form-check-label" for="file">{{ $file->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @elseif (Auth::user()->role == "Teacher")
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="dashboard-title">{{__('Upload LaTex File')}}</h4>
                <a href="{{ route('latex.upload') }}" class="btn btn-primary">{{__('Upload LaTeX')}}</a>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <form method="POST" action="{{ route('exercise_sets.store') }}">
                    @csrf
                    <div class="form-group m-2">
                        <label for="user">Select User:</label>
                        <select class="form-control" name="user" id="user">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group m-2">
                        <label>Select LaTeX Files:</label>
                        @foreach($latexFiles as $latexFile)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="latex_files[]" value="{{ $latexFile->id }}" id="latex_file_{{ $latexFile->id }}">
                                <label class="form-check-label" for="latex_file_{{ $latexFile->id }}">{{ $latexFile->name }}</label>
                                <input type="number" class="form-control" name="latex_file_points[{{ $latexFile->id }}]" placeholder="Max Points" min="0" step="1">
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="form-group m-2">
                        <label for="access_interval">Access Interval:</label>
                        <div class="row">
                            <div class="col">
                                <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Create Exercise Set</button>
                </form>
            </div>
        </div>
    </div>




    @endif


</x-app-layout>
