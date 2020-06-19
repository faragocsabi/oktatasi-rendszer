@extends('layout')

@section('title', 'Új megoldás beadása')

@section('content')
    
  <div class="container py-3 text-white">
    <h2>Új megoldás beadása</h2>

    <div class="row justify-content-start">
      <details>
        <summary>Tudnivalók</summary>
  
        <table class="table-borderless">
          <tbody>
            {{-- Task Related --}}
            @foreach($datalist as $key => $value)
              <tr>
                <td>
                  <div class="card ml-3 bg-secondary text-white">
                    <div class="card-body">
                        <h4>{{ $key }}</h4>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="card mr-3 bg-warning text-dark">
                    <div class="card-body">
                        <h4>{{ $value }}</h4>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </details>
    </div>


    <form action="{{ route('task.solution.store', ['task' => $id]) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="solution">Megoldás</label>
        <textarea name="solution" class="form-control @error('solution') is-invalid @enderror" id="solution" rows="3">{{ old('solution', '') }}</textarea>
        @error('solution')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="file">File</label>
        <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
        @error('file')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Megoldás beadása</button>
      </div>

    </form>
  </div>

@endsection