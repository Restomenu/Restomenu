<!-- header -->
<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <div class="btn-group">

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_english==1)
                    <button id="lang-btn-en"
                        class="btn btn-primary {{app()->getLocale() == 'en' ? '' : 'btn-outline'}}">English</button>
                    @endif

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
                    <button id="lang-btn-nl"
                        class="btn btn-primary {{app()->getLocale() == 'nl' ? '' : 'btn-outline'}}">Nederlands</button>
                    @endif

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_french==1)
                    <button id="lang-btn-fr"
                        class="btn btn-primary {{app()->getLocale() == 'fr' ? '' : 'btn-outline'}}">français</button>
                    @endif
                </div>
            </li>
            <li>
                <a class="dropdown-item" href="{{ env('APP_URL').'/'.auth()->guard('restaurant')->user()->slug }}"
                    target="_blank">
                    {{ __('See Live Menu') }}
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('restaurant.logout') }}"
                    onclick="event.preventDefault();          document.getElementById('logout-form4').submit();"> <i
                        class="fa fa-sign-out"></i>
                    {{ __('Log out') }}
                </a>

                <form id="logout-form4" action="{{ route('restaurant.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>

        </ul>

    </nav>
</div>
<!-- !header -->

@push('scripts')
<script>
    $("#lang-btn-en").click(function(){
        window.location="{{ route('restaurant.lang',['locale' => 'en']) }}";
    });
    $("#lang-btn-nl").click(function(){
        window.location="{{ route('restaurant.lang',['locale' => 'nl']) }}";
    });
    $("#lang-btn-fr").click(function(){
        window.location="{{ route('restaurant.lang',['locale' => 'fr']) }}";
    });
</script>
@endpush