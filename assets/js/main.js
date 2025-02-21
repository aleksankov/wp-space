gsap.registerPlugin(ScrollTrigger);

let mm = gsap.matchMedia();

function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.overflow = "scroll";
    outer.style.msOverflowStyle = "scrollbar";
    document.body.appendChild(outer);

    var inner = document.createElement("div");
    outer.appendChild(inner);

    var scrollbarWidth = outer.offsetWidth - inner.offsetWidth;

    outer.parentNode.removeChild(outer);

    return scrollbarWidth;
}

function disableScroll() {
    var $body = $('body');
    var scrollPosition = $(window).scrollTop();
    var scrollbarWidth = getScrollbarWidth();

    $('<style>')
        .prop('type', 'text/css')
        .html('.compensate-for-scrollbar { margin-right: ' + scrollbarWidth + 'px; }')
        .appendTo('head');

    $body.addClass('compensate-for-scrollbar');

    $body.css({
        'overflow': 'hidden',
        'position': 'fixed',
        'top': -scrollPosition + 'px',
        'left': '0%',
        'right': '0%'
    });

    $body.data('scroll-position', scrollPosition);
}

function enableScroll() {
    setTimeout(function(){
        if(!$('body').hasClass('fancybox-active')){
            var $body = $('body');
            var scrollPosition = $body.data('scroll-position');
    
            $('style:contains(".compensate-for-scrollbar")').remove();
            $body.removeClass('compensate-for-scrollbar');
    
            $body.css({
                'overflow': '',
                'position': '',
                'top': '',
                'left': '',
                'right': ''
            });
    
            $(window).scrollTop(scrollPosition);
        }
    }, 5)
}

function initializeInfinityLineVertical($element, $duration = 10, $reverse = false) {
    const $slides = $element.children();
    const visibleHeight = $element.parent().height();
    let totalHeight = 0;

    $slides.each(function() {
        totalHeight += $(this).outerHeight(true);
    });

    if( totalHeight ){
        const clonesNeeded = Math.ceil((visibleHeight * 2) / totalHeight);
        const $clonedSlides = $slides.clone();

        for (let i = 0; i < clonesNeeded; i++) {
            $clonedSlides.clone().appendTo($element);
        }

        const direction = $reverse ? totalHeight : -totalHeight;

        gsap.to($element, {
            y: direction,
            duration: $duration,
            ease: "none",
            repeat: -1,
        });
    }
}

function replaceImgWithSvg(selector) {
    $(selector).find('img').each(function () {
        var $img = $(this);
        var imgURL = $img.attr('src');

        $.get(imgURL, function (data) {
            var $svg = $(data).find('svg');

            $.each($img.prop('attributes'), function () {
                $svg.attr(this.name, this.value);
            });

            $img.replaceWith($svg);
        }, 'xml');
    });
}

let vacancyStick;
function vacancyInfoFix(){
    const wrap = $('.js-vacancy-info-wrap');
    const info = wrap.find('.js-vacancy-info');
    const duration = wrap.innerHeight() - info.innerHeight();
    const offset = $('.js-header').innerHeight() + 20;

    vacancyStick = ScrollTrigger.create({
        trigger: info,
        start: `top top+=${offset}`,
        end: `top+=${duration} top+=${offset}`,
        pin: true,
        pinSpacing: false,
        id: 'pin',
        invalidateOnRefresh: true
    });
}

$(window).on('load', function(){
    $('.js-infinity-line').each(function() {
        const $this = $(this);
        initializeInfinityLineVertical($this, $this.data('duration'), $this.data('revers'));
    });
})

