$('#app-showcase').owlCarousel({
    loop: true,
    margin: 30,
    smartSpeed: 2000, // duration of change of 1 slide
    nav: true,
    navigation: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 3,
            nav: true
        },
        1400: {
            items: 3,
            nav: true
        }
    }
})
$('#testimonial').owlCarousel({
    loop: true,
    margin: 30,
    smartSpeed: 2000, // duration of change of 1 slide
    nav: true,
    navigation: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 1,
            nav: false
        },
        1000: {
            items: 1,
            nav: true
        },
        1400: {
            items: 1,
            nav: true
        }
    }
});



$(document).ready(function() {
    $(".tab").click(function() {
        $(".tab").removeClass("active");
        $(".tab").addClass("active");
    });
});


// active bar
$(".ourworkul li a").click(function() {
    $(this).parent().addClass('active-workli').siblings().removeClass('active-workli');

});

$(".select-template-tabs li a").click(function() {
    $(this).parent().addClass('active-temp').siblings().removeClass('active-temp');

});

// mobile navbar
$(document).ready(function() {
    $('.open-menu').on('click', function() {
        $('.overlay').addClass('open');
    });

    $('.close-menu').on('click', function() {
        $('.overlay').removeClass('open');
    });
});



// mobile dropdown start
jQuery(function($) {

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
            .parent()
            .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });


});
// mobile dropdown end
//document.getElementById('vid,vid1,vid2,vid3,vid4,vid5,vid6').play();

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
/*if ($.browser.webkit) {
    $('input[name="password"]').attr('autocomplete', 'off');
    $('input[name="email"]').attr('autocomplete', 'off');
}*/