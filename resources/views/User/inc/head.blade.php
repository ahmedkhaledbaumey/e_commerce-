<!DOCTYPE html>
<html lang="{{ __("message.lang") }}" dir="{{ __("message.dir") }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("user/vendor")}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/fontawesome.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="{{asset("user/assets")}}/css/owl.css">
    <style>
        .nav-item form button {
            color: white; /* لون النص */
        }
    </style>



  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{ route("user") }}"><h2>{{ __('message.E-COMMERCE') }}</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("user") }}">{{ __('message.Home') }}
                      <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route("mycart") }}">{{ __('message.Chart') }}</a>
                  </li>
                  @if(session()->has("lang") && session()->get("lang") == "en")


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("change" , 'ar') }}">{{ __('message.arabic') }} </a>
                      </li>

                  @else
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route("change" , 'en') }}"> {{ __('message.english') }} </a>
                        </li>

                    @endif


                @if (auth()->check())

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">{{ __('message.Dashboard') }}</a>
                </li>

            @auth
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @if(Auth::user()->role == 'admin')
                <a class="nav-link" href="{{ route('redirect') }}">{{ __('message.Admin Area') }}</a>
                @endif
            </div>
        @endauth
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">{{ __('message.Log out') }}</button>
                </form> --}}
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('message.Log out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                {{-- <li class="nav-item">
                    <form method="POST" class="nav-link" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link" type="submit" style="color: white;">
                            {{ __('message.Log out') }}
                        </button>
                    </form>
                </li> --}}
                @else
                <a class="nav-link" href="{{ route('login') }}">{{ __('message.Login') }}</a>

            @endif






            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
        <div class="text-content">
          <h4>Best Offer</h4>
          <h2>New Arrivals On Sale</h2>
        </div>
      </div>
      <div class="banner-item-02">
        <div class="text-content">
          <h4>Flash Deals</h4>
          <h2>Get your best products</h2>
        </div>
      </div>
      <div class="banner-item-03">
        <div class="text-content">
          <h4>Last Minute</h4>
          <h2>Grab last minute deals</h2>
        </div>
      </div>
    </div>
  </div>
