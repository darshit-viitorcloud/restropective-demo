@extends('app')

@section('content')
    <div class="container p-5">
        <h5 class="text">
            Applications of Open AI with PHP/Laravel
        </h5>

        <div class="table-responsive mt-5 m-5">
            <table class="table border table-borderless">
                <thead class="table">
                    <div class = "vertical"></div>
                    <tr>
                        <th>Labels</th>
                        <th>Input</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr class="table">
                        <td scope="row">Label-1</td>
                        <td><input type="text" class="form-control-sm" id="input-1"></td>
                        <td><span id="output-1"> </span></td>
                    </tr>
                    <div class = "vertical1"></div>
                    <tr class="table">
                        <td scope="row">Label-2</td>
                        <td><input type="text" class="form-control-sm" id="input-2"></td>
                        <td><span id="output-2"> </span></td>
                    </tr>
                    <tr class="table">
                        <td scope="row">Label-3</td>
                        <td><input type="text"class="form-control-sm" id="input-3"></td>
                        <td><span id="output-3"> </span></td>
                    </tr>
                    <div class = "vertical1"></div>
                    <tr class="table">
                        <td scope="row">Label-4</td>
                        <td><input type="text" class="form-control-sm" id="input-4"></td>
                        <td><span id="output-4"> </span></td>
                    </tr>
                </tbody> 
            </table>
        </div>  
    </div>
@endsection