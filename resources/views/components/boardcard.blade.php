@props(['boardId' => null, 'owner'=>false, 'pinned' => false, 'image' => 'boards/default-banner.png', 'boardtitle' => 'Boardnaam', 'leden' => '0', 'quotes' => '0'])

<div class="boardcard">
    @if ($pinned)
        <svg class="boardcard--pinned" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill='#FEE440'>
            <path d="M8.37658 15.6162L2.71973 21.273M11.6943 6.64169L10.1334 8.20258C10.0061 8.3299 9.9424 8.39357 9.86986 8.44415C9.80548 8.48905 9.73604 8.52622 9.66297 8.55488C9.58065 8.58717 9.49236 8.60482 9.3158 8.64014L5.65133 9.37303C4.69903 9.56349 4.22288 9.65872 4.00012 9.90977C3.80605 10.1285 3.71743 10.4212 3.75758 10.7108C3.80367 11.0433 4.14703 11.3866 4.83375 12.0733L11.9195 19.1591C12.6062 19.8458 12.9496 20.1891 13.282 20.2352C13.5716 20.2754 13.8643 20.1868 14.083 19.9927C14.3341 19.7699 14.4293 19.2938 14.6198 18.3415L15.3527 14.677C15.388 14.5005 15.4056 14.4122 15.4379 14.3298C15.4666 14.2568 15.5038 14.1873 15.5487 14.123C15.5992 14.0504 15.6629 13.9868 15.7902 13.8594L17.3511 12.2985C17.4325 12.2171 17.4732 12.1764 17.518 12.1409C17.5577 12.1093 17.5998 12.0808 17.6439 12.0557C17.6935 12.0273 17.7464 12.0046 17.8522 11.9593L20.3466 10.8903C21.0743 10.5784 21.4381 10.4225 21.6034 10.1705C21.7479 9.95013 21.7996 9.68163 21.7473 9.42335C21.6874 9.12801 21.4075 8.8481 20.8477 8.28827L15.7045 3.14514C15.1447 2.58531 14.8648 2.3054 14.5695 2.24552C14.3112 2.19317 14.0427 2.24488 13.8223 2.38941C13.5703 2.55469 13.4144 2.91854 13.1025 3.64624L12.0335 6.14059C11.9882 6.24641 11.9655 6.29932 11.9372 6.34893C11.912 6.393 11.8835 6.4351 11.8519 6.47484C11.8164 6.51958 11.7757 6.56029 11.6943 6.64169Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    @endif
    <img src="{{ asset('storage/' . ($image ? $image : 'boards/default-banner.png')) }}" alt="board-image">
    <div class="boardcard__infocontainer">
        <div class="boardcard__infocontainer__container">
            <h3 class="boardcard__title">
                <span class="boardcard__title__komma">“</span>{{ $boardtitle }}<span class="boardcard__title__komma">”</span>
            </h3>
            <button onClick="toggleBoardMenu({{ $boardId }});">
                <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path id='boardmenu-svg{{ $boardId }}' d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm-6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm12 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#000"/></svg>
            </button>
            <ul id='board-menu{{ $boardId }}' class="boardcard__infocontainer__menu">
                <li class="boardcard__infocontainer__menu__item">
                    <form method="POST" action="/pin">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="boardIdInput" name="id" value="{{ $boardId }}">
                        <input type="hidden" id="isPinned" name="isPinned" value="{{ $pinned }}">

                        <button type="submit" class="boardcard__infocontainer__menu__button">
                            <svg class="boardcard__infocontainer__menu__item__svg" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="{{ $pinned ? '#FEE440' : 'none'}}">
                                <path d="M8.37658 15.6162L2.71973 21.273M11.6943 6.64169L10.1334 8.20258C10.0061 8.3299 9.9424 8.39357 9.86986 8.44415C9.80548 8.48905 9.73604 8.52622 9.66297 8.55488C9.58065 8.58717 9.49236 8.60482 9.3158 8.64014L5.65133 9.37303C4.69903 9.56349 4.22288 9.65872 4.00012 9.90977C3.80605 10.1285 3.71743 10.4212 3.75758 10.7108C3.80367 11.0433 4.14703 11.3866 4.83375 12.0733L11.9195 19.1591C12.6062 19.8458 12.9496 20.1891 13.282 20.2352C13.5716 20.2754 13.8643 20.1868 14.083 19.9927C14.3341 19.7699 14.4293 19.2938 14.6198 18.3415L15.3527 14.677C15.388 14.5005 15.4056 14.4122 15.4379 14.3298C15.4666 14.2568 15.5038 14.1873 15.5487 14.123C15.5992 14.0504 15.6629 13.9868 15.7902 13.8594L17.3511 12.2985C17.4325 12.2171 17.4732 12.1764 17.518 12.1409C17.5577 12.1093 17.5998 12.0808 17.6439 12.0557C17.6935 12.0273 17.7464 12.0046 17.8522 11.9593L20.3466 10.8903C21.0743 10.5784 21.4381 10.4225 21.6034 10.1705C21.7479 9.95013 21.7996 9.68163 21.7473 9.42335C21.6874 9.12801 21.4075 8.8481 20.8477 8.28827L15.7045 3.14514C15.1447 2.58531 14.8648 2.3054 14.5695 2.24552C14.3112 2.19317 14.0427 2.24488 13.8223 2.38941C13.5703 2.55469 13.4144 2.91854 13.1025 3.64624L12.0335 6.14059C11.9882 6.24641 11.9655 6.29932 11.9372 6.34893C11.912 6.393 11.8835 6.4351 11.8519 6.47484C11.8164 6.51958 11.7757 6.56029 11.6943 6.64169Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $pinned ? 'Unpin' : 'Pin' }}
                        </button>
                    </form>
                </li>
                <li class="boardcard__infocontainer__menu__item">
                    <a id='boardLedenButton{{ $boardId }}' href="/board={{$boardId}}/leden" data-no-swup>Leden</a>
                </li>
                @if ($owner)
                    <li class="boardcard__infocontainer__menu__item">
                        <a id='boardButton{{ $boardId }}' href="/board={{$boardId}}/bewerk" data-no-swup>Bewerk</a>
                    </li>
                @else
                    <li id='boardButton{{ $boardId }}' onClick="toggleLeaveBoard({{ $boardId }});" class="boardcard__infocontainer__menu__item boardcard__infocontainer__menu__item--delete">
                        Verlaat
                    </li>
                @endif
            </ul>
        </div>
        <div class="boardcard__infocontainer__container">
            <div class="boardcard__infocontainer__container__detail">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"/><path fill="#000" d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"/></g></svg>
                <p>{{ $leden }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                <p>{{ $quotes }}</p>
            </div>
            <a href="/board={{ $boardId }}" class="boardcard__infocontainer__container__bekijk">Bekijk</a>
        </div>
    </div>
</div>