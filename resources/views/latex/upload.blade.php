<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-3 mb-5">
            {{ __('welcome') . " " . Auth::user()->name . " " . Auth::user()->surname }}
        </h2>
    </x-slot>
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link
    rel="stylesheet"
    href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
    type="text/css"
    />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>


</head>
<body>
    <div class="container">
        <p><h1>Laravel 9 Multiple Upload Images using Dropzone drag and drop</h1></p>
    </div>

        <form method="post" action="{{route('latex.upload.post')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
        </form>   

    <script type="text/javascript">
    Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.tex",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) {
            console.log(response);
        },
        error: function(file, response){
            return false;
        }
    };

</script>

    <div>
        

    \begin{equation*}
        y(t)=\left[ \dfrac{3}{4}-\dfrac{3}{4}e^{-\frac{4}{5}(t-7)}-\dfrac{3}{5}(t-7)e^{-\frac{4}{5}(t-7)} \right] \eta(t-7)
    \end{equation*}
\

    </div>
</body>
</html>
