<?php

namespace App\Http\Controllers;
use App\Models\Latex; // Replace "File" with your actual model name
use App\Models\Task;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

use function PHPUnit\Framework\matches;

class LatexController extends Controller
{
    public function uploadPage()
    {
        return view('latex.upload');
    }

    public function upload(Request $request)
    {
        // Retrieve the uploaded file
        $file = $request->file('file');

        // Check if the uploaded file is a JPG image
        if ($file->getClientOriginalExtension() === 'jpg') {
            // Get the original file name
            $originalFileName = $file->getClientOriginalName();

            // Store the image file in the specified folder with the original file name
            // $fileName = preg_replace('/^\d{14}/', '', $originalFileName);
            $fileName = substr($originalFileName, 13);

            $path = $file->storeAs('public/images', $fileName, 'local');


            // Save the original filename and image file path to the database
            // $uploadedFile = new Latex();
            // $uploadedFile->original_filename = $originalFileName;
            // $uploadedFile->image_path = $path;
            // $uploadedFile->save();

            return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $originalFileName]);
        }else{
            // Read the content of the file
            $content = $file->get();
            // Get the filename
            $fullFilename = basename($file->getClientOriginalName());
            $filename = pathinfo($fullFilename, PATHINFO_FILENAME);

            // Save the file content to the database
            // Assuming you have a "File" model with a "content" attribute
            $uploadedFile = new Latex();
            $uploadedFile->content = $content;
            $uploadedFile->name =  $filename;
            $uploadedFile->save();

            $content33 = "\\begin aa \\end";

            // $content2 = str_replace([' ', "\n"], '', $content);
            // Extract the content between \begin{task} and \end{task}
            $taskPattern = '/(begin{task})(.*?)(\\\\end{task})/s';
            preg_match_all($taskPattern, $content, $taskMatches);
            $taskContents = $taskMatches[2];

            $pattern = '/\\\\includegraphics{(.*?)}/'; // Pattern to match \includegraphics{...}
            $filenames = array(); // Array to store the extracted filenames

            // Replace \includegraphics{...} with an empty string and extract filenames
            foreach ($taskContents as $index => $taskContent) {
                $taskContent = preg_replace_callback($pattern, function($matches) use (&$filenames) {
                    $filename = $matches[1]; // Extract the filename
                    $filename = substr(strrchr($filename, '/'), 1);
                    $filenames[] = $filename;
                    return ''; // Replace with an empty string
                }, $taskContent);
            }

            $taskContents = preg_replace_callback($pattern, function($matches) use (&$filenames) {
                return ''; // Replace with an empty string
            }, $taskContents);

            $taskContents = str_replace('$', '', $taskContents);

            $equationTag = '\begin{equation*}';
            $pattern = '/\\\\begin\{equation\*\}/';

            foreach ($taskContents as $index => $taskContent) {
                if (!preg_match($pattern, $taskContent)) {
                    $taskContents[$index] = $equationTag . $taskContents[$index] . '\end{equation*}';
                }
            }

            // Extract the content between \begin{solution} and \end{solution}
            $solutionPattern = '/(begin{solution})(.*?)(\\\\end{solution})/s';
            preg_match_all($solutionPattern, $content, $solutionMatches);
            $solutionContents = $solutionMatches[2];

            $pattern = '/\\begin{equation*}\s(.?)\s*\\end{equation*}/s';
            $replacement = '$1';
            $solutionContents = preg_replace($pattern, $replacement, $solutionContents);

            $sectionPattern = '/(section)(.*?)(begin{task})/s';
            preg_match_all($sectionPattern, $content, $sectionMatches);
            $sectionContents = $sectionMatches[2];

            // echo "ahoj";
            // echo $solutionContents;

            // Save the tasks with the corresponding file ID
            foreach ($taskContents as $index => $taskContent) {

                $task = new Task();
                $task->latex_id = $uploadedFile->id; // Set the LaTeX file ID

                $pattern = '/\{(.*?)\}/'; // Regex pattern to match text within curly braces
                if (preg_match($pattern, $sectionContents[$index], $matches)) {
                    $extractedText = $matches[1]; // Extracted text within curly braces
                }

                $task->section = $extractedText;
                $task->task = $taskContent;
                $task->solution = $solutionContents[$index];

                if (isset($filenames[$index])) {
                    $task->image_name = $filenames[$index]; // Set the extracted filename
                }

                $task->save();
            }

            return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $taskContents]);
        }
    }
}
