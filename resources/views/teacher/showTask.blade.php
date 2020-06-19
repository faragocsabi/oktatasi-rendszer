@php
    use App\Student;
@endphp

@extends('layout')

@section('title', $task['Név'])

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Adatok</h1>
      </div>
      <div class="row justify-content-center">
        <table class="table-borderless">
          <tbody>
            {{-- Task Related --}}
            @foreach($task as $key => $value)
            @if($key != 'id')
              <tr>
                <td>
                  <div class="card ml-3 bg-secondary text-white">
                    <div class="card-body">
                        <h4>{{ $key }}</h4>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="card mr-3 bg-warning">
                    <div class="card-body">
                        <h4>{{ $value }}</h4>
                    </div>
                  </div>
                </td>
              </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Beadott megoldások</h1>
      </div>

      {{-- Solution Related --}}
      <div class="row justify-content-center">
        <table class="table bg-warning">
          <tbody>
            <thead>
              <tr>
                <th scope="col">Név</th>
                <th scope="col">Email</th>
                <th scope="col">Beadás</th>
                <th scope="col">Értékelés</th>
                <th scope="col">Pontszám</th>
              </tr>
            </thead>
            @foreach($solutions as $solution)
              @php
                  $student = Student::find($solution['student_id']);
              @endphp
              @if($solution['checked'])
                <tr class="bg-success">
                  <td>{{ $student['name'] }}</td>
                  <td>{{ $student['email'] }}</td>
                  <td>{{ $solution['uploaded_at'] }}</td>
                  <td>{{ $solution['checked_at'] ? $solution['checked_at'] : 'Nincs értékelve'  }}</td>
                  <td>{{ $solution['grade'] >= 0 ? $solution['grade'] : 'Nincs értékelve'  }}</td>
                </tr>
              @else
                <tr class="bg-primary">
                  <td>{{ $student['name'] }}</td>
                  <td>{{ $student['email'] }}</td>
                  <td>{{ $solution['uploaded_at'] }}</td>
                  <td>{{ $solution['checked_at'] ? $solution['checked_at'] : 'Nincs értékelve'  }}</td>
                  <td>
                    <form action="{{ route('solution.edit', ['solution' => $solution['id']]) }}">
                      <button class="btn btn-warning btn-lg mt-2">Értékelés</button>
                    </form>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>

    </div>


    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Opciók</h1>
      </div>

      <div class="row justify-content-center">
        <form action="{{ route('task.edit', ['task' => $task['id']]) }}">
          <button class="btn btn-success btn-lg mt-2">Feladat módosítása</button>
        </form>
      </div>
    </div>

  </div> {{-- Row --}}
</div> {{-- Container --}}

@endsection