
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
    
        {{-- Board bewerken/leden --}}
        <div class="darkbackground--visible">
            <h2 class="bewerkboard__title">Board bewerken</h2>
            <form method="POST" action="/board={{ $currentBoard->id }}/bewerk" enctype="multipart/form-data" id="bewerkboard" class="bewerkboard">
                @method('PATCH')
                @csrf

                <div class="bewerkboard__topcontainer">
                    <p class="bewerkboard__topcontainer__delete" onClick="document.getElementById('deleteBoardForm').parentNode.style.display='flex'; document.getElementById('bewerkboard').parentNode.style.display='none';">
                        Verwijder
                    </p>
                    <p>{{ $currentBoard->title }}</p>
                    <a href='/' class="bewerkboard__topcontainer__annuleren" data-no-swup>
                        Annuleren
                    </a>
                </div>
                <div class="addboardform__inputcontainer">
                    <input type="text" name="title" placeholder="Boardnaam (max. 11)" maxlength="11" value="{{ $currentBoard->title }}" class="addboardform__boardtitle" required></input>
                    <div>
                        <label for="image" class="addboardform__label">Board afbeelding (max. 2MB)</label>
                        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" class="addboardform__image">
                    </div>
                </div>
                @if($errors->any())
                    <ul class="errorlist">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="addboardform__container">
                    <input type="submit" value="Opslaan" class="bewerkquote__container__opslaan">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 5.75C3 4.23122 4.23122 3 5.75 3H15.7145C16.5764 3 17.4031 3.34241 18.0126 3.9519L20.0481 5.98744C20.6576 6.59693 21 7.42358 21 8.28553V18.25C21 19.7688 19.7688 21 18.25 21H5.75C4.23122 21 3 19.7688 3 18.25V5.75ZM5.75 4.5C5.05964 4.5 4.5 5.05964 4.5 5.75V18.25C4.5 18.9404 5.05964 19.5 5.75 19.5H6V14.25C6 13.0074 7.00736 12 8.25 12H15.75C16.9926 12 18 13.0074 18 14.25V19.5H18.25C18.9404 19.5 19.5 18.9404 19.5 18.25V8.28553C19.5 7.8214 19.3156 7.37629 18.9874 7.0481L16.9519 5.01256C16.6918 4.75246 16.3582 4.58269 16 4.52344V7.25C16 8.49264 14.9926 9.5 13.75 9.5H9.25C8.00736 9.5 7 8.49264 7 7.25V4.5H5.75ZM16.5 19.5V14.25C16.5 13.8358 16.1642 13.5 15.75 13.5H8.25C7.83579 13.5 7.5 13.8358 7.5 14.25V19.5H16.5ZM8.5 4.5V7.25C8.5 7.66421 8.83579 8 9.25 8H13.75C14.1642 8 14.5 7.66421 14.5 7.25V4.5H8.5Z" fill="#212121"/>
                    </svg>
                </div>
            </form>
        </div>

        {{-- Board verwijderen --}}
        <div class="darkbackground">
            <form method="POST" action="/deleteboard" id="deleteBoardForm" class="deleteboard">
                @csrf
                @method('DELETE')
                <input type="hidden" id="deleteBoardId" name="id" value="{{ $currentBoard->id }}">

                <h2>Weet je zeker dat je dit board wilt verwijderen?</h2>
                <div class="deleteboard__container">
                    <button type="submit" class="deleteboard__container__button deleteboard__container__button--delete">Verwijder board</button>
                    <button type="button" onClick="document.getElementById('deleteBoardForm').parentNode.style.display='none'; document.getElementById('bewerkboard').parentNode.style.display='flex';" class="deleteboard__container__button">
                        Annuleren
                    </button>
                </div>
            </form>
        </div>
    
    </div>
</x-layouts.app>