@extends('front.select-language.layouts.default')

@section('content')
<div class="language-selection-box-mobile-languages-box">
    <h2>
        @if($restaurant->setting->language_dutch)
        Kies een taal
        @endif

        @if($restaurant->setting->language_french)
        / Choisissez une langue
        @endif

        @if($restaurant->setting->language_english)
        / Choose a language
        @endif
    </h2>

    @if($restaurant->setting->language_dutch)
    <a href="{{ route('menu-nl',['slug' => $restaurant->slug]) }}">
        Nederlands
    </a>
    @endif

    @if($restaurant->setting->language_french)
    <a href="{{route('menu-fr',['slug' => $restaurant->slug])}}">
        français
    </a>
    @endif

    @if($restaurant->setting->language_english)
    <a href="{{route('menu-en',['slug' => $restaurant->slug])}}">
        English
    </a>
    @endif
</div>
@endsection