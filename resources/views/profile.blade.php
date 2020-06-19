@extends('layout')

@section('title', 'Profil')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>Név</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                <h1>{{ Auth::user()->name }}</h1>
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
            <h1>{{ Auth::user()->email }}</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>Beosztás</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                @if(Auth::user()->is_teacher === '1')
                    <h1>Tanár</h1>
                @else
                    <h1>Diák</h1>
                @endif
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card mt-5 bg-secondary text-white">
            <div class="card-body">
                <h1>Regisztráció ideje:</h1>
            </div>
        </div>

        <div class="card mt-5 bg-warning">
            <div class="card-body">
                <h1>{{ Auth::user()->created_at }}</h1>
            </div>
        </div>
    </div>

</div>

@endsection