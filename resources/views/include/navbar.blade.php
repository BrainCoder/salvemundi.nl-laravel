{{--
<div id="TopNavbar">
    <a href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
</div>
--}}

<nav id="TopNavbar" class="navbar navbar-expand-md ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
        <img class="imgNavbar" src="{{ asset('/images/logo.svg') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i id="hamburgerMenu" class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <div class="dropdown">
                    <a href="/user" class="navLink">
                        <button class="dropbtn">Commissies &nbsp;<i class="fa fa-sort-down"></i></button>
                    </a>
                    <div class="dropdown-content">
                      <a href="/user#Ict commissie">ICT-commissie</a>
                      <a href="/user#Studie commissie">Studie-commissie</a>
                      <a href="/user#Activiteiten commissie">Activiteiten-commissie</a>
                      <a href="/user#Media commissie">Media-commissie</a>
                      <a href="/user#Feest Commissie">Feest-commissie</a>
                      <a href="/user#Kamp commissie">Kamp-commissie</a>
                      <a href="/user#Kas commissie">Kas-commissie</a>
                    </div>
                </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/intro">Intro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/inschrijven">Inschrijven</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href>Merch</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if(session('userName') != null)
                    <li class="nav-item">
                        <a class="nav-link" href="/signout">{{ __('Uitloggen') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mijnAccount">Mijn account</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/signin">{{ __('Inloggen') }}</a>
                    </li>
                @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
{{-- <img class="navImg" src="/images/headerLogoSamu.jpg"> --}}
<video class="navImg" autoplay muted loop disablePictureInPicture id="vid">
    <source src="{{asset('/images/rickroll.mp4')}}" type="video/mp4">
  Your browser does not support the video tag.
</video>
