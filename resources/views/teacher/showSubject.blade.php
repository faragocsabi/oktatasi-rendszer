@extends('layout')

@section('title', $subject['Név'])

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
            {{-- Subject Related --}}
            @foreach($subject as $key => $value)
              @if($key !== 'id' && $key !== 'teacher_id')
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
            {{-- Student Related --}}
            <tr>
              <td>
                <div class="card ml-3 bg-secondary text-white">
                  <div class="card-body">
                      <h4>Hallgatók száma</h4>
                  </div>
                </div>
              </td>
              <td>
                <div class="card mr-3 bg-warning">
                  <div class="card-body">
                  <h4>                
                      @isset($students)
                          {{ count($students) }}
                      @else
                          0
                      @endisset
                  </h4>
                  </div>
              </div>
              </td>
            </tr>
            @if(count($students))
              <tr>
                <td>
                  <div class="card ml-3 bg-secondary text-white">
                    <div class="card-body">
                        <h4>Hallgatók nevei es email címei</h4>
                    </div>
                </div>
                </td>
                <td>
                  <div class="card mr-3 bg-warning">
                    <div class="card-body">
                        <p class="font-weight-bold">
                            @isset($students)
                                @foreach ($students as $student)
                                    Név: {{ $student['name'] }} <br>
                                    Email: {{ $student['email'] }} <br> . <br>
                                    <br>
                                @endforeach
                            @endisset
                        </p>
                    </div>
                </div>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

    {{-- Task Related --}}
    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Feladatok</h1>
      </div>
      <div class="row justify-content-center">
        @if($tasks)
          <table class="table bg-warning">
            <thead>
              <tr>
                <th scope="col">Név</th>
                <th scope="col">Pontszám</th>
                <th scope="col">Elérhető</th>
                <th scope="col">Határidő</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                @php
                    $mytime = Carbon\Carbon::now();
                    if($task['start_date'] < $mytime && $mytime < $task['end_date']) {
                      $style = 'bg-primary';
                    } else if($mytime > $task['end_date']) {
                      $style = 'bg-danger';
                    } else {
                      $style = 'bg-success';
                    }
                @endphp
                <tr class="{{ $style }}">
                  <td><a class="nav-item nav-link font-weight-bold text-dark" href="{{ route('task.show', ['task' => $task['id']]) }}">{{ $task['name'] }}</a></td>
                  <td>{{ $task['points'] }}</td>
                  <td>{{ $task['start_date'] }}</td>
                  <td>{{ $task['end_date'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <h1 class="my-5 bg-warning text-dark">Nincs még feladat!</h1>
        @endif
      </div>
    </div>

    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Opciók</h1>
      </div>

      <div class="row justify-content-center">
        <form action="{{ route('subject.task.create', ['subject' => $subject['id']]) }}">
          <button class="btn btn-success btn-lg mt-2">Új feladat</button>
        </form>
      </div>

      <div class="row justify-content-center">
        <form action="{{ route('subject.destroy', $subject['id']) }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-lg mt-2">Tárgy Törlése</button>
        </form>
      </div>
    </div>

  </div> {{-- First Row --}}
</div> {{-- Container --}}

@endsection