@extends('layouts.web')

@section('content')
    @include('web.partials.navbar')

    <div class="container py-2 py-md-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card bg-opacity-dark">
                    <div class="card-header text-white fw-bold">
                        <h1 class="text-center fs-5 my-2 text-white">Leaderboard <i class="fa-solid fa-trophy"></i></h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-fourthiary">
                            <thead>
                            <tr>
                                <th class="text-white">Rank</th>
                                <th class="text-white">Name</th>
                                <th class="text-white">Rocket Level</th>
                            </tr>
                            </thead>
                            <thead>

                            <tbody>
                            @foreach($scores as $index => $score)
                                <tr>
                                    <td class="text-white">{{ $index + 1 }}</td>
                                    <td class="text-white">{{ $score->name }}</td>
                                    <td class="text-white">{{ $score->rocket_level }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


