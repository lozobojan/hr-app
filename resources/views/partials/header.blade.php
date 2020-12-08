<header>
    <nav class="navbar navbar-fixed navbar-expand-lg fixed-top header-top d-none d-xl-block ">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <img src="{{ asset('img/header/home.svg') }}" alt="Home">
                        <span>{{ __('Home') }}</span>
                    </a>
                </li>
                <li
                    class="nav-item sub-menu-parent {{ Route::is('about-us') || Route::is('about-project') || Route::is('about-partners') ? 'active' : '' }}">
                    <span class="nav-link">
                        <img src="{{ asset('img/header/media.svg') }}" alt="Contact">
                        <span>{{ __('A unique media platform') }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </span>
                    <ul id="sub-menu-1" class="sub-menu">
                        <li>
                            <a href="{{ route('about-us') }}">
                                {{ __('About us') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about-project') }}">
                                {{ __('About the project') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about-partners') }}">
                                {{ __('About the partners') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Route::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}" class="nav-link">
                        <img src="{{ asset('img/header/contact.svg') }}" alt="Contact">
                        <span>{{ __('Contact') }}</span>
                    </a>
                </li>
                <li class="nav-item lang">
                    @if (App::getLocale() === 'en')
                    <a class="nav-link {{ App::getLocale() == 'me' ? 'active' : '' }}"
                        href="{{ route('locale', 'me') }}">
                        <img src="{{ asset('img/header/lang.svg') }}" alt="Language">
                        <span>CG</span>
                    </a>
                    @else
                    <a class="nav-link {{ App::getLocale() == 'en' ? 'active' : '' }}"
                        href="{{ route('locale', 'en') }}">
                        <img src="{{ asset('img/header/lang.svg') }}" alt="Language">
                        <span>EN</span>
                    </a>
                    @endif
                </li>
            </ul>
            <div class="search-box">
                <form action="{{ route('search') }}" method="get" autocomplete="off">
                    @csrf
                    <label for="searchKeyword1"></label>
                    <input class="search-input" type="search" name="searchKeyword" id="searchKeyword1"
                        placeholder="{{ __("Search") }}">
                    <button type="submit" class="search-btn" aria-label="Search">
                        <img src="{{ asset('img/search-dark.svg') }}" alt="Search icon">
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-fixed navbar-expand-xl fixed-top header-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/img/header/logo.png') }}" alt="Mediji.me" />
            </a>
            <button class="navbar-toggler-btn d-xl-none" type="button" aria-label="Navbar toggler">
                <a href="#" class="menu example5" aria-label="Navbar toggler">
                    <span></span>
                </a>
            </button>
            <div id="navbarResponsive">
                <div class="search-box d-xl-none">
                    <form action="{{ route('search') }}" method="get" autocomplete="off">
                        @csrf
                        <label for="searchKeyword2"></label>
                        <input class="search-input" type="search" name="searchKeyword" id="searchKeyword2"
                            placeholder="{{ __("Search") }}">
                        <button type="submit" class="search-btn" aria-label="Search">
                            <img src="{{ asset('img/search-dark.svg') }}" alt="Search icon">
                        </button>
                    </form>
                </div>
                <div class="navbar-menu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item d-xl-none {{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}" class="nav-link">
                                <span>{{ __('Home') }}</span>
                            </a>
                        </li>
                        <li class="nav-item sub-menu-parent d-xl-none  {{ Route::is('about-us') || Route::is('about-project') ? 'active' : '' }}"
                            onclick="toggleDropdown(this, 3)">
                            <span class="nav-link">
                                <span>{{ __('A unique media platform') }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <ul id="sub-menu-3" class="sub-menu">
                                <li>
                                    <a href="{{ route('about-us') }}">
                                        {{ __('About us') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('about-project') }}">
                                        {{ __('About the project') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('about-partners') }}">
                                        {{ __('About the partners') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-xl-none {{ Route::is('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}" class="nav-link">
                                <span>{{ __('Contact') }}</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::is('news') || Route::is('news-single') ? 'active' : '' }}">
                            <a href="{{ route('news') }}" class="nav-link">{{ __('News') }}
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Route::is('fakenews') || Route::is('fakenews-single') ? 'active' : '' }}">
                            <a href="{{ route('fakenews') }}" class="nav-link">{{ __('Fake news') }}
                            </a>
                        </li>
                        <li class="nav-item sub-menu-parent {{ Route::is('ethicsinthemedia') ? 'active' : '' }}"
                            onclick="toggleDropdown(this, 2)">
                            <span class="nav-link">{{ __('Ethics in the media') }}
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <ul id="sub-menu-2" class="sub-menu">
                                @foreach ($ethicsinthemedia as $ethic)
                                <li>
                                    <a href="{{route ('ethicsinthemedia',$ethic->id) }}">
                                        {{ 
                                        (App::getLocale() === 'en') ?
                                        $ethic->title_en :
                                        $ethic->title_me
                                    }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ Route::is('mediaandminorities') || Route::is('mediaandminorities-single') ? 'active' : '' }}">
                            <a href="{{ route('mediaandminorities') }}"
                                class="nav-link">{{ __('Media and minorities') }}
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Route::is('educationalprogram') || Route::is('educationalprogram-single') ? 'active' : '' }}">
                            <a href="{{ route('educationalprogram') }}" class="nav-link">{{ __('Educational program') }}
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('video') ? 'active' : '' }}">
                            <a href="{{ route('video') }}" class="nav-link">{{ __('Video') }}
                            </a>
                        </li>
                    </ul>
                    <span class="lang d-xl-none">
                        <a class="{{ App::getLocale() == 'me' ? 'active' : '' }}" href="{{ route('locale', 'me') }}">
                            <span>CG</span>
                        </a>
                        <span class="v-line">|</span>
                        <a class="{{ App::getLocale() == 'en' ? 'active' : '' }}" href="{{ route('locale', 'en') }}">
                            <span>EN</span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>