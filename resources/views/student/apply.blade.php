<?php
  use App\User;
  use App\Teacher;
  use App\Subject;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Collection;
?>
@extends('layout')

@section('title', 'Tárgyfelvétel')

@section('content')

  <div class="container">
    <h1 class="mt-3 bg-warning text-dark">Tárgyfelvétel</h1>
    <div class="row">
      @foreach($subjects as $subject)
        @if($subject['public'] == '1')

          @php
            $searchid = $subject['teacher_id'];
            $teacher = Teacher::find($searchid);
            $students = $subject->students->toArray();
            $success = false;
            foreach ($students as $student) {
              if(Auth::user()->student->id === $student['id'])
              $success = true;
            }
          @endphp

          @if(!$success)
            <div class="col-sm-3 my-3">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title">{{ $subject['name'] }}</h5>
                  <p class="card-text">Leírás: {{ $subject['description'] }}</p>
                  <p class="card-text">Kód: {{ $subject['code'] }}</p>
                  <p class="card-text">Kredit: {{ $subject['credit'] }}</p>
                  <p class="card-text">Tanár: {{ $teacher['name'] }}</p>
                  <p class="card-text"><small class="text-muted">Utoljára módosítva: {{ $subject['updated_at'] }}</small></p>
                  <a href="{{ route('subject.show', ['subject' => $subject['id']]) }}" class="btn btn-primary mt-3">Megnyitás</a>

                  <form action="{{ route('apply', ['id' => $subject['id']]) }}" method="post" class="d-inline">
                    @csrf
                    @method('post')
                    <button class="btn btn-success mt-3">Felvesz</button>
                  </form>

                </div>
              </div>
            </div>
          @endif
        @endif
      @endforeach
    </div>
  </div>

@endsection