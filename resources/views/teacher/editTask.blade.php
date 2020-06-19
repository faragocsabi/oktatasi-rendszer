@extends('layout')

@section('title', 'Feladat módosítása')

@section('content')
    
  <div class="container py-3 text-white">
    <h2>Feladat módosítása</h2>
    <form action="{{ route('task.update', ['task' => $task['id']]) }}" method="POST">
      @csrf
      @method('put')

      <div class="form-group">
        <label for="name">Feladat neve</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $task['name']) }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Leírás</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $task['description']) }}</textarea>
        @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="points">Pontérték</label>
        <input type="number" name="points" class="form-control @error('points') is-invalid @enderror" id="points" value="{{ old('points', $task['points']) }}" min="0">
        @error('points')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="start_date">Elérhető</label>
        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" value="{{ old('start_date', $task['start_date']) }}">
        @error('start_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="end_date">Határidő</label>
        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{ old('end_date', $task['end_date']) }}">
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