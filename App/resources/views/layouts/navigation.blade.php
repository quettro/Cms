<nav class="navbar bg-white border-bottom">
    <div class="container-fluid">
        <div class="w-100 d-flex justify-content-between px-4">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <x-a :href="route('dashboard')" class="nav-link">
                        Панель управления
                    </x-a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>

                    <div class="dropdown-menu">
                        <x-form :action="route('logout')">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                Выйти
                            </a>
                        </x-form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
