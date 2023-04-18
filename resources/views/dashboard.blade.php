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
        <div>
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
        </div>
    @endif


</x-app-layout>
