<x-layouts.app>
<div id="swup" class="maincontainer--auth">
    <a href="/" class="auth-form__terug">
        <svg fill="#000000" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="arrow-back"><rect width="24" height="24" transform="rotate(90 12 12)" opacity="0"/>
            <path d="M19 11H7.14l3.63-4.36a1 1 0 1 0-1.54-1.28l-5 6a1.19 1.19 0 0 0-.09.15c0 .05 0 .08-.07.13A1 1 0 0 0 4 12a1 1 0 0 0 .07.36c0 .05 0 .08.07.13a1.19 1.19 0 0 0 .09.15l5 6A1 1 0 0 0 10 19a1 1 0 0 0 .64-.23 1 1 0 0 0 .13-1.41L7.14 13H19a1 1 0 0 0 0-2z"/></g></g>
        </svg>
        Mijn boards
    </a>
    <div class="auth-form__container transition-authform">
        <h2 class="auth-form__title">Log in</h2>
        <form method="POST" action="/login" class="auth-form__form">
            @csrf
            <div>
                <label for="email" class="auth-form__label">E-mailadres</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" class="auth-form__input" required>
            </div>
            <div>
                <label for="password" class="auth-form__label">Wachtwoord</label>
                <input type="password" name="password" id="password" class="auth-form__input" required>
            </div>
            <div class="auth-form__buttoncontainer">
                <button type="submit" class="auth-form__buttoncontainer__submit">Inloggen</button>
                <p class="auth-form__buttoncontainer__altbutton">
                    Nog geen account? <a href="/register">Registreer</a>
                </p>
            </div>
        </form>
    </div>
    @if($errors->any())
        <ul class="errorlist">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
</x-layouts.app>