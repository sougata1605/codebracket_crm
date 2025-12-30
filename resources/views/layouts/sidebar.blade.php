<div class="d-flex">
    <div class="bg-warning text-dark vh-100 p-3 d-flex flex-column" style="width:250px;">
        <h5 class="mb-4 fw-bold">Admin  Panel</h5>

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
                <a href="{{ route('leads.index', ['status' => 'Follow Up']) }}"
                   class="nav-link text-dark">
                    <i class="fa-solid fa-phone-volume me-2"></i>Follow Up
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index', ['status' => 'Closed']) }}"
                   class="nav-link text-dark">
                    <i class="fa-solid fa-thumbs-up me-2"></i>Converted Leads
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index', ['status' => 'Not Interested']) }}"
                   class="nav-link text-dark">
                    <i class="fa-solid fa-circle-xmark me-2 text-danger"></i>Not Interested
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
