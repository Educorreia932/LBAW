@extends('layouts.app')

@inject('helper', \App\Helpers\LbawUtils::class)

@section('content')
<!-- Chart.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script defer src={{ asset("js/auction.js") }}></script>

<div class="row m-2">
    <h1>Auction Details & Bids</h1>
    @include("partials.breadcrumbs", [ "pages" => [
        ["title" => "Home", "href" => route('home')],
        ["title" => "Auctions", "href" => route('search_auctions')],
        ["title" => $auction->title, "href" => route('auction', ['id' => $auction->id])],
        ["title" => "Auction Details", "href" => route('auction_details', ['id' => $auction->id])],
    ]])
</div>

<section class="container-fluid p-4">
    <div class="row">
        <span class="d-flex align-items-end">
            <h3 class="m-0 p-0">{{$auction->title}}</h3>
            <a class="ms-2" style="font-size: smaller;" href={{route('auction', ['id' => $auction->id])}}>Go back</a>
        </span>
        <hr class="my-1">

        @if (!$auction->ended)
            @include("partials.auction_detail", ["key" => "Time remaining", "value" => $auction->getTimeRemainingString(), "subgroup" => true])
        @endif
        @include("partials.auction_detail", ["key" => "Duration", "value" => $auction->getDurationString(), "subgroup" => false])
        @include("partials.auction_detail", ["key" => "Bidders", "value" => $auction->n_bidders . " different bidders", "subgroup" => true])
        @include("partials.auction_detail", ["key" => "Total Bids", "value" => $auction->n_bids . " bids", "subgroup" => false])
        @include("partials.auction_detail", ["key" => "Starting Bid", "value" => $helper->formatCurrency($auction->starting_bid) . " φ", "subgroup" => true])
        @include("partials.auction_detail", ["key" => "Mandatory Bid Increment", "value" => $auction->getIncrementString(), "subgroup" => false])
    </div>
</section>

<section class="container-fluid p-4">
    <div class="row d-flex flex-row">
        <span class="d-flex align-items-end">
            <h3 class="m-0 p-0">Bid History</h3>
        </span>
        <hr class="my-1">

        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="row col-lg-8 col-xl-6">
                    <canvas class="mt-4" id="bid-history-chart"></canvas>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="row col-lg-10 col-xl-8">
                    <table id="bid-history" class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Bid No</th>
                            <th scope="col">Bidder</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($auction->bids()->orderBy('date', 'desc')->get() as $bid)
                            @include("partials.bid_table_entry", ["bid_no" => $loop->remaining + 1, "name" => "Y**p", "bid" => $bid->value, "time" => $bid->date])
                        @endforeach

                        @include("partials.bid_table_entry", ["bid_no" => 0, "name" => "Starting Bid", "bid" => $auction->starting_bid, "time" => $auction->start_date])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
