@extends('layout')

@section('title', 'Új feladat')

@section('content')
    
  <div class="container py-3 text-white">
    <h2>Új feladat</h2>
    <form action="{{ route('subject.task.store', ['subject' => $id]) }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="name">Feladat neve</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', '') }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Leírás</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', '') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="points">Pontérték</label>
        <input type="number" name="points" class="form-control @error('points') is-invalid @enderror" id="points" value="{{ old('points', '') }}" min="0">
        @error('points')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="start_date">Elérhető</label>
        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{ old('start_date', '') }}">
        @error('start_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="end_date">Határidő</label>
        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{ old('end_date', '') }}">
        @error('end_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>


      <div class="form-group">
        <button type="submit" class="btn btn-primary">Feladat létrehozása</button>
      </div>

    </form>
  </div>

@endsection