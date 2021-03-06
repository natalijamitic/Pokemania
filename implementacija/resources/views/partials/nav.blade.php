<?php
/**
 * Navigacija
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav" aria-expended="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{route('home.index')}}" class="navbar-brand">
					Pokemania
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-nav">
				<ul class="nav navbar-nav">
					<li class="{{ Request::is('/') ? 'active' : null }}"><a href="{{route('home.index')}}">Home</a></li>
					<li class="{{ Request::segment(1) === 'pokedex' ? 'active' : (Request::segment(1) === 'pokemon' ? 'active' : null) }}"><a href="{{route('home.pokedex')}}">Pokedex</a></li>
					<li class="{{ Request::segment(1) === 'quiz' ? 'active' : null }}"><a href="{{route('home.quiz')}}">Quiz</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@auth
						<li class="{{count(Request::segments()) == 2 && Request::segment(1) === 'profile' && Request::segment(2) === Auth::user()->name ? 'active' : null }}">
							<a href="{{ route('user.show', Auth::user()->name) }}">
								<!-- Profile -->
								{{ Auth::user()->name }} 
								<i class="fas fa-user"></i>
							</a>
						</li>
						<li class="{{ strpos(Request::segment(1), 'wildBattle') !== false ? 'active' : null }}">
							<a href="{{ route('wildBattle') }}" class="alignPerfect navHover">
								<!-- Wild Fight -->
								<img src="{{ URL::to('images/pokeball.svg') }}" height="20" />
							</a>
						</li>
						<li class="{{count(Request::segments()) == 3 && Request::segment(3) === 'shop' ? 'active' : null }}">
							<a href="{{ route('user.shop', Auth::user()->name) }}">
								<!-- Shop -->
								<i class="fas fa-shopping-cart"></i>
							</a>
						</li>

						<li class="{{ strpos(Request::segment(1), 'trainerBattle') !== false  || Request::segment(1) === 'tournament' ? 'active' : null }}">
							<a href="{{ route('tournament.index') }}" class="alignPerfect navHover">
								<!-- Battle Arena -->
								<img src="{{ URL::to('images/stadium.svg') }}" height="20" />
							</a>
						</li>
						@if (Auth::user()->bAdmin)
							<li class="{{ Request::segment(1) === 'admin' ? 'active' : null }}">
								<a href="{{ route('admin') }}" class="alignPerfect navHover noFilter">
									<!-- Create Tournament -->
									<!-- <i class="fas fa-user-cog"></i> -->
									<img src="{{URL::to('images/editT.svg')}}" alt="" height="20">
								</a>
							</li>
						@endif

						<li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<!-- Sign Out -->
								<i class="fas fa-door-closed"></i>
								<!-- {{ __('Logout') }} -->
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>

						<!-- <li>
							<a href="#" role="button">
								{{ Auth::user()->name }}
							</a>
						</li> -->
						
					@endauth

					@guest
						<li class="nav-item {{ (Request::segment(1) === 'login' || Request::segment(1) === 'password')  ? 'active' : null }}">
							<a class=" nav-link" href="{{ route('login') }}">{{ __('Login') }}
							<i class="fas fa-user"></i>
							</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item {{ Request::segment(1) === 'register' ? 'active' : null }}">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}
								<i class="fas fa-user-plus"></i>
								</a>
							</li>
						@endif
					@endguest
				</ul>
			</div>
		</div>
    </nav>
    
