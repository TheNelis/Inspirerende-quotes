<x-layout>
<div id="swup" class="maincontainer">
    <div class="navcontainer">
        <div class="navcontainer__flexcontainer"></div>
        <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--title transition-title">
            <div class="navcontainer__titlecontainer">
                <h1 class="navcontainer__titlecontainer__boardtitle">Mijn boards</h1>
            </div>
        </div>
        {{-- als ingelogd --}}
        <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--right transition-out_right">
            <div class="navcontainer__profilecontainer">
                <p>Niels Hos</p>
                <img src="https://fakeimg.pl/400x400" alt="avatar">
            </div>
        </div>
        {{-- else --}}
            {{-- <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--right transition-out_right">
                <a href="/login" class="navcontainer__quizbuttoncontainer">Inloggen</a>
            </div> --}}
        {{-- endif --}}
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
            <x-filterbutton filtertype="button" onClick="document.getElementById('addQuoteForm').parentNode.style.display='flex'">Board aanmaken</x-filterbutton>
        </section>

        <section class="boardscontainer">
            {{-- Als ingelogd --}}
                {{-- Als er boards zijn --}}
                    {{-- foreach board --}}
                        <div class="boardcard">
                            <img src="https://fakeimg.pl/400x400" alt="board-image">
                            <div class="boardcard__infocontainer">
                                <div class="boardcard__infocontainer__container">
                                    <h3 class="boardcard__title">
                                        <span class="boardcard__title__komma">“</span>Kaasfabriek<span class="boardcard__title__komma">”</span>
                                    </h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm-6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm12 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#000"/></svg>
                                </div>
                                <div class="boardcard__infocontainer__container">
                                    <div class="boardcard__infocontainer__container__detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"/><path fill="#000" d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"/></g></svg>
                                        <p>8</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                                        <p>87</p>
                                    </div>
                                    <a href="/board" class="boardcard__infocontainer__container__bekijk">Bekijk</a>
                                </div>
                            </div>
                        </div>
                        <div class="boardcard">
                            <img src="https://fakeimg.pl/400x400" alt="board-image">
                            <div class="boardcard__infocontainer">
                                <div class="boardcard__infocontainer__container">
                                    <h3 class="boardcard__title">
                                        <span class="boardcard__title__komma">“</span>Kaasfabriek<span class="boardcard__title__komma">”</span>
                                    </h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm-6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm12 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#000"/></svg>
                                </div>
                                <div class="boardcard__infocontainer__container">
                                    <div class="boardcard__infocontainer__container__detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"/><path fill="#000" d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"/></g></svg>
                                        <p>8</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                                        <p>87</p>
                                    </div>
                                    <a href="/board" class="boardcard__infocontainer__container__bekijk">Bekijk</a>
                                </div>
                            </div>
                        </div>
                        <div class="boardcard">
                            <img src="https://fakeimg.pl/400x400" alt="board-image">
                            <div class="boardcard__infocontainer">
                                <div class="boardcard__infocontainer__container">
                                    <h3 class="boardcard__title">
                                        <span class="boardcard__title__komma">“</span>Kaasfabriek<span class="boardcard__title__komma">”</span>
                                    </h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm-6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm12 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#000"/></svg>
                                </div>
                                <div class="boardcard__infocontainer__container">
                                    <div class="boardcard__infocontainer__container__detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"/><path fill="#000" d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"/></g></svg>
                                        <p>8</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                                        <p>87</p>
                                    </div>
                                    <a href="/board" class="boardcard__infocontainer__container__bekijk">Bekijk</a>
                                </div>
                            </div>
                        </div>
                        <div class="boardcard">
                            <img src="https://fakeimg.pl/400x400" alt="board-image">
                            <div class="boardcard__infocontainer">
                                <div class="boardcard__infocontainer__container">
                                    <h3 class="boardcard__title">
                                        <span class="boardcard__title__komma">“</span>Kaasfabriek<span class="boardcard__title__komma">”</span>
                                    </h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm-6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm12 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#000"/></svg>
                                </div>
                                <div class="boardcard__infocontainer__container">
                                    <div class="boardcard__infocontainer__container__detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"/><path fill="#000" d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"/></g></svg>
                                        <p>8</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                                        <p>87</p>
                                    </div>
                                    <a href="/board" class="boardcard__infocontainer__container__bekijk">Bekijk</a>
                                </div>
                            </div>
                        </div>
                    {{-- endforeach --}}
                {{-- else --}}
                    {{-- <div class="statuscontainer">
                        <h1>Geen boards gevonden</h1>
                    </div> --}}
                {{-- endif --}}

            {{-- else --}}
                {{-- <div class="statuscontainer">
                    <h1>Geen boards gevonden</h1>
                    <div class="statuscontainer__logincontainer">
                        <a href="/login" class="statuscontainer__logincontainer__button">Log in</a>
                        <p>of</p>
                        <a href="/register" class="statuscontainer__logincontainer__button">Registreer</a>
                    </div>
                </div> --}}
            {{-- endig --}}
        </section>
    </div>

    {{-- Quote toevoegen --}}
    <div class="darkbackground">
        <h2 class="addquoteform__title">Quote toevoegen</h2>
        <form method="POST" action="/board" class="addquoteform" id="addQuoteForm">
            @csrf

            <h4 onClick="document.getElementById('addQuoteForm').parentNode.style.display='none'" class="addquoteform__annuleren">Annuleren</h4>
            <textarea type="text" name="quote" placeholder="Typ hier je quote... (max. 150)" class="addquoteform__textfield" required></textarea>
            <div class="addquoteform__container">
                <div class="addquoteform__container__div">
                    <select id="addDropdown" name="name" class="addquoteform__container__dropdown" required>
                        <option value="" disabled selected>Persoon</option>
                        <option value="anders">Anders...</option>
                    </select>
                    <input type="date" name="date" class="addquoteform__container__date" required>
                    <input type="text" name="newname" placeholder="Naam (max. 12)" id="anders" class="addquoteform__container__anders">
                </div>
                <div>
                    <input type="submit" value="Toevoegen" class="addquoteform__container__toevoegen">
                    <svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs>
                        <path id="checkmark" class="cls-1" d="M1224,312a12,12,0,1,1,3.32-23.526l-1.08,1.788A10,10,0,1,0,1234,300a9.818,9.818,0,0,0-.59-3.353l1.27-2.108A11.992,11.992,0,0,1,1224,312Zm0.92-8.631a0.925,0.925,0,0,1-.22.355,0.889,0.889,0,0,1-.72.259,0.913,0.913,0,0,1-.94-0.655l-3.82-3.818a0.9,0.9,0,0,1,1.27-1.271l3.25,3.251,7.39-10.974a1,1,0,0,1,1.38-.385,1.051,1.051,0,0,1,.36,1.417Z" transform="translate(-1212 -288)"/>
                    </svg>
                </div>
            </div>
        </form>
    </div>

    {{-- Quote bewerken --}}
    <div class="darkbackground">
        <h2 class="addquoteform__title">Quote bewerken</h2>
        <form method="POST" action="/board" class="bewerkquote" id="bewerkQuote">
            @csrf
            @method('PATCH')
            <input type="hidden" id="idInput" name="id" value="">
            
            <div class="bewerkquote__topcontainer">
                <h4 onClick="document.getElementById('bekijkQuote').parentNode.style.display='flex'; document.getElementById('bewerkQuote').parentNode.style.display='none'" class="bewerkquote__topcontainer__annuleren">
                    Annuleren
                </h4>
                <input form="deleteForm" type="submit" value="Verwijder" class="bewerkquote__topcontainer__verwijder">
            </input>
            </div>
            <textarea id="bewerkquoteQuote" name="quote" class="bewerkquote__quote"></textarea>
            <div class="bewerkquote__container">
                <div class="bewerkquote__container__div">
                    <select id="editDropdown" name="name" class="bewerkquote__container__dropdown" required>
                        <option value="" disabled selected>Persoon</option>
                    </select>
                    <input type="date" id="editDate" name="date" class="bewerkquote__container__date" required>
                </div>
                <div>
                    <input type="submit" value="Opslaan" class="bewerkquote__container__opslaan">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 5.75C3 4.23122 4.23122 3 5.75 3H15.7145C16.5764 3 17.4031 3.34241 18.0126 3.9519L20.0481 5.98744C20.6576 6.59693 21 7.42358 21 8.28553V18.25C21 19.7688 19.7688 21 18.25 21H5.75C4.23122 21 3 19.7688 3 18.25V5.75ZM5.75 4.5C5.05964 4.5 4.5 5.05964 4.5 5.75V18.25C4.5 18.9404 5.05964 19.5 5.75 19.5H6V14.25C6 13.0074 7.00736 12 8.25 12H15.75C16.9926 12 18 13.0074 18 14.25V19.5H18.25C18.9404 19.5 19.5 18.9404 19.5 18.25V8.28553C19.5 7.8214 19.3156 7.37629 18.9874 7.0481L16.9519 5.01256C16.6918 4.75246 16.3582 4.58269 16 4.52344V7.25C16 8.49264 14.9926 9.5 13.75 9.5H9.25C8.00736 9.5 7 8.49264 7 7.25V4.5H5.75ZM16.5 19.5V14.25C16.5 13.8358 16.1642 13.5 15.75 13.5H8.25C7.83579 13.5 7.5 13.8358 7.5 14.25V19.5H16.5ZM8.5 4.5V7.25C8.5 7.66421 8.83579 8 9.25 8H13.75C14.1642 8 14.5 7.66421 14.5 7.25V4.5H8.5Z" fill="#212121"/>
                    </svg>
                </div>
            </div>
        </form>
        <form method="POST" action="/board" id="deleteForm">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteId" name="id" value="">
        </form>
    </div>

</div>
</x-layout>