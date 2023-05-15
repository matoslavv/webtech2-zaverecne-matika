<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function submitAnswer(Request $request)
{
    $taskId = $request->input('task_id');
    $latexContent = $request->input('latex_content');

    $data = [
        'task_id' => $taskId,
        'latex_content' => $latexContent
    ];

    return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $data]);
}
}
