jQuery(document).ready(function( $ ) {
 "use strict";

    $(".post-slider").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        pagination: false,
        autoPlay: true,
        stopOnHover: true,
        items: 1,
        navigationText: ["<i class='ion-android-arrow-dropleft-circle'></i>", "<i class='ion-android-arrow-dropright-circle'></i>"]
    });
});