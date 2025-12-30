<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-warning text-dark vh-100 p-3" style="width: 250px;">
        <h5 class="mb-4 fw-bold">Lead Panel</h5>

        <ul class="nav nav-pills flex-column gap-2">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active bg-dark text-white' : '' }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index') }}"
                   class="nav-link text-dark {{ request()->routeIs('leads.index') ? 'active bg-dark text-white' : '' }}">
                    Total Leads
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.create') }}"
                   class="nav-link text-dark {{ request()->routeIs('leads.create') ? 'active bg-dark text-white' : '' }}">
                    Add Lead
                </a>
            </li>

            <hr>

            <li class="nav-item">
                <a href="{{ route('leads.index', ['status' => 'Follow Up']) }}"
                   class="nav-link text-dark">
                    Follow Up
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index', ['status' => 'Closed']) }}"
                   class="nav-link text-dark">
                    Converted Leads
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('leads.index', ['status' => 'Not Interested']) }}"
                   class="nav-link text-dark">
                    Not Interested
                </a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div class="flex-grow-1 p-4">
        {{ $slot ?? '' }}
        @yield('content')
    </div>
</div>
