@extends('layout')

@section('title', 'Tárgyak')

@section('content')

  <div class="container">
    <h1 class="mt-3 bg-warning text-dark">Tárgyaim</h1>
    <div class="row">

      @php
          use Illuminate\Support\Facades\Auth;
      @endphp

      @isset($subjects)
        @foreach($subjects as $subject)

          <div class="col-sm-3 my-3">
            <div class="card h-100">
              <div class="card-body">
              <h5 class="card-title">{{ $subject['name'] }} {{ $subject['public'] === '1' ? "(publikus)" : "(rejtett)" }}</h5>
              <p class="card-text">Leírás: {{ $subject['description'] }}</p>
              <p class="card-text">Kód: {{ $subject['code'] }}</p>
              <p class="card-text">Kredit: {{ $subject['credit'] }}</p>
                <p class="card-text"><small class="text-muted">Utoljára módosítva: {{ $subject['updated_at'] }}</small></p>
                <a href="{{ route('subject.show', $subject['id']) }}" class="btn btn-primary mt-3">Megnyitás</a>
                
                <form action="{{ route('subject.togglePublic', ['id' => $subject['id']]) }}" method="post" class="d-inline">
                  @csrf
                  @method('post')
                  @if($subject['public'] === '0')
                    <button class="btn btn-success mt-3">Publikál</button>
                  @else
                    <button class="btn btn-warning mt-3">Publikálás visszavonása</button>
                  @endif
                </form>

                <a href="{{ route('subject.edit', ['subject' => $subject['id']]) }}" class="btn btn-secondary mt-3">Szerkesztés</a>

                <form action="{{ route('subject.destroy', ['subject' => $subject['id']]) }}" method="post" class="d-inline">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger mt-3">Törlés</button>
                </form>
              </div>
            </div>
          </div>

        @endforeach
      @else
          <h1 class='bg-warning mt-5'>Jelenleg nincs még ön által létrehozott tárgy!</h1>
      @endif


    </div>
  </div>

@endsection