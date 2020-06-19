@extends('layout')

@section('title', $task['Név'])

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="row justify-content-center">
        <h1 class="my-5 text-white">Feladat részletei</h1>
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

  </div> {{-- Row --}}
</div> {{-- Container --}}

@endsection