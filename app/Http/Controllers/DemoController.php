<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
class DemoController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function view(Request $request)
    {        
        if($request->spell==null && $request->completion==null && $request->image==null && $request->prompt==null )
        {
            return view('page1');
        }  
        
     
        $spell = $request->spell;
        $completion = $request->completion;
        $generate = $request->image;
        $prompt = $request->moderation;
        
        $result = OpenAI::completions()->create([
        'model' => 'text-davinci-002',
        "temperature" => 0.5,
        'prompt' =>$completion ,
        'frequency_penalty' =>0,
        'presence_penalty'=>0,
        'max_tokens' => 20, 
        "stop"=> ".",
        ]);
        
        $spellingCheck= OpenAI::edits()->create([
        'model' => 'text-davinci-edit-001',
        'input' => $spell,
        'instruction' => 'Fix the spelling mistakes',
        'temperature' => 0.5,
        ]);

        $image = openAI::images()->create([
            'prompt' => $generate,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);
        $moderation = OpenAI::moderations()->create([
            'model' => 'text-moderation-latest',
            'input' => $prompt,
            'instruction' => 'Fix the spelling mistakes',
            'temperature' => 0.5,
        ]);
        
        foreach($image->data as $img)
        {
            $url =  $img['url'];
        }
        $check = $spellingCheck['choices'][0]['text'];
        $demo = $result['choices'][0]['text'];

        return view('page1',compact('demo' ,'check','url','moderation')); 
    }
}
