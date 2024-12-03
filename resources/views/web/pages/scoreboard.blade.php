@extends('layouts.web')

@section('content')
    @include('web.partials.navbar')

    <div class="container py-2 py-md-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Tabs for Leaderboard -->
                <ul class="nav nav-pills mb-4" id="leaderboardTabs" role="tablist">
                    <li class="nav-item " role="presentation">
                        <button class="nav-link text-white active" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid-leaderboard" type="button" role="tab" aria-controls="paid-leaderboard" aria-selected="true">
                            $GOBI Leaderboard <i class="fa-solid fa-gem"></i>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white" id="free-tab" data-bs-toggle="tab" data-bs-target="#free-leaderboard" type="button" role="tab" aria-controls="free-leaderboard" aria-selected="false">
                            Free Leaderboard <i class="fa-solid fa-trophy"></i>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="leaderboardTabsContent">
                    <!-- Paid Leaderboard -->
                    <div class="tab-pane fade show active" id="paid-leaderboard" role="tabpanel" aria-labelledby="paid-tab">
                        <div class="card bg-opacity-dark mb-4">
                            <div class="card-header text-white fw-bold d-flex align-items-center justify-content-between">
                                @if($currentSeason)
                                    <div class="text-white">
                                        Season ends:
                                        <br />
                                        <span class="fw-bold">{{ \Carbon\Carbon::parse($currentSeason->end_date)->format('F j, H:m') }}</span>
                                    </div>
                                @endif
                                <h1 class="fs-5 my-2 text-white text-center flex-grow-1">$GOBI Leaderboard <i class="fa-solid fa-gem"></i></h1>
                                @if($currentSeason)
                                    <div class="badge bg-primary p-3">
                                        <span class="d-block">Prize Pool</span>
                                        {{ number_format($currentSeason->prize_pool ?? 0, 2) }} $GOBI
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <table class="table table-fourthiary">
                                    <thead>
                                    <tr>
                                        <th class="text-white">Rank</th>
                                        <th class="text-white">Name</th>
                                        <th class="text-white">Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($paidScores as $index => $score)
                                        <tr>
                                            <td class="text-white">{{ $index + 1 }}</td>
                                            <td class="text-white">{{ $score->name }}</td>
                                            <td class="text-white">{{ $score->score }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-white">
                                                Coming soon!
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Free Leaderboard -->
                    <div class="tab-pane fade" id="free-leaderboard" role="tabpanel" aria-labelledby="free-tab">
                        <div class="card bg-opacity-dark">
                            <div class="card-header text-white fw-bold">
                                <h1 class="text-center fs-5 my-2 text-white">Free Leaderboard <i class="fa-solid fa-trophy"></i></h1>
                            </div>
                            <div class="card-body">
                                <table class="table table-fourthiary">
                                    <thead>
                                    <tr>
                                        <th class="text-white">Rank</th>
                                        <th class="text-white">Name</th>
                                        <th class="text-white">Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($freeScores as $index => $score)
                                        <tr>
                                            <td class="text-white">{{ $index + 1 }}</td>
                                            <td class="text-white">{{ $score->name }}</td>
                                            <td class="text-white">{{ $score->score }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-white">
                                                No scores available for free leaderboard.
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
