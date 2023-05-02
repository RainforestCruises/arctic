jQuery(document).ready(function ($) {

    // Generic Close Modals------------------------------
    const closeModalButtons = [...document.querySelectorAll('.close-modal-button')];
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            if ($(button).parent().parent().parent().hasClass('modal-second-level')) {
                closeSecondModals();
            } else {
                closeModals();
            }
            
        });
    })

    const allModals = [...document.querySelectorAll('.modal')];
    window.onclick = function (event) {
        allModals.forEach(modal => {
            if (event.target == modal) {
                if(modal.classList.contains('modal-second-level')){
                    closeSecondModals();
                } else {
                    closeModals();
                }           
            }
        })
    }

    function closeModals() {
        allModals.forEach(modal => {
            modal.style.display = 'none';
        })
        body.classList.remove('no-scroll');
    };

    function closeSecondModals() {
        let allSecondModals = [...document.querySelectorAll('.modal-second-level')];
        allSecondModals.forEach(modal => {
            modal.style.display = 'none';
            modal.classList.remove('modal-second-level')
        })
    };


    //escape key close modals
    document.onkeydown = function (evt) {
        evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc");
        } else {
            isEscape = (evt.keyCode === 27);
        }
        if (isEscape) {
            closeModals();
        }
    };












    //Panels --------------------------------------------
    //expand/hide
    $(".outline-panel__heading").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.outline-panel__content').slideToggle(350);
        $this.parent().find('.outline-panel__heading').toggleClass('closed');
    });

    $(".accordion-panel__heading").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.accordion-panel__content').slideToggle(350);
        $this.parent().find('.accordion-panel__heading').toggleClass('closed');
    });




    // newsletter modal
    const newsletterModal = document.querySelector("#newsletterModal");
    const newsletterSubscribeButtons = [...document.querySelectorAll(".newsletter-subscribe-button")];

    if (newsletterSubscribeButtons) {
        newsletterSubscribeButtons.forEach(button => {
            button.addEventListener('click', () => {
                newsletterModal.style.display = 'flex';
                body.classList.add('no-scroll');
            });
        })
        
    }

    const localizationModal = document.querySelector("#localizationModal");
    const localizationOpenButtons = [...document.querySelectorAll(".localization-open-button")];
    if (localizationOpenButtons) {
        localizationOpenButtons.forEach(button => {
            button.addEventListener('click', () => {
                localizationModal.style.display = 'flex';
                body.classList.add('no-scroll');
            });
        })
    }

});
