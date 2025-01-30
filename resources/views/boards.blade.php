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
        @if($errors->any())
            <ul class="errorlist">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if(session('success'))
            <ul class="success-message">
                <li>{{ session('success') }}</li>
            </ul>
        @endif

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

    {{-- Board aanmaken --}}
    <div class="darkbackground">
        <h2 class="addboardform__title">Board aanmaken</h2>
        <form method="POST" action="/" enctype="multipart/form-data" class="addboardform" id="addBoardForm">
            @csrf

            <h4 onClick="document.getElementById('addBoardForm').parentNode.style.display='none'; document.getElementById('addBoardForm').reset()" 
                class="addboardform__annuleren">Annuleren</h4>

            <div class="addboardform__inputcontainer">
                <input type="text" name="title" placeholder="Boardnaam (max. 11)" maxlength="11" class="addboardform__boardtitle" required></input>
                <div>
                    <label for="image" class="addboardform__label">Board afbeelding (max. 2MB)</label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" class="addboardform__image">
                </div>
            </div>
            <div class="addboardform__container">
                <input type="submit" value="Toevoegen" class="addboardform__container__toevoegen">
                <svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs>
                    <path id="checkmark" class="cls-1" d="M1224,312a12,12,0,1,1,3.32-23.526l-1.08,1.788A10,10,0,1,0,1234,300a9.818,9.818,0,0,0-.59-3.353l1.27-2.108A11.992,11.992,0,0,1,1224,312Zm0.92-8.631a0.925,0.925,0,0,1-.22.355,0.889,0.889,0,0,1-.72.259,0.913,0.913,0,0,1-.94-0.655l-3.82-3.818a0.9,0.9,0,0,1,1.27-1.271l3.25,3.251,7.39-10.974a1,1,0,0,1,1.38-.385,1.051,1.051,0,0,1,.36,1.417Z" transform="translate(-1212 -288)"/>
                </svg>
            </div>
        </form>
    </div>

    {{-- Board verlaten --}}
    <div class="darkbackground">
        <form method="POST" action="/leaveboard" id="leaveBoardForm" class="deleteboard">
            @csrf
            @method('DELETE')
            <input type="hidden" id="leaveBoardId" name="id" value="">

            <h2>Weet je zeker dat je dit board wilt verlaten?</h2>
            <div class="deleteboard__container">
                <button type="submit" class="deleteboard__container__button deleteboard__container__button--delete">Verlaat board</button>
                <button type="button" onClick="document.getElementById('leaveBoardForm').parentNode.style.display='none';" class="deleteboard__container__button">
                    Annuleren
                </button>
            </div>
        </form>
    </div>

    {{-- Board verwijderen --}}
    <div class="darkbackground">
        <form method="POST" action="/deleteboard" id="deleteBoardForm" class="deleteboard">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteBoardId" name="id" value="">

            <h2>Weet je zeker dat je dit board wilt verwijderen?</h2>
            <div class="deleteboard__container">
                <button type="submit" class="deleteboard__container__button deleteboard__container__button--delete">Verwijder board</button>
                <button type="button" onClick="document.getElementById('deleteBoardForm').parentNode.style.display='none';" class="deleteboard__container__button">
                    Annuleren
                </button>
            </div>
        </form>
    </div>

</div>
</x-layouts.app>