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
        <i class="flag-icon flag-icon-be mr-2" title="nl"></i> Nederlands
    </a>
    @endif

    @if($restaurant->setting->language_french)
    <a href="{{route('reservation.reservation-index',['slug' => $restaurant->slug,'locale'=>'fr'])}}" class="lang-btn">
        <i class="flag-icon flag-icon-fr mr-2" title="fr"></i> Français
    </a>
    @endif

    @if($restaurant->setting->language_english)
    <a href="{{route('reservation.reservation-index',['slug' => $restaurant->slug,'locale'=>'en'])}}" class="lang-btn">
        <i class="flag-icon flag-icon-us mr-2" title="us"></i> English
    </a>
    @endif
</div>

@endsection
