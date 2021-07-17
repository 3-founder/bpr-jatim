$(document).ready(function(){
    $('.owl-promo').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navText: ["<span class='fa fa-chevron-left'></span>","<span class='fa fa-chevron-right'></span>"],
        dots : false,
        responsive:{
            0:{
                items:3
            },
            600:{
                items:4
            },
            1000:{
                items:6
            }
        },
    }) 
    $('.owl-berita').owlCarousel({
        loop:true,
        margin:10,
        dots : true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        },
    }) 
    $(".btnTogglePromo").click(function(e) {
        e.preventDefault();
        $(".promo-on-hero").toggleClass("show")
    })
    $(".playVideo").click(function(e){
        e.preventDefault();
        $(".video-container").addClass("focus")
        $(".promo-on-hero").removeClass("show")
    })
    $(".close-focus").click(function(e){
        $(".video-container").removeClass("focus")
    })
    function cekScroll() {
        var now = $(this).scrollTop()
        var dataSrc = $(".navbar-brand img").data('src')
        if(now>0){
            $(".navbar-top").addClass("scrolled")
            $(".navbar-brand img").attr("src",dataSrc+"logo-dark.png")
        }
        else{
            $(".navbar-top").removeClass("scrolled")
            $(".navbar-brand img").attr("src",dataSrc+"logo.png")
        }
    }
    cekScroll()        
    $(document).scroll(function() {
        cekScroll()        
    })
    $(".scrollto").click(function(e){
        e.preventDefault();
        var target = $(this).data('target')
        var pos = $(target).offset()
        $("body,html").animate({scrollTop : pos.top-92},1000)
    })
})