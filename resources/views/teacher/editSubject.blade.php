@extends('layout')

@section('title', 'Tantárgy módosítása')

@section('content')
    
  <div class="container py-3 text-white">
    <h2>{{ $subject['name'] }} ({{ $subject['code'] }}) szerkesztése</h2>
    <form action="{{ route('subject.update', ['subject' => $subject['id']]) }}" method="POST">
      @csrf
      @method('put')

      <div class="form-group">
        <label for="name">Tantárgy neve</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $subject['name']) }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Leírás</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $subject['description']) }}</textarea>
        @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="code">Kód</label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code', $subject['code']) }}" placeholder="IK-SSSNNN(S:betű, N:szám)"> {{-- pattern="IK-[A-Z]{3}[0-9]{3}" --}}
        @error('code')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="credit">Kredit</label>
        <input type="number" name="credit" class="form-control @error('credit') is-invalid @enderror" id="credit" value="{{ old('credit', $subject['credit']) }}">
        @error('credit')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Módosítások végrehajtása</button>
      </div>

    </form>
  </div>

@endsection