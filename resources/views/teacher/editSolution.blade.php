@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layout')

@section('title', 'Feladat értékelése')

@section('content')
    
  <div class="container py-3 text-white">
    
    <div class="row justify-content-start">
      <h2>Feladat értékelése</h2>
    </div>
    
    <div class="row justify-content-center">
      <div class="col">
        <details>
          <summary>Feladat szövege</summary>
          <p>{{ $task['description'] }}</p>
        </details>
      </div>
      <div class="col">
        <details>
          <summary>Megoldás szövege</summary>
          <p>{{ $solution['solution'] }}</p>
        </details>
      </div>

      @if($solution['filename'])
        <div class="col">
        <a href="{{ route('downloadFile', ['filename' => $solution['filename']]) }}" target="_blank"> Click to download file.</a>
        </div>
      @endif

    </div>

    <form action="{{ route('solution.update', ['solution' => $solution['id']]) }}" method="POST">
      @csrf
      @method('put')

      <div class="form-group">
        <label for="grade">Pontérték</label>
        <input type="number" name="grade" class="form-control @error('grade') is-invalid @enderror" id="grade" value="{{ old('grade', '') }}" min="0" max="{{ $task['points']  }}" placeholder="0<=érték<=maximumpont">
        @error('grade')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="gradetext">Értékelése</label>
        <textarea name="gradetext" class="form-control @error('gradetext') is-invalid @enderror" id="gradetext" rows="3">{{ old('gradetext', '') }}</textarea>
        @error('gradetext')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Értékel</button>
      </div>

    </form>
  </div>

@endsection