@extends('layouts.app')

@section('title', 'Photos')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('stylesheets')
    <style>
        #no-more-data {
            text-align: center;
            padding: 10px;
        }
    </style>

    <style>
        .mfp-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        .download-btn, .delete-btn {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            background-color: #fff;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-decoration: none;
            margin-left: 10px;
        }
        .download-btn i, .delete-btn i {
            margin-right: 8px;
        }
    </style>

    <style>
        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-bar-wrapper {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            border-radius: 13px;
            border: 1px solid #ccc;
        }

        .search-bar {
            display: flex;
            align-items: center;
            width: 500px;
            margin-right: 20px;
        }

        .search-bar input[type="text"] {
            border: none;
            outline: none;
            width: 100%;
            margin-left: 10px;
            font-size: 16px;
        }

        .search-bar i {
            font-size: 20px;
            color: #888;
        }


        .date-filter {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 5px 10px;
            border-radius: 11px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .date-filter label {
            font-size: 14px;
            color: #888;
            margin-right: 5px;
        }

        .date-filter input {
            border: none;
            outline: none;
            font-size: 14px;
            margin: 0 5px;
            width: 120px;
        }

        .search-bar-wrapper button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: 10px;
            border-radius: 10px;
            cursor: pointer;
        }

        .search-bar-wrapper button:hover {
            background-color: #45a049;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('photos.index.search') }}" method="POST">
        @csrf

        <div class="search-container">
            <div class="search-bar-wrapper">
                <div class="search-bar">
                    <i class="ion ion-search"></i>
                    <input type="text" name="search" placeholder="What we're looking for?">
                </div>
                <!-- Date Filter -->
                <div class="date-filter">
                    <label style="margin-bottom: 0!important;" for="start-date">Start:</label>
                    <input type="date" id="start-date" name="date_from">
                    <label style="margin-bottom: 0!important;" for="end-date">End:</label>
                    <input type="date" id="end-date" name="date_to">
                </div>
                <!-- Submit Button -->
                <button type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="portfolio">
        <div class="container-fluid">
            <!--=================== start ====================-->
            <div id="gallery" class="grid img-container justify-content-center no-gutters">
                <div class="grid-sizer col-sm-12 col-md-6 col-lg-3"></div>
                @include('photos.partials.photos', ['photos' => $photos])
            </div>

            <div id="no-more-data" style="display: none; margin-top: 20px"><h3>No more photos</h3></div>
            <x-loader></x-loader>
            <!--=================== end ====================-->
        </div>
    </div>
@endsection

@push('scripts')
    @if($withLazyLoad)
        <script src="{{ asset('assets/js/lazyload.js') }}"></script>
    @else
        <script>
            let $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer'
                }
            });

            $grid.imagesLoaded().progress(function() {
                $grid.isotope('layout');
            });
        </script>
    @endif
@endpush
