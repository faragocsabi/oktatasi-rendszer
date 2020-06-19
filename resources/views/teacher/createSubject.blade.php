@extends('layout')

@section('title', 'Új tárgy felvétele')

@section('content')
    
  <div class="container py-3 text-white">
    <h2>Új tárgy</h2>
    <form action="{{ route('subject.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="name">Tantárgy neve</label>
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
        <label for="code">Kód</label>
      <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code', '') }}" placeholder="IK-SSSNNN(S:betű, N:szám)"> {{-- pattern="IK-[A-Z]{3}[0-9]{3}" --}}
        @error('code')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="credit">Kredit</label>
        <input type="number" name="credit" class="form-control @error('credit') is-invalid @enderror" id="credit" value="{{ old('credit', '') }}">
        @error('credit')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Tárgy létrehozása</button>
      </div>

    </form>
  </div>

@endsection