@extends('layouts.dashboard', ['sub' => 'auction_managment'])

@section('subpage')
    <script defer src={{ asset("js/admin_dashboard_auctions.js") }}></script>

    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Auction Management</h2>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Dashboard", "href" => "/dashboard"]
            ]])
        </div>

        <div class="row">
            {{-- search section --}}
            <section class="col-12">
                {{-- search text input --}}
                <form action="{{route("admin.auction_management")}}" id="search-form" method="GET" role="search" class="row">
                    <nav class="mb-4 col-10 d-flex flex-row">
                        {{-- Search bar --}}
                        <section class="container input-group w-50">
                            <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" name="fts" value="{{ old('fts') }}">
                            <button type="submit" class="input-group-text border-0" id="search-addon" >
                                <i class="bi bi-search"></i>
                            </button>
                        </section>
                    </nav>

                    {{-- filter options --}}
                    <div class="col-md-2">
                        <select class="form-select input-sm" name="filter">
                            <option {{ old('filter') ? "" : "selected" }}>All</option>
                            <option value="report" {{ old('filter') === "report" ? "selected" : "" }}>Reported</option>
                        </select>
                    </div>
                </form>
            <section>

            {{-- @each("partials.auction_entry", $auctions, "auction") --}}
            <div class="table-responsive col-12">
                <table class="table table-hover table-striped">
                <thead>
                    <tr>
                    <th scope="col">Auction</th>
                    <th scope="col">Status</th>
                    <th scope="col">Restricted for</th>
                    <th scope="col">Schedule</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Reported user entries --}}
                    @foreach ($reports as $report)
                        <tr class="user-entry align-middle">
                            <th scope="row" class="col-md-4 col-lg-4 col-3">{{$report->title}}</th>
                            <td class="master-checkbox-reverse">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_radio_{{$report->auction_id}}" id="radio_active" 
                                    value="active" {{ $report->status === "Active" ? "checked" : ""}}>
                                    <label class="form-check-label" for="radio_active">
                                      Active
                                    </label>
                                </div>
                                <input class="form-check-input" type="radio" name="status_radio_{{$report->auction_id}}" id="radio_term" 
                                value="teminated" {{ $report->status === "Terminated" ? "checked" : ""}}>
                                    <label class="form-check-label" for="radio_term">
                                      Terminated
                                    </label>
                                <div class="form-check">
                                    
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if ($report->reason)
                                        <span>{{$report->reason}}</span>
                                        <a href="#">See details »</a>
                                    @else
                                        <span class="text-muted">No reports</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="d-flex flex-row">
                                    <h6 class="me-2 fw-bold">Starts</h6>
                                    {{\Carbon\Carbon::parse($report->start_date)->format('d M Y')}}
                                </span>
                                <span class="d-flex flex-row">
                                    <h6 class="me-3 fw-bold">Ends</h6>
                                    {{\Carbon\Carbon::parse($report->end_date)->format('d M Y')}}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>  
        </div>  

        <nav class="d-flex justify-content-center my-4">
            {!! $reports->appends(request()->except('page'))->links() !!}
        </nav>
    </div>
@endsection