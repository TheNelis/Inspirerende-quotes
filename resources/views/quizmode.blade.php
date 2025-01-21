<x-layout>
<div id="swup" class="maincontainer">
    <div id='quizcontainer' class="navcontainer">
        <div id="swup" class="navcontainer__flexcontainer transition-out_left">
            <a href="/" class="navcontainer__boards">
                Mijn boards
            </a>
        </div>
        <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--title transition-title">
            <div class="navcontainer__titlecontainer">
                <h1 class="navcontainer__titlecontainer__komma">“</h1>
                <h1 class="navcontainer__titlecontainer__boardtitle">Kaasfabriek</h1>
                <h1 class="navcontainer__titlecontainer__komma">”</h1>
                <h2 id="swup" class="navcontainer__titlecontainer--quiztitle navcontainer__titlecontainer--quiztitle--quizmode transition-quiztitle">Quizmode</h2>
            </div>
        </div>
        <div id="swup" class="navcontainer__flexcontainer navcontainer__flexcontainer--right transition-out_right">
            <a href="/board={{ $boardId }}" class="navcontainer__quizbuttoncontainer navcontainer__quizbuttoncontainer--quizmode">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve"><g><path fill="#000" d="M148.57,63.619H72.162C32.31,63.619,0,95.929,0,135.781v76.408c0,39.852,32.31,72.161,72.162,72.161h7.559   c6.338,0,12.275,3.128,15.87,8.362c3.579,5.234,4.365,11.898,2.074,17.811L54.568,422.208c-2.291,5.92-1.505,12.584,2.074,17.81   c3.595,5.234,9.532,8.362,15.87,8.362h50.738c7.157,0,13.73-3.981,17.041-10.318l61.257-117.03   c12.609-24.09,19.198-50.881,19.198-78.072v-107.18C220.748,95.929,188.422,63.619,148.57,63.619z"/><path fill="#000" d="M439.84,63.619h-76.41c-39.852,0-72.16,32.31-72.16,72.162v76.408c0,39.852,32.309,72.161,72.16,72.161h7.543   c6.338,0,12.291,3.128,15.87,8.362c3.596,5.234,4.365,11.898,2.091,17.811l-43.113,111.686c-2.291,5.92-1.505,12.584,2.09,17.81   c3.579,5.234,9.516,8.362,15.871,8.362h50.722c7.157,0,13.73-3.981,17.058-10.318l61.24-117.03   C505.411,296.942,512,270.152,512,242.96v-107.18C512,95.929,479.691,63.619,439.84,63.619z"/></g></svg>
                <p>Quotes</p>
            </a>
            <button onClick="document.getElementById('speluitleg').parentNode.style.display='flex'" class="navcontainer__quizbuttoncontainer navcontainer__quizbuttoncontainer--question">
                <svg height="200px" width="200px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <path class="st0" d="M396.138,85.295c-13.172-25.037-33.795-45.898-59.342-61.03C311.26,9.2,280.435,0.001,246.98,0.001 c-41.238-0.102-75.5,10.642-101.359,25.521c-25.962,14.826-37.156,32.088-37.156,32.088c-4.363,3.786-6.824,9.294-6.721,15.056 c0.118,5.77,2.775,11.186,7.273,14.784l35.933,28.78c7.324,5.864,17.806,5.644,24.875-0.518c0,0,4.414-7.978,18.247-15.88 c13.91-7.85,31.945-14.173,58.908-14.258c23.517-0.051,44.022,8.725,58.016,20.717c6.952,5.941,12.145,12.594,15.328,18.68 c3.208,6.136,4.379,11.5,4.363,15.574c-0.068,13.766-2.742,22.77-6.603,30.442c-2.945,5.729-6.789,10.813-11.738,15.744 c-7.384,7.384-17.398,14.207-28.634,20.479c-11.245,6.348-23.365,11.932-35.612,18.68c-13.978,7.74-28.77,18.858-39.701,35.544 c-5.449,8.249-9.71,17.686-12.416,27.641c-2.742,9.964-3.98,20.412-3.98,31.071c0,11.372,0,20.708,0,20.708 c0,10.719,8.69,19.41,19.41,19.41h46.762c10.719,0,19.41-8.691,19.41-19.41c0,0,0-9.336,0-20.708c0-4.107,0.467-6.755,0.917-8.436 c0.773-2.512,1.206-3.14,2.47-4.668c1.29-1.452,3.895-3.674,8.698-6.331c7.019-3.946,18.298-9.276,31.07-16.176 c19.121-10.456,42.367-24.646,61.972-48.062c9.752-11.686,18.374-25.758,24.323-41.968c6.001-16.21,9.242-34.431,9.226-53.96 C410.243,120.761,404.879,101.971,396.138,85.295z"></path> <path class="st0" d="M228.809,406.44c-29.152,0-52.788,23.644-52.788,52.788c0,29.136,23.637,52.772,52.788,52.772 c29.136,0,52.763-23.636,52.763-52.772C281.572,430.084,257.945,406.44,228.809,406.44z"></path> </g> </g></svg>
            </button>
        </div>
    </div>

    <div id="swup" class="quizcontainer transition-content">
        @if (count($quotes) > 0)
        <div class="quizcard">
            <div>
                <h3 id="quiz-quote" class="quizcard__quote">“{{ $quotes[0]->quote }}”</h3>
            </div>
            <div class="quizcard__infocontainer">
                <div class="quizcard__infocontainer__info">
                    <h4 id="quiz-name">-?????, &nbsp</h4>
                    <h4 id="quiz-namereveal">-{{ $quotes[0]->name->name }}, &nbsp</h4>
                    <h4 id="quiz-date"> {{ $quotes[0]->date }} </h4>
                </div>
            </div>
            <div class="quizcard__bottomcontainer">
                <button onclick="new JSConfetti().addConfetti();" id="confetti-button" class="quizcard__bottomcontainer__button quizcard__bottomcontainer__button--confetti">🎉MEER CONFETTI🎉</button>
                <button onclick="window.location.reload();" id='changeQuote-button' class="quizcard__bottomcontainer__button quizcard__bottomcontainer__button--changequote">
                    <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none"><path d="M20.5 15C18.9558 18.0448 15.7622 21 12 21C7.14776 21 3.58529 17.5101 3 13" stroke="#000" stroke-width="2" stroke-linecap="round"/><path d="M3.5 9C4.89106 5.64934 8.0647 3 12 3C16.7819 3 20.4232 6.48993 21 11" stroke="#000" stroke-width="2" stroke-linecap="round"/><path d="M21 21L21 15.6C21 15.2686 20.7314 15 20.4 15V15L15 15" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 9L3.6 9V9C3.26863 9 3 8.73137 3 8.4L3 3" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button onclick="revealName(); new JSConfetti().addConfetti();" id="reveal-button" class="quizcard__bottomcontainer__button">Reveal</button>
            </div>
        </div>
        @else
            Geen quotes gevonden
        @endif
    </div>

    {{-- Speluitleg --}}
    <div class="darkbackground">
        <h2 class="speluitleg__title">Speluitleg</h2>
        <div class="speluitleg" id="speluitleg">
            <p class="speluitleg__text">
                In deze quizmode krijg je telkens een quote te zien. <br/>
                Het is de bedoeling dat iedereen die meedoet opschrijft van wie ze denken dat deze quote is. <br/>
                Vervolgens kan de quote onthult worden en laat iedereen zien wat hij/zij heeft opgeschreven.
                <br/><br/>
                De beloningen of straffen bij het wel of niet goed hebben van de naam is voor eigen invulling.
                Succes!
            </p>
            <div class="speluitleg__container">
                <div onClick="document.getElementById('speluitleg').parentNode.style.display='none'">
                    <p class="speluitleg__container__button">Begrepen</p>
                    <svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1 {fill-rule: evenodd;}</style></defs>
                        <path id="checkmark" class="cls-1" d="M1224,312a12,12,0,1,1,3.32-23.526l-1.08,1.788A10,10,0,1,0,1234,300a9.818,9.818,0,0,0-.59-3.353l1.27-2.108A11.992,11.992,0,0,1,1224,312Zm0.92-8.631a0.925,0.925,0,0,1-.22.355,0.889,0.889,0,0,1-.72.259,0.913,0.913,0,0,1-.94-0.655l-3.82-3.818a0.9,0.9,0,0,1,1.27-1.271l3.25,3.251,7.39-10.974a1,1,0,0,1,1.38-.385,1.051,1.051,0,0,1,.36,1.417Z" transform="translate(-1212 -288)"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</div>
</x-layout>