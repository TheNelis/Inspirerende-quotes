
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
        <h2 class="bewerkboard__title">Board leden</h2>
        <div class="bewerkboard">
            <div class="bewerkboard__topcontainer">
                <p>{{ count($leden) + 1 }} {{ count($leden) == 0 ? 'Lid' : 'Leden '}}</p>
                <p>{{ $currentBoard->title }}</p>
                <a href='/' class="bewerkboard__topcontainer__annuleren" data-no-swup>
                    Annuleren
                </a>
            </div>
            <ul class="bewerkboard__listcontainer">
                <li class="bewerkboard__listcontainer__item bewerkboard__listcontainer__item--owner">
                    {{ $owner->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M6 19L18 19" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path fill="#FEE440" d="M16.5585 16H7.44152C6.58066 16 5.81638 15.4491 5.54415 14.6325L3.70711 9.12132C3.44617 8.3385 4.26195 7.63098 5 8L5.71067 8.35533C6.48064 8.74032 7.41059 8.58941 8.01931 7.98069L10.5858 5.41421C11.3668 4.63317 12.6332 4.63316 13.4142 5.41421L15.9807 7.98069C16.5894 8.58941 17.5194 8.74032 18.2893 8.35533L19 8C19.7381 7.63098 20.5538 8.3385 20.2929 9.12132L18.4558 14.6325C18.1836 15.4491 17.4193 16 16.5585 16Z" stroke="#000000" stroke-width="2" stroke-linejoin="round"/></svg>
                </li>
                @foreach ($leden as $lid)
                    <li class="bewerkboard__listcontainer__item">
                        {{ $lid->user->name }}
                        @if (auth()->user()->id === $owner->id)
                            <form method="POST" action="/board={{ $currentBoard->id }}/leden">
                                @method('DELETE')
                                @csrf
                                <button>
                                    <input type="hidden" name="userId" value="{{ $lid->user->id }}">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
            @if (auth()->user()->id === $owner->id)
                <div id='inviteContainer' class="bewerkboard__container">
                    <label for="invite-link" class="bewerkboard__label">Invite link:</label>
                    <div class="bewerkboard__invite__wrapper">
                        <form method="POST" action="/board={{ $currentBoard->id }}/changeinvite" class="bewerkboard__invite__wrapper__change">
                            @method('PATCH')
                            @csrf

                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M20.5 15C18.9558 18.0448 15.7622 21 12 21C7.14776 21 3.58529 17.5101 3 13" stroke="#000" stroke-width="2" stroke-linecap="round"/><path d="M3.5 9C4.89106 5.64934 8.0647 3 12 3C16.7819 3 20.4232 6.48993 21 11" stroke="#000" stroke-width="2" stroke-linecap="round"/><path d="M21 21L21 15.6C21 15.2686 20.7314 15 20.4 15V15L15 15" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 9L3.6 9V9C3.26863 9 3 8.73137 3 8.4L3 3" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </form>
                        <input type="text" id="invite-link" name="invite" class="bewerkboard__invite" value="{{ $inviteLink }}" readonly>
                        <button type="button" id="invite-copy" onClick="copyInviteLink()" class="bewerkboard__invite__wrapper__copy">Copy link</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
</x-layouts.app>