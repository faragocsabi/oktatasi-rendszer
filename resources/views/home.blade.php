@extends('layout')

@section('title', 'Kezdőlap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">

            <div class="card mt-5 bg-secondary text-white">
                <div class="card-header">
                    <h1>Adatbázis információk</h1>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-body">
                    <h2>Tanárok: {{ $teachers }}</h2>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-body">
                    <h2>Tanulók: {{ $students }}</h2>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-body">
                    <h2>Feladatok: {{ $tasks }}</h2>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-body">
                    <h2>Megoldások: {{ $solutions }}</h2>
                </div>
            </div>

        </div>

        <div class="col">

            <div class="card mt-5 bg-secondary text-white">
                <div class="card-header">
                    <h1>Leírás</h1>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-body">
                    <p>
                        <h4>Ebben az oktatási rendszerben kétféle felhasználó van: tanár és diák.</h4>

                        <h4>Tanárként a következő lehetőségünk van:</h4>
                        <ul>
                            <li>új tárgyat létrehozni</li>
                            <li>tárgy részleteit megtekinteni</li>
                            <li>tárgyat meghirdetni</li>
                            <li>tárgy meghirdetését visszavonni</li>
                            <li>tárgy törölni</li>
                            <li>tárgyon belül új feladatot kiírni</li>
                            <li>feladat részleteit megtekinteni</li>
                            <li>a feladathoz tartozó megoldásokat megtekinteni</li>
                            <li>a feladathoz tartozó megoldásokat értékelni</li>
                        </ul>

                        <h4>A diák a következő feladatokat végezheti el: </h4>

                        <ul>
                            <li>meghirdetett tárgyra feljelentkezni</li>
                            <li>meghirdetett tárgyról lejelentkezni</li>
                            <li>a tárgy részleteit megtekinteni</li>
                            <li>a tárgyhoz kapcsolódó feladatokat megtekinteni</li>
                            <li>a tárgyhoz kapcsolódó feladathoz megoldást beküldeni</li>
                            <li>az összes feladatot, tárgyanként csoportositva kilistázni</li>
                        </ul>
                    </p>
                </div>
            </div>

        </div>


    </div>
</div>
@endsection
