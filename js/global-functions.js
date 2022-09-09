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
    //expand/hide (move to generic??)
    $(".outline-panel__heading").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.outline-panel__content').slideToggle(350);
        $this.parent().find('.outline-panel__heading').toggleClass('closed');
    });






});
