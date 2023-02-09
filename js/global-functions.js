jQuery(document).ready(function ($) {

    // Generic Close Modals------------------------------
    const closeModalButtons = [...document.querySelectorAll('.close-modal-button')];
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            closeModals();
        });
    })

    const allModals = [...document.querySelectorAll('.modal')];
    window.onclick = function (event) {
        allModals.forEach(modal => {
            if (event.target == modal) {
                closeModals();
            }
        })
    }

    function closeModals() {
        allModals.forEach(modal => {
            modal.style.display = 'none';
        })
        body.classList.remove('no-scroll');
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
    




    const newsletterModal = document.querySelector("#newsletterModal");
    const newsletterSubscribeButton = document.querySelector("#newsletter-subscribe-button");
    if (newsletterSubscribeButton) {
        newsletterSubscribeButton.addEventListener('click', () => {
            newsletterModal.style.display = 'flex';
            body.classList.add('no-scroll');
        });
    }



});
