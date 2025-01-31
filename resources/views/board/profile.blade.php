
<x-layouts.app>
<div id="swup" class="maincontainer">
    <div class="navcontainer">
        <div class="navcontainer__flexcontainer"></div>
        <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--title transition-title">
            <div class="navcontainer__titlecontainer">
                <h1 class="navcontainer__titlecontainer__boardtitle">Mijn boards</h1>
            </div>
        </div>
        @auth
            <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--right transition-out_right">
                <button onClick="toggleProfileMenu()" class="navcontainer__profilecontainer">
                    <p>Welkom, {{ Auth::user()->name }}</p>
                    <svg id='dropdown-svg' xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="16" height="16" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 298.04"><path fill-rule="nonzero" d="M12.08 70.78c-16.17-16.24-16.09-42.54.15-58.7 16.25-16.17 42.54-16.09 58.71.15L256 197.76 441.06 12.23c16.17-16.24 42.46-16.32 58.71-.15 16.24 16.16 16.32 42.46.15 58.7L285.27 285.96c-16.24 16.17-42.54 16.09-58.7-.15L12.08 70.78z"/></svg>
                </button>
                <ul id='profile-menu' class="navcontainer__profilecontainer__menu">
                    <li class="navcontainer__profilecontainer__menu__item"><a href="/profile">Profiel</a></li>
                    <li class="navcontainer__profilecontainer__menu__item">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit">Uitloggen</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
        @guest
            <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--right transition-out_right">
                <a href="/login" class="navcontainer__quizbuttoncontainer">Inloggen</a>
            </div>
        @endguest
    </div>

    <div id="swup" class="transition-content">
        <section class="addboardcontainer">
            @auth
            <x-filterbutton filtertype="button" onClick="document.getElementById('addBoardForm').parentNode.style.display='flex'">Board aanmaken</x-filterbutton>
            @endauth
        </section>

        <section id='boardscontainer' class="boardscontainer">
            @auth
                @if(count($boards) > 0)
                    @foreach($boards as $board)
                        <x-boardcard boardId='{{$board->id}}' owner='{{$board->user_id === auth()->user()->id ? true : false }}' boardtitle='{{$board->title}}' image='{{$board->image}}' leden='{{$board->users_count}}' quotes='{{ $board->quotes_count }}' pinned='{{$board->pinned}}'></x-boardcard>
                    @endforeach
                @else
                    <div class="statuscontainer">
                        <h1>Geen boards gevonden</h1>
                    </div>
                @endif
            @endauth
            @guest
                <div class="statuscontainer">
                    <h1>Geen boards gevonden</h1>
                    <div class="statuscontainer__logincontainer">
                        <a href="/login" class="statuscontainer__logincontainer__button">Log in</a>
                        <p>of</p>
                        <a href="/register" class="statuscontainer__logincontainer__button">Registreer</a>
                    </div>
                </div>
            @endguest
        </section>
    </div>

    {{-- Profiel bewerken --}}
    <div class="darkbackground--visible">
        <h2 class="editprofile__title">Mijn account</h2>
        <div class="editprofile" id="editProfile">
            <div class="editprofile__topcontainer">
                <a href='/' class="editprofile__topcontainer__annuleren" data-no-swup>
                    Annuleren
                </a>
            </div>
            <div class="editprofile__container">
                @if(session('success'))
                    <ul class="success">
                        <li>{{ session('success') }}</li>
                    </ul>
                @endif
                <div class="editprofile__subcontainer">
                    <h4 class="editprofile__subcontainer__title">Naam wijzigen</h4>
                    <form method="POST" action="/account" id="changeName">
                        @method('PATCH')
                        @csrf

                        <input type="text" name='newname' value="{{ $user->name }}" class="editprofile__subcontainer__input" >
                    </form>
                    @error('newname')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <div class="editprofile__subcontainer__buttoncontainer">
                        <button type="submit" form="changeName" id='changeNameSubmit' class="editprofile__subcontainer__buttoncontainer__submit">Opslaan</button>
                    </div>
                </div>

                <div class="editprofile__subcontainer">
                    <h4 class="editprofile__subcontainer__title">Wachtwoord wijzigen</h4>
                    <form method="POST" action="/changepassword" id="changePassword">
                        @method('PATCH')
                        @csrf

                        <div>
                            <label for="password" class="editprofile__subcontainer__label">Huidige wachtwoord</label>
                            <input type="password" name="password" id="password" class="editprofile__subcontainer__input" required>
                        </div>
                        <div>
                            <label for="newpassword" class="editprofile__subcontainer__label">Nieuwe wachtwoord</label>
                            <input type="password" name="newpassword" id="newpassword" class="editprofile__subcontainer__input" required>
                        </div>
                    </form>
                    <div class="editprofile__subcontainer__buttoncontainer">
                        <button type="submit" form="changePassword" id='changePasswordSubmit' class="editprofile__subcontainer__buttoncontainer__submit">Opslaan</button>
                    </div>
                </div>

                <div class="editprofile__subcontainer">
                    <h4 class="editprofile__subcontainer__title">Account verwijderen</h4>
                    <p class="editprofile__subcontainer__warning">
                        <span>Let op:</span><br/>
                        Hierbij zullen alle boards die je gemaakt hebt verwijderd worden! <br/>
                        Jouw quotes in andere boards blijven wel bestaan.
                    </p>
                    <div class="editprofile__subcontainer__buttoncontainer">
                        <button type="button" onClick="document.getElementById('deleteAccount').parentNode.style.display='flex'; document.getElementById('editProfile').parentNode.style.display='none';" class="editprofile__subcontainer__buttoncontainer__submit editprofile__subcontainer__buttoncontainer__submit--delete">Verwijder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Account verwijderen --}}
    <div class="darkbackground">
        <form method="POST" action="/account" id="deleteAccount" class="deleteboard">
            @csrf
            @method('DELETE')

            <h2>Weet je zeker dat je je account wilt verwijderen?</h2>
            <div class="deleteboard__container">
                <button type="submit" class="deleteboard__container__button deleteboard__container__button--delete">Verwijder account</button>
                <button type="button" onClick="document.getElementById('deleteAccount').parentNode.style.display='none'; document.getElementById('editProfile').parentNode.style.display='flex';" class="deleteboard__container__button">
                    Annuleren
                </button>
            </div>
        </form>
    </div>

</div>
</x-layouts.app>