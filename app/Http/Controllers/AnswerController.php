<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;



class AnswerController extends Controller
{
    private $open_ai;

    function __construct() {
        $this->open_ai = new OpenAi("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");
    }

    public function submitAnswer(Request $request) {
        $taskId = $request->input('task_id');
        $latexContent = $request->input('latex_content');

        $data = [
            'task_id' => $taskId,
            'latex_content' => $latexContent
        ];

        $task = Task::find($taskId);

        if (!$task) {
            // Task with the specified ID was not found
            // Handle the response accordingly, e.g., return an error message or redirect
        }

        $question = "Are these expressions equivalent in LaTeX? Just answer 'yes' or 'no'.
                    Expression1: $latexContent
                    Expression2: $task->solution";

        $chat = $this->open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 256,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        $chat = json_decode($chat);
        $res = str_replace(".", "", strtolower(trim($chat->choices[0]->message->content)));

        return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $data, 'message' => $res]);
    }
}
