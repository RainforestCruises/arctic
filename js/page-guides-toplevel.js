jQuery(document).ready(function ($) {
    //TRAVEL GUIDES / DEALS -- LANDING PAGES

    // quick search regex
    var qsRegex;
    var buttonFilter;

    // init Isotope
    var resultsGrid = $('#results').isotope({
        itemSelector: '.guide-item',
        masonry: {
            columnWidth: 40,
            isFitWidth: true
            },
        filter: function () {
            var $this = $(this);
            var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
            return searchResult && buttonResult;
        }
    });


        // bind filter button click
    $('.filters-button-group').on('click', 'button', function () {
        buttonFilter = $(this).attr('data-filter');
        $('#quicksearch').val('');
        qsRegex = '';
        resultsGrid.isotope();
     

        //check count
        //console.log($('#results').isotope().filteredItems.count);

        var iso = resultsGrid.data('isotope');
        var filterCount = iso.filteredItems.length;
    

        if (filterCount > 0) {
            $('#no-results-message').hide();
        } else {
            $('#no-results-message').show();
        }

        $('.filter-button').removeClass('selected');
        $(this).addClass('selected');
    
    });




    // use value of search field to filter
    var $quicksearch = $('#quicksearch').keyup(debounce(function () {
        qsRegex = new RegExp($quicksearch.val(), 'gi');
        buttonFilter = '';

        $('.filter-button').removeClass('selected');
        $('.filter-button-all').addClass('selected');

        $('#no-results-message').hide();

        resultsGrid.isotope();
    }));

    // debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }
            function delayed() {
                fn();
                timeout = null;
            }
            setTimeout(delayed, threshold || 100);
        };
    }


 

});


