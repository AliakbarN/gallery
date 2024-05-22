@extends('layouts.app')

@section('title', 'Photos')

@section('content')
    <div class="portfolio">
        <div class="container-fluid">
            <!--=================== start ====================-->
            <div class="grid img-container justify-content-center no-gutters">
                <div class="grid-sizer col-sm-12 col-md-6 col-lg-3"></div>

                @foreach($photos as $photo)
                    <x-photo :photo-path="$photo->path"></x-photo>
                @endforeach
            </div>
            <!--=================== end ====================-->
        </div>
    </div>
@endsection
