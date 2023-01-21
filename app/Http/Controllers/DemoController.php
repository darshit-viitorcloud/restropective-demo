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

    public function page1()
    {
        return view('page1');
    }

    public function textModeration(Request $request)
    {
        $input=$request->input;
        $moderation = OpenAI::moderations()->create([
            'model' => 'text-moderation-latest',
            'input' => $input
        ]);

        $categories = $moderation->results[0]->categories;
        $indexOfViolatedCategory = array_search('true',array_column($categories, 'violated'));
        if(gettype($indexOfViolatedCategory)=='integer'){
            $keys = array_keys($categories);
            $category = $keys[$indexOfViolatedCategory];
        } else {
            $category = 'None';
        }

        $response = [
            'success' => true,
            'output' => $category
        ];
        return response()->json($response);
    }

    public function spellCheck(Request $request)
    {
        $input=$request->input;
        $spellingCheck= OpenAI::edits()->create([
            'model' => 'text-davinci-edit-001',
            'input' => $input,
            'instruction' => 'Fix the spelling mistakes',
            'temperature' => 0.5,
            ]);
        $check = $spellingCheck['choices'][0]['text'];

        $response = [
            'success' => true,
            'output' => $check
        ];
        return response()->json($response);
    }

    public function textCompletion(Request $request)
    {
        $input=$request->input;

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-002',
            "temperature" => 0.5,
            'prompt' =>$input ,
            'frequency_penalty' =>0,
            'presence_penalty'=>0,
            'max_tokens' => 15,
            "stop"=> ".",
            ]);
        $demo = $result['choices'][0]['text'];

        $response = [
            'success' => true,
            'output' => $demo
        ];
        return response()->json($response);
    }

    public function imageGeneration(Request $request)
    {
        $input=$request->input;
        $image = openAI::images()->create([
            'prompt' => $input,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);
        foreach($image->data as $img)
        {
            $url =  $img['url'];
        }
        $response = [
            'success' => true,
            'output' => $url
        ];
        return response()->json($response);

    }

    public function imageVariation(Request $request)
    {
        $extension = $request->image->extension();
       // $request->image->move(public_path('images'), 'test_image'.'.'.$request->image->extension());
       // $imagePath = public_path().'/images/test_image'.'.'.$extension;
        //dd(fopen($imagePath,'r'));

        $image = openAI::images()->variation([
            'image' => fopen('123.png','r'),
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);
        foreach($image->data as $img)
        {
            $url =  $img['url'];
        }
        dd($url);
        $response = [
            'success' => true,
            'output' => $url
        ];
        return response()->json($response);

    }

    /*public function view(Request $request)
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
    }*/
}
