    <!-- CookieYes GCM -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("consent", "default", {
            ad_storage: "denied",
            ad_user_data: "denied",
            ad_personalization: "denied",
            analytics_storage: "denied",
            functionality_storage: "denied",
            personalization_storage: "denied",
            security_storage: "granted",
            wait_for_update: 2000,
        });
        gtag("set", "ads_data_redaction", true);
        gtag("set", "url_passthrough", true);
    </script>


<?php

// create the departure list to conform to WP departure lists
function departuresFromApi($itinerary_post){
    $automation_departure_data = get_field('automation_departure_data', $itinerary_post);
    $departure_list = [];

    foreach($automation_departure_data as $departure_item){
        // build cabin rate list
        $cabin_price_list = [];
        foreach($departure_item['rates'] as $rate){        
            $cabinPost = get_post($rate['wpRoomId']);
            $cabin_price = [
                'cabin' => $cabinPost,
                'discounted_price' => $rate['discountedPrice'],
                'price' => $rate['basePrice'],
                'sold_out' => !$rate['hasAvailability'],
            ];
            $cabin_price_list[] = $cabin_price;
        };

        // get ship post
        $shipPost = get_post($departure_item['wpShipId']);

        // add deals
        $deals_post_list = [];
        foreach($departure_item['deals'] as $deal){        
            $dealPost = get_post($deal['dealWpId']);   
            $deals_post_list[] = $dealPost;
        };

        // build final departure object
        $departure = [
            'cabin_prices' => $cabin_price_list,
            'date' => $departure_item['departureDate'],
            'deals' => $deals_post_list,
            'ship' => $shipPost,
        ];

        // return list of departures
        $departure_list[] = $departure;
    }
}
