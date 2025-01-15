<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @guest
        <li class="nav-item mt-3">
            <a class="nav-link2" href="register" id = "signup">
                Sign Up
            </a>
        </li>
    @endguest
    @auth
        <li class="nav-item
                dropdown mx-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-2"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/login">Profile</a></li>
                {{-- <li><a class="dropdown-item" href="/register">LogOut</a></li> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ 'Log Out' }}
                    </x-dropdown-link>
                </form>
            </ul>
        </li>
    @endauth
    <h1>
        HELLO WELCOME ADMIN
    </h1>
</body>
</html>