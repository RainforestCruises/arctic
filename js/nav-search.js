
jQuery(document).ready(function ($) {


    const formDestination = document.querySelector('#formDestination');
    const formDates = document.querySelector('#formDates');

    const navSearch = document.querySelector('.nav-search');
    const navSearchControl = document.querySelector('.nav-search-control');

    const navMain = document.querySelector('.nav-main');



    navSearch.addEventListener('click', (event) => {
        navSearch.style.display = 'none';
        navSearchControl.classList.add('active');

    });


    
    //CLICK AWAY
    document.addEventListener('click', evt => {



        const isNavSearch = navSearch.contains(evt.target);


        if (!isNavSearch) {
            navSearch.style.display = 'grid';
            navSearchControl.classList.remove('active');
        }

    });



});

