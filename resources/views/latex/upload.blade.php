<x-app-layout>
    
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
        <p><h1 class="text-center mb-3">{{__('upload-latex')}}</h1></p>
    </div>
        <form method="post" action="{{route('latex.upload.post')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
            @csrf
            <div class="dz-message" data-dz-message><span>{{__('drop-file')}}</span></div>
        </form>

        <script type="text/javascript">
            Dropzone.options.dropzone = {
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
</body>
</html>
