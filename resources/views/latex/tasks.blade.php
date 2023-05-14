<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-3 mb-5">
            {{ __('welcome') . " " . Auth::user()->name . " " . Auth::user()->surname }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Exercise Set ID: {{ $exerciseSetId }}</h1>
        <h2>Tasks:</h2>
        @foreach ($tasks as $task)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $task->task }}</p>
                    <form action="{{ route('submit_answer') }}" method="POST">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="answer" placeholder="Enter your answer">
                            <button type="submit" class="btn btn-primary">Submit Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>


    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

</x-app-layout>

