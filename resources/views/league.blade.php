@extends('layout')

@section('main')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row mt-5">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">League table</h5>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Teams</th>
                                                    <th>PTS</th>
                                                    <th>P</th>
                                                    <th>W</th>
                                                    <th>D</th>
                                                    <th>L</th>
                                                    <th>GD</th>
                                                </tr>
                                                </thead>
                                                <tbody id="teams">
                                                </tbody>
                                            </table>
                                            <button class="btn btn-default" onclick="play()">Play all</button>
                                            <button class="btn btn-default float-right" onclick="next()">Next week</button>
                                            <button class="btn btn-default float-right" onclick="previous()">Previous week</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Match result</h5>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <span class="dynamic-content week-count"></span>" Week match result
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="matches">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="2">
                                        <span class="dynamic-content week-count"></span>" Week Predictions of Championship
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="percentage">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let week = 0;
        let league = new League();

        next = () => {
            league.next(++week);
        }
        previous = () => {
            league.next(--week);
        }
        play = () => {
            league.play(week);
        }

        next();
    </script>
@endpush
