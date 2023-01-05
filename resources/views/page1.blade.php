@extends('app')

@section('content')
    <div class="container">
        <h5 class="text text-center mt-4">
            Applications of Open AI API with PHP/Laravel
        </h5>
        <div class="mt-5">
            <table class="table table-borderless" id ="tab">
                <thead class="table">
                    <tr class="text-center border border-2 border-dark">
                        <th>Labels</th>
                        <th>Input</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr class="table text-center">
                        <td scope="row" id="label">moderation</td>
                        <td>
                            <form action="{{route('openAi')}}" method="get">
                            <input type="text" name= "moderation" class="form-control-sm" id="input-1">
                                <span><button type="submit" class="btn bg-dark text-light">click</button></span>
                            </form>
                        </td>
                        <td>
                            @if (isset($moderation))
                                @foreach($moderation->results as $moderat)
                                    @foreach($moderat->categories as $category)
                                        @if($category->violated ==true)
                                            {{$value = $category->category->value}}
                                        <span id="output-1"> {{$value}}</span>
                                        @endif 
                                    @endforeach
                                @endforeach   
                            @endif
                        </td>
                    </tr>
                    <tr class="table text-center">
                        <td scope="row" id="label">Image-Generator</td>
                        <form action="{{route('openAi')}}" method="get">
                            <td><input type="text" class="form-control-sm" name="image" id="input-2">
                                <span><button type="submit" class="btn bg-dark text-light">generate</button></span>
                            </td>
                        </form>
                        @if(isset($url))
                            <td><span id="output-2"><img src="{{$url}}" alt=""> </span></td>    
                        @endif
                    </tr>
                    <tr class="table text-center">
                        <td scope="row" id="label">Spell-Check</td>
                        <form action="{{route('openAi')}}" method="get">
                            <td><input type="text" name="spell" class="form-control-sm text-dark" id="input-3">
                            <span><button type="submit" class="btn bg-dark text-light">click</button></span>
                            </td>
                        </form>
                    <td>
                        <span id="output-3" class="result text-sm">{{$check ?? '-'}}
                        </span>
                    </td>
                    </tr>
                    <tr class="table text-center">
                        <td scope="row" id="label">Text-Completion</td>
                        <form action="{{route('openAi')}}" method="get">
                            <td><input type="text" name="completion" class="form-control-sm" id="input-4"><span ><button type="submit" class="btn bg-dark text-light">click</button></span></td>
                        </form>
                        <td><span id="output-4 " class="result text-sm">{{$demo ?? '-'}}</span></td>
                    </tr>
                </tbody> 
            </table>
        </div>  
    </div>
@endsection