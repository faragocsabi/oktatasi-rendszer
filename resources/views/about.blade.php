@extends('layout')

@section('title', 'Kezdőlap')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>Készítő</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                <h1>Faragó Csaba</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>GitHub</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                <a href="https://github.com/faragocsabi" class="btn btn-warning stretched-link"><h1 class="text-primary">faragocsabi</h1></a>
                
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>Email</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                <h1>f.csaba5040@gmail.com</h1>
            </div>
        </div>
    </div>

</div>

@endsection