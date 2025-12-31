<div class="d-flex">
    <div class="bg-warning text-dark vh-100 p-3 d-flex flex-column" style="width:240px;">
       <h6 class="mb-3 fw-bold text-dark" id="locationWeather" style="font-size: 0.9rem;">
    Detecting location...
</h6>

 <hr>
        <ul class="nav nav-pills flex-column gap-2 flex-grow-1">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active bg-dark text-white' : '' }}">
                    <i class="fa-solid fa-chart-line me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index') }}"
                    class="nav-link text-dark {{ request()->routeIs('leads.index') ? 'active bg-dark text-white' : '' }}">
                    <i class="fa-solid fa-layer-group me-2"></i>Total Leads
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.create') }}"
                    class="nav-link text-dark {{ request()->routeIs('leads.create') ? 'active bg-dark text-white' : '' }}">
                    <i class="fa-solid fa-plus-circle me-2"></i>Add Lead
                </a>
            </li>

            <hr>

            <li class="nav-item">
                <a href="{{ route('leads.followup') }}"
                    class="nav-link text-primary">
                    <i class="fa-solid fa-phone-volume me-2"></i>Follow Up
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.Converted') }}"
                    class="nav-link text-success">
                    <i class="fa-solid fa-thumbs-up me-2"></i>Converted Leads
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.not_interested') }}"
                    class="nav-link text-dark">
                    <i class="fa-solid fa-circle-xmark me-2 text-danger"></i>
                    Not Interested
                </a>
            </li>
        </ul>

        <div class="mt-auto border-top pt-3">
            <a href="{{ route('profile.edit') }}" class="nav-link text-dark mb-2">
                <i class="fa-solid fa-gear me-2"></i>Settings
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link text-dark bg-transparent border-0 p-0">
                    <i class="fa-solid fa-right-from-bracket me-2 text-danger"></i>Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        {{ $slot ?? '' }}
        @yield('content')
    </div>
</div>


<script>
fetch('https://ipapi.co/json/')
    .then(res => res.json())
    .then(loc => {
        const city = loc.city;
        const country = loc.country_name;
        const lat = loc.latitude;
        const lon = loc.longitude;

        fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
            .then(res => res.json())
            .then(weather => {
                const temp = weather.current_weather.temperature;

                document.getElementById('locationWeather').innerHTML =
                    `<i class="fa-solid fa-location-dot text-danger me-1"></i>
                     ${city}, ${country}
                     <span class="ms-2 text-primary">
                        <i class="fa-solid fa-temperature-half"></i> ${temp}°C
                     </span>`;
            });
    })
    .catch(() => {
        document.getElementById('locationWeather').innerText = 'Location unavailable';
    });
</script>
