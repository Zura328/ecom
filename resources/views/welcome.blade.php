@extends('layouts.app')

@section('content')
    <style>
        .carousel-item img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        @media (max-width: 767.98px) {
            .carousel-item img {
                width: 100vw;
                height: auto;
            }
        }
    </style>

    <!-- Main Content -->
    <!-- Carousel -->
    <a href="/products?gender=&season=summer&category=&search=">
        <div id="BannerSummer" class="carousel slide mt-2" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Summer1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Summer2.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Summer3.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Summer4.png') }}" alt="First slide">
                </div>
            </div>
    </a>
    <a class="carousel-control-prev" href="#BannerSummer" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#BannerSummer" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>

    <a href="/products?gender=&season=&category=casual&search=">
        <div id="BannerCasual" class="carousel slide mt-2" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Casual1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Casual2.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Casual3.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Casual4.png') }}" alt="First slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#BannerCasual" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#BannerCasual" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </a>
    <a href="/products?gender=&season=winter&category=&search=">

        <div id="BannerWinter" class="carousel slide mt-2" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Winter1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item   ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Winter2.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Winter3.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Winter4.png') }}" alt="First slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#BannerWinter" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#BannerWinter" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </a>
    <a href="/products?gender=&season=&category=formal&search=">
        <div id="BannerFormal" class="carousel slide mt-2" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Formal1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Formal2.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Formal3.png') }}" alt="First slide">
                </div>
                <div class="carousel-item ">
                    <img class="d-block w-100" src="{{ asset('images/websiteLogo/Formal4.png') }}" alt="First slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#BannerFormal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#BannerFormal" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </a>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