$(document).ready(function() {

    //aos
    let refreshTimer;

    function scrollRefresh(){
        AOS.refresh();
    }

    AOS.init({
        duration: 650,
        once: true
    });

    //svg
    replaceImgWithSvg('.js-svg-replace');
    replaceImgWithSvg('.product-tech__card-row');

    //textarea counter
    $(document).on('input', '.js-textarea', function() {
        const maxLength = $(this).attr('maxlength');
        const counter = $(this).siblings('.js-textarea-counter');
        const currentLength = $(this).val().length;

        counter.text(currentLength + '/' + maxLength);
    });

    //copy btn
    $(document).on('click', '.js-copy-btn', function() {
        const textToCopy = $(this).data('text');
        let $tempInput = $('<input>');

        $('body').append($tempInput);
        $tempInput.val(textToCopy).select();
        document.execCommand('copy');
        $tempInput.remove();
    });

    //input mask
    $('.js-tel-input').inputmask({mask: "+7 (999) 999-99-99", showMaskOnHover: false});

    //form input
    $(document).on('input', '.js-form-input', function () {
        if($(this).val().trim() !== ''){
            $(this).addClass('not-empty')
        }else{
            $(this).removeClass('not-empty')
        }
    })

    //vacancy info fix
    if($('.js-vacancy-info').length){
        mm.add("(min-width: 992px)", () => {
            vacancyInfoFix();
        })
    }

    //file input
    const $fileInput = $('.js-form-file-input');
    const $fileNameWrap = $('.js-form-file-name-wrap');
    const $fileName = $('.js-form-file-name');
    const $fileRemove = $('.js-form-file-remove');
    const $formFileBlock = $('.js-form-file-block');
    const allowedFormats = ['doc', 'docx', 'pdf'];

    $fileInput.on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            $fileName.text(file.name);
            $fileNameWrap.addClass('show');
        }else{
            $fileNameWrap.removeClass('show');
        }
    });

    $formFileBlock.on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    $formFileBlock.on('dragleave', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    $formFileBlock.on('drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');

        const files = e.originalEvent.dataTransfer.files;
        
        if (files.length > 0) {
            const file = files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (allowedFormats.includes(fileExtension)) {
                $fileInput[0].files = files;
                $fileInput.trigger('change');
            } else {
                alert('Недопустимый формат файла. Разрешены только файлы форматов: doc, docx, pdf.');
            }
        }
    });

    $fileRemove.on('click', function () {
        $fileInput.val('').trigger('change');
    });

    //select
    $('.js-select').styler({
        onSelectOpened: function() {
            updateScrollbars();
        }
    });
    $(document).on('click', '.js-select-toggle', function(){
        $(this).siblings('.js-select').find('.jq-selectbox__select').trigger('click');
        return false;
    })

    $('.js-select-scroll ul').each(function(){
        $(this).addClass('main-scrollbar js-scrollbar');
    })

    //scrollbar
    var scrollbars = [];
    $('.js-scrollbar').each(function(){
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 0.2,
            wheelPropagation: false,
            suppressScrollX: false,
        });
        scrollbars.push(ps);
    });

    function updateScrollbars() {
        scrollbars.forEach(function(ps) {
            ps.update();
        });
    }

    //Const
    const body = $('body');
    const header = $('.js-header');
    const footer = $('.js-footer');
    const menuBtn = $('.js-menu-btn');
    const matrixFilter = $('.js-matrix-filter');

    //video autoplay
    if ($('.js-autoplay-video').length) {
        function playVideos() {
            $('.js-autoplay-video').each(function() {
                const videoElement = this;
                if (videoElement.paused) {
                    videoElement.play();
                }
            });
        }

        $('body').on('click touchstart', playVideos);
    }

    //scroll links
    var questionHash;
    if (window.location.hash){
        questionHash = window.location.hash;
        if($(questionHash).length){
            var offset = 0;
            $('html:not(:animated), body:not(:animated)').stop().animate({scrollTop: $(questionHash).offset().top - offset}, 0);
        }
    }

    //anchors
    $(document).on('click', '.js-anchor', function(){
        if($($(this).attr('href')).length){
            if( window.matchMedia('(min-width: 992px)').matches ){
                var offset = 20;
            }else{
                var offset = header.innerHeight() + 20;
            }
            
            $('html:not(:animated), body:not(:animated)').stop().animate({scrollTop: $($(this).attr('href')).offset().top - offset}, 600, function() {
                header.addClass('hide');
            });
            
        }
        return false;
    })

    //fancybox
    $('[data-fancybox]').fancybox({
        autoFocus: false,
        animationDuration: 450
    });

    $.fancybox.defaults.backFocus = false;

    //header scroll
    let scrollPrev = 0;
    $(window).scroll(function() {
        var scrolled = $(window).scrollTop();
     
        if ( scrolled > header.innerHeight() && scrolled > scrollPrev ) {
            header.addClass('hide');
        } else {
            header.removeClass('hide');
        }

        if ( scrolled > 1 ) {
            header.addClass('scroll');
        } else {
            header.removeClass('scroll');
        }
        scrollPrev = scrolled;
    });

    //header menu
    $(document).on('click', '.js-menu-btn', function(){
        if( $(this).hasClass('active') ){
            $(this).removeClass('active');
            $('.js-heder-menu').removeClass('active');
            $('.js-menu-item-dropdown').removeClass('active');
            matrixFilter.removeClass('active');
        }else{
            $(this).addClass('active');
            $('.js-heder-menu').addClass('active');
        }
    })

    $(document).on('click', '.js-menu-item-toggle > span', function(){
        $(this).siblings('.js-menu-item-dropdown').addClass('active');
        $('.js-heder-menu').stop().animate({scrollTop: 0}, 0);
    })
    
    $(document).on('click', '.js-menu-item-back', function(){
        $(this).closest('.js-menu-item-dropdown').removeClass('active')
    })

    $('.js-menu-item-toggle').hover(function(){
        if( window.matchMedia('(min-width: 992px)').matches ){
            body.addClass('show-bg');   
        }
    }, function(){
        if( window.matchMedia('(min-width: 992px)').matches ){
            body.removeClass('show-bg');
        }
    })

    $('.js-submenu-toggle').hover(function(){
        if( window.matchMedia('(min-width: 992px)').matches ){
            body.addClass('show-bg');   
        }
    }, function(){
        if( window.matchMedia('(min-width: 992px)').matches ){
            body.removeClass('show-bg');
        }
    })

    if( window.matchMedia('(max-width: 991px)').matches ){
        $('.js-menu-item-dropdown').each(function(){
            const height = $('.js-heder-menu > ul').innerHeight() + $('.js-heder-menu > .header__menu-bottom').innerHeight() + header.innerHeight() + 32;
            $(this).css('min-height', height);
        })
    }

    //home technologies tabs
    $(document).on('click', '.js-h-technologies-tab-btn', function(){
        if( !$(this).hasClass('active') ){
            clearTimeout(refreshTimer);

            const index = $(this).parent().parent().index();

            $('.js-h-technologies-tab-btn').removeClass('active');
            $(this).addClass('active');

            $('.js-h-technologies-tab').stop().hide().eq(index).fadeIn(300);

            refreshTimer = setTimeout(function(){
                scrollRefresh();
            }, 300);
        }
    })

    //home video tabs
    $(document).on('click', '.js-h-product-video-tab', function(){
        if( !$(this).hasClass('active') ){
            const index = $(this).index();
            const videos = $('.js-h-product-video-item').find('video');

            $(this).addClass('active').siblings().removeClass('active');

            $('.js-h-product-video-block').hide();
            $('.js-h-product-video-block').eq(index).stop().fadeIn(300);

            $('.js-h-product-video-item').removeClass('playing')
            videos.hide();
            videos.each(function(){
                this.pause();
            })
        }
    })
    $(document).on('click', '.js-h-product-video-item', function(){
        if( !$(this).hasClass('playing') ){
            const video = $(this).find('video');

            $(this).addClass('playing');

            video.stop().fadeIn(300);
            video[0].currentTime = 0;
            video[0].play();
        }
    })

    //faq dropdown
    $(document).on('click', '.js-faq-toggle', function(){
        clearTimeout(refreshTimer);

        if( !$(this).hasClass('active') ){
            $('.js-faq-toggle').removeClass('active').parent().removeClass('active');
            $(this).addClass('active').parent().addClass('active');

            $('.js-faq-dropdown').stop().slideUp(300);
            $(this).siblings('.js-faq-dropdown').stop().slideDown(300);
        }else{
            $('.js-faq-toggle').removeClass('active').parent().removeClass('active');
            $('.js-faq-dropdown').stop().slideUp(300);
        }

        refreshTimer = setTimeout(function(){
            scrollRefresh();
        }, 300);
    })

    //technologies dropdown
    $(document).on('click', '.js-h-technologies-toggle', function(){
        if( window.matchMedia('(max-width: 991px)').matches ){
            clearTimeout(refreshTimer);
            if( !$(this).hasClass('active') ){
                $('.js-h-technologies-toggle').removeClass('active').parent().removeClass('active');
                $(this).addClass('active').parent().addClass('active');

                $('.js-h-technologies-dropdown').stop().slideUp(300);
                $(this).siblings('.js-h-technologies-dropdown').stop().slideDown(300);

            }else{
                $('.js-h-technologies-toggle').removeClass('active').parent().removeClass('active');
                $('.js-h-technologies-dropdown').stop().slideUp(300);
            }

            refreshTimer = setTimeout(function(){
                scrollRefresh();
            }, 300);
        }
    })

    $(document).on('click', '.js-h-technologies-more', function(){
        const wrap = $(this).parent().siblings('.js-h-technologies-tabs');

        $(this).toggleClass('active');
        wrap.toggleClass('active');
        
        scrollRefresh();
    })

    //regions dropdown
    $(document).on('click', '.js-h-regions-toggle', function(){
        if( window.matchMedia('(max-width: 991px)').matches ){
            clearTimeout(refreshTimer);

            if( !$(this).hasClass('active') ){
                $('.js-h-regions-toggle').removeClass('active').parent().parent().removeClass('active');
                $(this).addClass('active').parent().parent().addClass('active');

                $('.js-h-regions-dropdown').stop().slideUp(300);
                $(this).siblings('.js-h-regions-dropdown').stop().slideDown(300);

            }else{
                $('.js-h-regions-toggle').removeClass('active').parent().parent().removeClass('active');
                $('.js-h-regions-dropdown').stop().slideUp(300);
            }

            refreshTimer = setTimeout(function(){
                scrollRefresh();
            }, 300);
        }
    })

    //matrix filters
    $(document).on('click', '.js-matrix-filter-open', function(){
        menuBtn.addClass('active');
        matrixFilter.addClass('active');
    })

    $(document).on('click', '.js-matrix-filter-apply', function(){
        menuBtn.removeClass('active');
        matrixFilter.removeClass('active');
    })

    $(document).on('change', 'select.js-matrix-filter-select', function(){
        const form = $(this).closest('.js-matrix-filter');

        var type = form.find('select[name="type"]').val();
        var product = form.find('select[name="product"]').val();
        var version = form.find('select[name="version"]').val();
        var vendor = form.find('select[name="vendor"]').val();

        var queryParams = [];

        if($(this).attr('name') == 'product'){
            if (product && product !== '0') {
                queryParams.push('product=' + encodeURIComponent(product));
            }
        }else if($(this).attr('name') == 'version'){
            if (product && product !== '0') {
                queryParams.push('product=' + encodeURIComponent(product));
            }
            if (version && version !== '0') {
                queryParams.push('version=' + encodeURIComponent(version));
            }
        }else{
            if (type && type !== '0') {
                queryParams.push('type=' + encodeURIComponent(type));
            }
            if (product && product !== '0') {
                queryParams.push('product=' + encodeURIComponent(product));
            }
            if (version && version !== '0') {
                queryParams.push('version=' + encodeURIComponent(version));
            }
            if (vendor && vendor !== '0') {
                queryParams.push('vendor=' + encodeURIComponent(vendor));
            }
        }

        var queryString = queryParams.join('&');
        var newUrl = window.location.pathname + (queryString ? '?' + queryString : '');

        $.ajax({
            url: newUrl,
            type: 'GET',
            beforeSend: function(){
                $('.js-matrix-wrap').addClass('loading');
            },
            success: function(response) {
                $('.js-matrix-wrap').removeClass('loading');
                $('.js-matrix-wrap').html($(response).find('.js-matrix-wrap').html());

                $('.js-select').styler({
                    onSelectOpened: function() {
                        updateScrollbars();
                    }
                });
            }
        });
    })

    //team tabs
    $(document).on('click', '.js-team-tab', function(){
        if( !$(this).hasClass('active') ){
            const index = $(this).index();

            $(this).addClass('active').siblings().removeClass('active');
            $('.js-team-block').removeClass('active').eq(index).addClass('active');
        }
    })

    //product tech tabs
    $(document).on('click', '.js-product-tech-tag', function(){
        if( !$(this).hasClass('active') ){
            const index = $(this).index();

            $(this).addClass('active').siblings().removeClass('active');
            $('.js-product-tech-variation').hide().eq(index).fadeIn(300);
        }
    })

    //about team popup
    $(document).on('click', '.js-about-team-btn', function(){
        const href = $(this).attr('href');

        $(href).addClass('active');

        return false;
    })
    $(document).on('click', '.js-about-team-btn-close', function(){
        const wrap = $(this).closest('.js-about-team-popup');

        wrap.removeClass('active');
    })

    $(document).click(function(e) {
        const wrap = $('.js-about-team-popup');
        if( !wrap.is(e.target) && wrap.has(e.target).length === 0 ){
            wrap.removeClass('active');
        }
    });

    //partners list toggle
    $(document).on('click', '.js-partners-list-toggle', function(){
        $(this).toggleClass('active');
        $(this).closest('.js-partners-list').toggleClass('active');
    })

    //news filters
    $(document).on('click', '.js-news-filter-tab', function(){
        if( !$(this).hasClass('active') ){
            $(this).addClass('active').siblings().removeClass('active');
        }
    })

    //vacancy scroll
    if($('.js-vacancy-mob-btn').length){
        $(window).on('scroll', function () {
            var topBlock = $('.js-vacancy-mob-top').offset().top + $('.js-vacancy-mob-top').innerHeight() - header.innerHeight();
            var bottomBlock = $('.js-vacancy-mob-bottom').offset().top;
            var scrollPosition = $(window).scrollTop() + $(window).height();
    
            if ($(window).scrollTop() > topBlock && scrollPosition < bottomBlock) {
                $('.js-vacancy-mob-btn').addClass('show');
            } else {
                $('.js-vacancy-mob-btn').removeClass('show');
            }
        });
    }

    //vacancies filter
    $(document).on('change', 'select.js-vacancies-city', function(){
        const value = $(this).val();

        window.location.href = value;
    })

    //sliders
    var homeProductsSlider = new Swiper('.home-products__slider', {
        speed: 600,
        slidesPerView: 3,
        spaceBetween: 32,
        breakpoints: {
            0: {
                slidesPerView: 'auto',
                spaceBetween: 24
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32
            }
        }
    });

    var homeGallerySlider = new Swiper('.home-gallery__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        loop: true,
        slideToClickedSlide: true,
        pagination: {
            el: '.home-gallery__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        }
    });

    var aboutGallerySlider = new Swiper('.about-gallery__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        loop: true,
        pagination: {
            el: '.about-gallery__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        }
    });

    var homeMediaSlider = new Swiper('.home-media__slider', {
        speed: 600,
        slidesPerView: 4,
        spaceBetween: 32,
        breakpoints: {
            0: {
                slidesPerView: 'auto',
                spaceBetween: 24
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 32
            }
        }
    });

    var homePortfolioSlider = new Swiper('.home-portfolio__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 8
    });

    var teamSlider = new Swiper('.team__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 16,
        pagination: {
            el: '.team__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        }
    });

    var capabilitiesSlider = new Swiper('.product-capabilities__slider', {
        speed: 600,
        slidesPerView: 1,
        spaceBetween: 32,
        navigation: {
            prevEl: '.product-capabilities__prev',
            nextEl: '.product-capabilities__next',
        }
    });

    var capabilitiesMobSlider = new Swiper('.product-capabilities__mob-slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 24
    });

    var overviewSlider = new Swiper('.product-overview__slider', {
        speed: 600,
        slidesPerView: 1,
        spaceBetween: 32,
        navigation: {
            prevEl: '.product-overview__prev',
            nextEl: '.product-overview__next',
        },
        pagination: {
            el: '.product-overview__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        }
    });

    overviewSlider.on('slideChange', function(){
        const index = overviewSlider.realIndex;
        const tags = $('.js-product-overview-tag');

        tags.hide().eq(index).stop().fadeIn(300);
    })

    var platformVideoSlider = new Swiper('.platform-video__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 32,
        breakpoints: {
            0: {
                spaceBetween: 24
            },
            992: {
                spaceBetween: 32
            }
        }
    });

    $(document).on('click', '.js-platform-video-tag', function(){
        if( !$(this).hasClass('active') ){
            const index = $(this).index();
            const variations = $('.js-platform-video-variation');

            $(this).addClass('active').siblings().removeClass('active');
            variations.hide().stop().eq(index).fadeIn(300);
        }
    })

    var aboutTeamSlider = new Swiper('.about-team__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 20,
        pagination: {
            el: '.about-team__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        }
    });

    var distributorsSlider = new Swiper('.partners-distributors__slider', {
        speed: 600,
        slidesPerView: 4,
        spaceBetween: 32,
        pagination: {
            el: '.partners-distributors__pagination',
            clickable: true,
            bulletActiveClass: 'active',
        },
        breakpoints: {
            0: {
                slidesPerView: 'auto',
                spaceBetween: 20
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 32
            }
        }
    });

    var partnersSlider = new Swiper('.partners-list__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 8
    });

    var learningSlider = new Swiper('.learning-info__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 24
    });

    var articleGallerySlider = new Swiper('.article-gallery__slider', {
        speed: 600,
        slidesPerView: 'auto',
        spaceBetween: 24
    });
    
    var otherArticleSlider = new Swiper('.other-articles__slider', {
        speed: 600,
        slidesPerView: 4,
        spaceBetween: 32,
        breakpoints: {
            0: {
                slidesPerView: 'auto'
            },
            992: {
                slidesPerView: 4
            }
        }
    });

    var bonusesSlider = new Swiper('.career-bonuses__slider', {
        speed: 600,
        slidesPerView: 3,
        spaceBetween: 32,
        breakpoints: {
            0: {
                slidesPerView: 'auto',
                spaceBetween: 16
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32
            }
        }
    });

    $('.swiper-button-lock').each(function(){
        const wrap = $(this).closest('.js-slider-hide-controls');

        wrap.remove();
    })
})