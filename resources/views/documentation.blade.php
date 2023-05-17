<x-app-layout>
    
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
   
    <div id="documentation">
        @if (Auth::user()->role == "Student")
        <p>Documentation for Student</p>
        <p>After logging in, the student sees his assigned examples given by the teacher, if they are green they are available red they are unavailable (planned).
            After assigning examples, an example can be generated
        </p>

        @elseif (Auth::user()->role == "Teacher")
        <p>Documentation for Teacher</p>
        <p>After logging in, the teacher will see options for students to add examples to.The teacher can upload new latex files</p>
         @endif

    </div>
    <button onclick="createPDF()">click</button> 

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