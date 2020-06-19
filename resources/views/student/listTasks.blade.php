<?php
  use App\User;
  use App\Teacher;
  use App\Task;
  use App\Solution;
?>

@extends('layout')

@section('title', 'Feladatok listája')

@section('content')

  <div class="container">
    <div class="row">
      {{-- Task Related --}}
      <div class="col">
        <div class="row justify-content-center">
          <h1 class="my-5 text-white">Feladatok listája</h1>
        </div>
        <div class="row justify-content-center">
          @if(count($subjects) > 0)
            <table class="table bg-warning">
              <thead>
                <tr>
                  <th scope="col">Név</th>
                  <th scope="col">Pontszám</th>
                  <th scope="col">Elérhető</th>
                  <th scope="col">Határidő</th>
                  <th scope="col">Beadva</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subjects as $subject)
                  @php
                      $tasks = Task::where('subject_id', '=', $subject['id'])->get();
                  @endphp
                  @if(count($tasks))
                    <tr class="bg-secondary">
                      <td>{{ $subject['name'] }}</td>
                    </tr>
                    @if(count($tasks))
                      @foreach($tasks as $task)
                        @php
                          $solutions = Solution::where([
                            ['student_id', '=', Auth::user()->student->id],
                            ['task_id', '=', $task['id']]
                          ])->get();
                        @endphp
                        @if($task['start_date'] < $mytime && $mytime < $task['end_date'])
                          <tr class="bg-primary">
                            <td><a class="nav-item nav-link font-weight-bold text-dark" href="{{ route('task.solution.create', ['task' => $task['id']]) }}">{{ $task['name'] }}</a></td>
                            <td>{{ $task['points'] }}</td>
                            <td>{{ $task['start_date'] }}</td>
                            <td>{{ $task['end_date'] }}</td>
                            <td>{{ count($solutions) > 0 ? 'Igen' : 'Nem' }}</td>
                          </tr>
                        @endif
                      @endforeach
                    @endif
                  @endif

                @endforeach
              </tbody>
            </table>
          @else
            <h1 class="my-5 bg-warning text-dark">Nincs még feladat!</h1>
          @endif
        </div>
      </div>
  
    </div> {{-- First Row --}}
  </div> {{-- Container --}}

@endsection