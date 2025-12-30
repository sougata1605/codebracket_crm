<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Codebracket</span>

    <div class="dropdown">
        <a class="text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">
            {{ auth()->user()->name }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
