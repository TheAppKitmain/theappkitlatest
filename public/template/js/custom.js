$(window).scroll(function() {
		var scrl = $(window).scrollTop();
		if (scrl < 1)					
		{						
		$('.preview-box').removeClass('fixedbar');
		}					
		else					
		{						
		$('.preview-box').addClass('fixedbar');
		}				
		});
         jQuery(function ($) {
         
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
		 
		 //subinner menu 
		 jQuery(function ($) {
         
             $(".sidebar-submenu-inner > a").click(function() {
           $(".sidebar-submenu-inner-box").slideUp(200);
           if (
             $(this)
               .parent()
               .hasClass("active")
           ) {
             $(".sidebar-submenu-inner").removeClass("active");
             $(this)
               .parent()
               .removeClass("active");
           } else {
             $(".sidebar-submenu-inner").removeClass("active");
             $(this)
               .next(".sidebar-submenu-inner-box")
               .slideDown(200);
             $(this)
               .parent()
               .addClass("active");
           }
         });
            
            
         });
		 
		 
// splash logo

  var loadFile = function(event) {
    var splashlog = document.getElementById('splashlog');
    splashlog.src = URL.createObjectURL(event.target.files[0]);
    splashlog.onload = function() {
      URL.revokeObjectURL(splashlog.src)
    }
  };
  
  // splash background
   var loadFile1 = function(event) {
    var splashbgimg = document.getElementById('splashbgimg');
    splashbgimg.src = URL.createObjectURL(event.target.files[0]);
    splashbgimg.onload = function() {
      URL.revokeObjectURL(splashbgimg.src)
    }
  };

  document.getElementById('vid,vid1,vid2,vid3,vid4,vid5,vid6').play();
     