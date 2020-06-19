<?php
  use App\User;
  use App\Teacher;
?>

@extends('layout')

@section('title', 'Tárgyak')

@section('content')

  <div class="container">
    <h1 class="mt-3 bg-warning text-dark">Tárgyaim</h1>
    <div class="row">
      @foreach($subjects as $subject)
        @php
          $searchid = $subject['teacher_id'];
          $teacher = Teacher::find($searchid);
        @endphp
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

              <form action="{{ route('remove', ['id' => $subject['id']]) }}" method="post" class="d-inline">
                @csrf
                @method('post')
                <button class="btn btn-warning mt-3">Lead</button>
              </form>

            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection