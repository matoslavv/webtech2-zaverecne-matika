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
        {{-- <div>
            <h4 class="dashboard-title d-inline-block">{{ __('generate-tasks') }}</h4>
            <x-button>{{ __('generate-button') }}</x-button>
        </div> --}}

        <div class="mt-4">
            <h3 class="dashboard-title mb-3">{{ __('tasks') }}</h3>
            <div class="row">
                @foreach ($exerciseSets as $exerciseSet)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-3 @if ($exerciseSet->state === 'open') border-success @else border-danger @endif " style="height: 400px">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="">
                                    <p class="card-text">{{ __('From') }}: {{ $exerciseSet->from_date }}</p>
                                    <p class="card-text">{{ __('To') }}: {{ $exerciseSet->to_date }}</p>
                                </div>
                                <div class="">
                                    <p class="card-text">{{ __('points') }}: {{ $exerciseSet->points }}</p>
                                    <p class="card-text">{{ __('max-points') }}: {{ $exerciseSet->max_points }}</p>
                                </div>

                                <form action="{{ route('exercise_files.generate') }}" method="POST" onsubmit="return validateFormStudent('{{ $exerciseSet->id }}')"  class="mb-0">
                                    @csrf
                                    <input type="hidden" name="exercise_set_id" value="{{ $exerciseSet->id }}">
                                    <div class="form-group mb-3">
                                        <label for="file">{{ __('select-file') }}: </label>
                                        @foreach ($exerciseSetFiles[$exerciseSet->id] as $file)
                                            <div id="{{ $exerciseSet->id }}" class="form-check my-1">
                                                <input class="form-check-input" type="checkbox" name="file[]" value="{{ $file->file_id }}">
                                                <label class="form-check-label" for="file">{{ $file->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($exerciseSet->state === 'closed')
                                        <button type="submit" class="btn btn-primary w-100" disabled>{{ __('generate') }}</button>
                                    @else
                                        <button type="submit" class="btn btn-primary w-100">{{ __('generate') }}</button>
                                    @endif
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
                <h4 class="dashboard-title">{{__('upload-latex')}}</h4>
                <a href="{{ route('latex.upload') }}" class="btn btn-primary">{{__('upload')}}</a>
            </div>
            <div class="col-md-6">
                <h4 class="dashboard-title">{{__('show-students')}}</h4>
                <a href="{{ route('students.show') }}" class="btn btn-primary">{{__('show')}}</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <form method="POST" action="{{ route('exercise_sets.store') }}" onsubmit="return validateFormTeacher()" class="mb-5">
                    @csrf
                    <div class="form-group my-2">
                        <label class="mb-2" for="user">{{__('select-user')}}:</label>
                        <select class="form-control" name="user" id="user">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-4 mb-2">
                        <label class="mb-2">{{__('select-latex-file')}}:</label>
                        @foreach($latexFiles as $latexFile)
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="latex_files[]" value="{{ $latexFile->id }}" id="latex_file_{{ $latexFile->id }}">
                                <label class="form-check-label" for="latex_file_{{ $latexFile->id }}">{{ $latexFile->name }}</label>
                                <input type="number" id="latex_file_input_{{ $latexFile->id }}" class="form-control mt-1" name="latex_file_points[{{ $latexFile->id }}]" placeholder="{{__('max-points')}}" min="0" step="1">
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group mt-4 mb-2">
                        <label class="mb-2" for="access_interval">{{__('select-access-date')}}:</label>
                        <div class="row">
                            <div class="col mb-2 mb-sm-0">
                                <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100">{{__('create-exercise-set')}}</button>
                </form>
            </div>
        </div>
    </div>




    @endif


</x-app-layout>
<script>
function validateFormTeacher() {
    var markedCheckbox = document.querySelectorAll('input[type="checkbox"]:checked');
    if(markedCheckbox.length == 0){
            alert("{{__('formTechearError2')}}");
            return false
        }
    for (var checkbox of markedCheckbox) {
        let id = checkbox.id.split("_")[2];
        var input=document.getElementById("latex_file_input_"+id);
        if(input.value=== ""){
            alert("{{__('formTechearError')}}");
            return false
        }
    }
    var dates = document.querySelectorAll('input[type="date"]');
    for (var date of dates) {
        if(date.value=== ""){
            alert("{{__('formTechearError1')}}");
            return false
        }
    }
    if(dates[0].value > dates[1].value){
        if(date.value=== ""){
            alert("{{__('formTechearError1')}}");
            return false
        }
    }
}

function validateFormStudent(id) {
    if(document.getElementById(id)){ 
        let children = document.getElementById(id).children;
        for (var child of children) {
            if(child.type === "checkbox"){
            if(child.checked) return true;
            }
        }
    }
    alert("{{__('formStudentError')}}");
    return false;
}
</script>