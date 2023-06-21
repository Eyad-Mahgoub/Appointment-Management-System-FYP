
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('frontend.home') }}">AMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'frontend.home' ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'frontend.doctors' ? 'active' : '' }}" href="{{ route('frontend.doctors') }}">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'frontend.services' ? 'active' : '' }}" href="{{ route('frontend.services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'frontend.aboutus' ? 'active' : '' }}" href="{{ route('frontend.aboutus') }}">About Us</a>
                </li>
                @if (Auth::check() && Auth::user()->role_as == UserRole::PATIENT)
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'booking.index' ? 'active' : '' }}" href="{{ route('booking.index') }}">Book Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'booking.appointments' ? 'active' : '' }}" href="{{ route('booking.appointments') }}">My Appointments</a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->role_as == UserRole::DOCTOR)
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'doctorApp.appointments' ? 'active' : '' }}" href="{{ route('doctorApp.appointments') }}">Your Appointments</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link {{ Route::currentRouteName() == 'frontend.aboutus' ? 'active' : '' }}" href="{{ route('frontend.aboutus') }}">Wiork in progree</a> --}}
                </li>
                @endif
                @if (Auth::check() && Auth::user()->role_as == UserRole::PHARMACIST)
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'pharmacy.index' ? 'active' : '' }}" href="{{ route('pharmacy.index') }}">Pharmacy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'medicine.index' ? 'active' : '' }}" href="{{ route('medicine.index') }}">Medicine</a>
                </li>
                @endif
                {{-- @if (Auth::check() && Auth::user()->role_as == UserRole::RECEPTIONIST)
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'doctorApp.appointments' ? 'active' : '' }}" href="{{ route('doctorApp.appointments') }}">Your Appointments</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link {{ Route::currentRouteName() == 'frontend.aboutus' ? 'active' : '' }}" href="{{ route('frontend.aboutus') }}">Wiork in progree</a>
                </li>
                @endif --}}

            </ul>

            @if (Auth::check())
            <button class="btn nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="">
                            Appointments
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('frontend.logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Logout
                            <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </button>
            @else
            <a class="btn btn-primary" href="{{ route('frontend.loginpage') }}">Login / Signup</a>

            @endif

        </div>
    </div>
</nav>

