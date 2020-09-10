@extends('front.select-language.layouts.default')

@section('content')
<div class="language-selection-box-mobile-languages-box">
    {{-- <h2>
        @if($restaurant->setting->language_dutch)
        Kies een taal
        @endif

        @if($restaurant->setting->language_french)
        / Choisissez une langue
        @endif

        @if($restaurant->setting->language_english)
        / Choose a language
        @endif
    </h2> --}}

    @if($restaurant->setting->language_dutch)
    <a href="{{ route('reservation.reservation-index',['slug' => $restaurant->slug,'locale'=>'nl']) }}"
        class="lang-btn">
        Nederlands
    </a>
    @endif

    @if($restaurant->setting->language_french)
    <a href="{{route('reservation.reservation-index',['slug' => $restaurant->slug,'locale'=>'fr'])}}" class="lang-btn">
        Français
    </a>
    @endif

    @if($restaurant->setting->language_english)
    <a href="{{route('reservation.reservation-index',['slug' => $restaurant->slug,'locale'=>'en'])}}" class="lang-btn">
        English
    </a>
    @endif
</div>

@endsection
