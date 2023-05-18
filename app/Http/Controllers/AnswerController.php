<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ExerciseSet; 
// use App\Models\ExerciseSetFile;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\DB;




class AnswerController extends Controller
{   
    private $open_ai;

    function __construct() {
        $apiKey = config('api.api_key');
        $this->open_ai = new OpenAi($apiKey);
    }

    public function submitAnswer(Request $request) {

        // var_dump($request);
        
        

        // $taskId = $request->input('task_id');
        // $latexContent = $request->input('latex_content');
        
        // return response()->json(['success' => $request->request->get('latex_content')], 200);

        // return response()->json(['success' => $request->all('latex_content')], 200);

        $latexContent = $request->request->get('latex_content');
        $taskId = $request->request->get('task_id');
        $setId = $request->request->get('set_id');
        
        $data = [
            'task_id' => intval($taskId),
            'latex_content' => $latexContent
        ];

        

        $task = Task::find(intval($taskId));

        // $leagues = DB::table('exercise_sets')
        //     ->select('exercise_set_files.max_points')
        //     ->join('exercise_set_files', 'exercise_set_files.exercise_set_id', '=', $setId)
        //     ->join('latex', 'exercise_set_files.latex_file_id','=', $task->latex_id)
        //     ->get();

        $maxPoints = DB::table('exercise_set_files')
            ->where('latex_file_id', $task->latex_id)
            ->where('exercise_set_id', $setId)
            ->max('max_points');


            // return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $maxPoints],200);


        // $exSetFile = ExcersiseSetFile::find($task->latex_id);

        

        // return response()->json(['success' => $request->all('latex_content'),'task' => $task],200);

        if (!$task) {
            // Task with the specified ID was not found
            // Handle the response accordingly, e.g., return an error message or redirect
            return response()->json(['error' => 'Task not found'], 404);
        }
        
       

        $replacedString = str_replace('\n', '"', $task->solution);
        $trimmedString = trim($replacedString);

        // echo $latexContent;

        
        

        $question = "Answer in one word 'yes' or 'no' if Expression 1 and Expression 2  are equivalent.
                        Expression1:" . $latexContent  . '
                        Expression2:' . $task->solution ;
                    

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

        // return response()->json(['success' => $latexContent, 'chat' => $task->solution, 'question' =>  $question], 200);
        

        $chat = json_decode($chat);
        $res = str_replace(".", "", strtolower(trim($chat->choices[0]->message->content)));


        if(strcmp($res,"yes") == 0){
            $exSet = ExerciseSet::find($setId);
            $exSet->points=$exSet->points+$maxPoints;
            $exSet->save();
        }
      

        return response()->json(['success' => 'File uploaded successfully.', 'taskContents' => $data, 'message' => $res,'question' =>  $question,'set'=> $setId],200);
        // return response(['success' => 'File uploaded successfully.', 'taskContents' => $data, 'message' => $res]);
        // return redirect()->route('exercise_files.generate')->with('message', $res);

    }
}
