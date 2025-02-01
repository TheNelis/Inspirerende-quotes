<x-layouts.app>
    <div class="email__headercontainer">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('Quoted_logo.png'))) }}" alt="" class="email__headercontainer__logo">
    </div>
    <div class="email__titlecontainer">
        <h1 class="email__titlecontainer__title">Hallo, {{ $name }}</h1>
        <h1 class="email__titlecontainer__subtitle">
            Je bent je wachtwoord vergeten, kan gebeuren.<br/> 
            Maak hier een nieuw wachtwoord aan.
        </h1>
        <a href="{{ $passwordLink }}" class="email__titlecontainer__button">Nieuw wachtwoord</a>
    </div>
    <div class="email__section">
        <div>
            <h2 class="email__section__title">Opent de link niet?</h2>
            <p class="email__section__text">
                Kopieer en plak dan onderstaande regel in de adresbalk van je browser: <br/><br/>
                {{ $passwordLink }}
            </p>
        </div>
        <div>
            <h2 class="email__section__title">Geen nieuw wachtwoord aangevraagd?</h2>
            <p class="email__section__text">
                Niks aan de hand. Je wachtwoord is nog niet veranderd <br/><br/>
                Heb je vragen? Stuur een email naar nielshosdesign@gmail.com
            </p>
        </div>
    </div>

</x-layouts.app>