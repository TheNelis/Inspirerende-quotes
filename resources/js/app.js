import './bootstrap';

import Swup from 'swup';
const swup = new Swup({debugMode: true});

init();
swup.hooks.on('page:view', () => init());

function init() {
    new loadScripts();
}

function loadScripts() {
    // Quoteboard ---------------------------------------------------------------------------------------------

    if (document.getElementById('quotescontainer')) {
        addQuoteForm.parentNode.style.display = 'none';
        bekijkQuote.parentNode.style.display = 'none';
        bewerkQuote.parentNode.style.display = 'none';

        //Toggle addQuoteForm
        window.addEventListener('mousedown', function(event) {
            const addQuoteForm = document.getElementById('addQuoteForm');

            if(addQuoteForm.parentNode.style.display != 'none' && event.target != addQuoteForm && event.target.parentNode != addQuoteForm && event.target.parentNode.parentNode != addQuoteForm && event.target.parentNode.parentNode.parentNode != addQuoteForm){
                addQuoteForm.parentNode.style.display = 'none';
                addQuoteForm.reset();
            }
        });

        const addDropdown = document.getElementById('addDropdown');
        const anders = document.getElementById('anders');

        addDropdown.addEventListener("change", function(event) {
            if (addDropdown.value == 'anders') {
                anders.style.display = 'block';
                anders.setAttribute(required, "");
            } else {
                anders.style.display = 'none';
                anders.removeAttribute(required)
            }
        });


        // Toggle bekijkQuote
        window.addEventListener('mousedown', function(event) {
            const bekijkQuote = document.getElementById('bekijkQuote');

            if(bekijkQuote.parentNode.style.display == 'flex' && event.target != bekijkQuote && event.target.parentNode != bekijkQuote && event.target.parentNode.parentNode != bekijkQuote && event.target.parentNode.parentNode.parentNode != bekijkQuote){
                bekijkQuote.parentNode.style.display = 'none';
                document.getElementById('bewerkQuote').submit();
            }
        });

        const quoteFavourite = document.getElementById('quoteFavourite');
        const quoteQuote = document.getElementById('quoteQuote');
        const quoteName = document.getElementById('quoteName');
        const quoteDate = document.getElementById('quoteDate');

        const bewerkquoteQuote = document.getElementById('bewerkquoteQuote');
        const editDropdown = document.getElementById('editDropdown');
        const editDate = document.getElementById('editDate');

        const idInput = document.getElementById('idInput');
        const deleteId = document.getElementById('deleteId');
        const favouriteInput = document.getElementById('favouriteInput');
        const favouriteChanged = document.getElementById('favouriteChanged');
        let isFavourite;


        window.loadQuote = function(id, favourite, quote, name, date) {
            bekijkQuote.parentNode.style.display='flex';
            isFavourite = favourite;
            favouriteInput.value = isFavourite;
            idInput.value = id;
            deleteId.value = id;

            if (favourite == 1) {
                quoteFavourite.setAttribute('fill', "#FEE440");
            } else {
                quoteFavourite.setAttribute('fill', "#fff");
            }

            quoteQuote.textContent = quote;
            quoteName.textContent = "-" + name + ",  ";
            quoteDate.textContent = date;

            bewerkquoteQuote.value = quote;
            editDropdown.value = name;
            editDate.value = date;
        }

        window.toggleFavourite = function() {

            if (isFavourite == 1) {
                quoteFavourite.setAttribute('fill', "#fff");
                isFavourite = 0;
            } else {
                quoteFavourite.setAttribute('fill', "#FEE440");
                isFavourite = 1;
            }

            favouriteInput.value = isFavourite;
            favouriteChanged.value = true;
        }

        // Toggle bewerkQuote
        window.addEventListener('mousedown', function(event) {
            const bewerkQuote = document.getElementById('bewerkQuote');

            if(bewerkQuote.parentNode.style.display == 'flex' && event.target != bewerkQuote && event.target.parentNode != bewerkQuote && event.target.parentNode.parentNode != bewerkQuote && event.target.parentNode.parentNode.parentNode != bewerkQuote){
                bewerkQuote.parentNode.style.display = 'none';
                document.getElementById('bewerkQuote').submit();
            }
        });
    }



    // Quizmode ---------------------------------------------------------------------------------------------

    if (document.getElementById('quizcontainer')) {

        window.addEventListener('mousedown', function(event) {
            const speluitleg = document.getElementById('speluitleg');

            if(speluitleg.parentNode.style.display != 'none' && event.target != speluitleg && event.target.parentNode != speluitleg && event.target.parentNode.parentNode != speluitleg && event.target.parentNode.parentNode.parentNode != speluitleg){
                speluitleg.parentNode.style.display = 'none';
            }
        });

        //Quizmode logic 
        const changeQuoteButton = document.getElementById('changeQuote-button');
        const revealButton = document.getElementById('reveal-button');
        const confettiButton = document.getElementById('confetti-button');
        const name = document.getElementById('quiz-name');
        const namereveal = document.getElementById('quiz-namereveal');

        namereveal.style.display = 'none';

        window.revealName = function() {
            name.style.display = 'none';
            namereveal.style.display = 'block';

            revealButton.style.display = 'none';
            confettiButton.style.display = 'block';
            changeQuoteButton.innerHTML = 'Volgende quote';
        }
    }


    // Boards ---------------------------------------------------------------------------------------------
    if (document.getElementById('boardscontainer')) {

        let dropdownMenu = document.getElementById("profile-menu");
        let dropdownSVG = document.getElementById("dropdown-svg");
        let dropdownOpen = false;

        window.toggleProfileMenu = function() {
            dropdownOpen = !dropdownOpen;

            if (dropdownOpen == true) {
                dropdownSVG.style.transform = 'rotateZ(180deg)';
                dropdownMenu.style.height = '105px';
                dropdownMenu.style.opacity = '1';
            } else {
                dropdownSVG.style.transform = 'rotateZ(0deg)';
                dropdownMenu.style.height = '0px';
                dropdownMenu.style.opacity = '0';
            }
        }

        window.copyInviteLink = function() {

            let copied = false;
            const copyButton = document.getElementById('invite-copy');
            const inviteLink = document.getElementById('invite-link');

            if (!copied) {
                inviteLink.select();
                inviteLink.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(inviteLink.value);

                copied = !copied;
                copyButton.innerHTML = "Copied link!"
            }
        }


        addBoardForm.parentNode.style.display = 'none';
        bewerkBoard.parentNode.style.display = 'none';

        //Toggle addBoardForm
        window.addEventListener('mousedown', function(event) {
            const addBoardForm = document.getElementById('addBoardForm');

            if(addBoardForm.parentNode.style.display != 'none' && event.target != addBoardForm && event.target.parentNode != addBoardForm && event.target.parentNode.parentNode != addBoardForm && event.target.parentNode.parentNode.parentNode != addBoardForm && event.target.parentNode.parentNode.parentNode.parentNode != addBoardForm){
                addBoardForm.parentNode.style.display = 'none';
                addBoardForm.reset();
            }
        });

        // Toggle bewerkBoard
        window.addEventListener('mousedown', function(event) {
            const bewerkBoard = document.getElementById('bewerkBoard');

            if(bewerkBoard.parentNode.style.display == 'flex' && event.target != bewerkBoard && event.target.parentNode != bewerkBoard && event.target.parentNode.parentNode != bewerkBoard && event.target.parentNode.parentNode.parentNode != bewerkBoard){
                bewerkBoard.parentNode.style.display = 'none';
                document.getElementById('bewerkBoard').submit();
            }
        });
    }
}