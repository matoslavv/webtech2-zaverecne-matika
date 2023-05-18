<x-app-layout>
    
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
   
    <div class="container">
        <div id="documentation">
            @if (Auth::user()->role == "Student")
            <p class="mt-4">Documentation for Student</p>
            <p>After logging in as a student, you will see assignments assigned by the teacher.</p> 
            <p> When they are green, you can generate them by choosing a set of examples.
                When they are in red, they cannot be generated because they are past or before the deadline.</p>
                <p>   After the example is generated, it will move you to the place of calculation, if you calculate it correctly it will light up in green, if it is incorrect it will light up in red. </p>

            @elseif (Auth::user()->role == "Teacher")
            <p class="mt-4">Documentation for Teacher</p>
            <p>After logging in as a teacher, you will see two buttons, one for uploading latex examples and the other for displaying tables.</p>
            <p> The upload new examples button works on drag and drop or after clicking you can select the given file, it is uploaded automatically after adding.
                The tables show the students how they did and what tasks you assigned them.</p>
            <p> Under the buttons, you will see students to whom you can assign tasks and assignments
                available examples that you have uploaded.
                If you choose an example, you can assign how many points it will have.
            </p>
            @endif
        </div>

        <button class="btn btn-primary mt-4" onclick="createPDF()">{{ __('generatePdf') }}</button> 
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
			integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
<script>
    function createPDF() {
       
		let doc = document.querySelector('#documentation');

		let pdf = new jsPDF('p', 'in', 'a4',true);
        let verticvalOffset = 0.5;
        let textLines = pdf.setFont('Arial', 'normal').setFontSize(12).splitTextToSize(doc.innerText,7,25);
		pdf.text(0.5,verticvalOffset+12/72,textLines);
        verticvalOffset+=(textLines.lenght + 0.5) * 12 /72
		pdf.save('doc.pdf');
		
    }
</script>
</body>
</html>