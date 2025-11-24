gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function () {
    SmoothScroll({
        animationTime    : 1500,
        stepSize         : 60,
        accelerationDelta : 50,
        accelerationMax   : 3,
    });

    window.addEventListener('resize', debounce(function() {
        if (typeof AOS !== 'undefined' && AOS.refresh) {
            AOS.refresh();
        }
    }, 250));

    // Очистка при уходе со страницы
    window.addEventListener('beforeunload', function() {
        ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.partner-block-filter__btn');
    const partnerCards = document.querySelectorAll('.partner-card');

    if (!filterButtons.length || !partnerCards.length) return;

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Убираем active у всех кнопок
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Добавляем active текущей
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            partnerCards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');

                if (filterValue === 'all' || cardStatus === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

// Функция debounce для оптимизации
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

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

function toggleErrorLabel(field, isError) {
    const fieldContainer = field.closest('.main-select, .main-input, .form-input');

    if (isError) {
        if (!fieldContainer.find('.error-message').length) {
            fieldContainer.append('<div class="error-message">Обязательно</div>');
        }
    } else {
        fieldContainer.find('.error-message').remove();
    }
}
function toggleErrorLabelVanilaJs(field, isError) {
    const fieldContainer = field.closest('.main-select, .main-input, .form-input');
    if (isError) {
        field.classList.add('error');
        if (!fieldContainer.querySelector('.error-message')) {
            const div = document.createElement('div');
            div.classList.add('error-message');
            div.textContent = 'Обязательно';
            fieldContainer.append(div);
        }
    } else {
        field.classList.remove('error')
        let mess = fieldContainer.querySelector('.error-message')
        if (mess){
            fieldContainer.querySelector('.error-message').remove();
        }
    }
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

    // AOS.init({
    //     offset: 0,
    //     duration: 650,
    //     once: false,
    //     mirror: true
    // });

    AOS.init({
        offset: 120,
        duration: 600,
        once: true,
        mirror: false,
        debounceDelay: 50,
        throttleDelay: 99
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
    $('.js-tel-input').inputmask({mask: "+7 (999) 999-99-99", showMaskOnHover: false}).on('change', function(e) {
        // Ваша логика здесь
    });;

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
    const maxFileSize = 3 * 1024 * 1024;

    $fileInput.on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedFormats.includes(fileExtension)) {
                alert('Недопустимый формат файла. Разрешены только файлы форматов: doc, docx, pdf.');
                $fileInput.val('');
                $fileNameWrap.removeClass('show');
                return;
            }

            if (file.size > maxFileSize) {
                alert('Размер файла превышает допустимый лимит в 3 МБ.');
                $fileInput.val('');
                $fileNameWrap.removeClass('show');
                return;
            }

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

            if (!allowedFormats.includes(fileExtension)) {
                alert('Недопустимый формат файла. Разрешены только файлы форматов: doc, docx, pdf.');
                return;
            }
    
            if (file.size > maxFileSize) {
                alert('Размер файла превышает допустимый лимит в 3 МБ.');
                return;
            }
    
            $fileInput[0].files = files;
            $fileInput.trigger('change');
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
            $('.js-matrix-filter').removeClass('active');
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

    //matrix version
    $(document).on('change', 'select.js-matrix-version', function(){
        const wrap = $(this).closest('.js-matrix-popup');
        const lists = wrap.find('.js-matrix-list');
        const index = $(this).val() - 1;

        lists.removeClass('active').eq(index).addClass('active');
    })

    //matrix filters
    $(document).on('click', '.js-matrix-filter-open', function(){
        menuBtn.addClass('active');
        $('.js-matrix-filter').addClass('active');
    })

    $(document).on('click', '.js-matrix-filter-apply', function(){
        menuBtn.removeClass('active');
        $('.js-matrix-filter').removeClass('active');
    })

    if (window.matchMedia('(min-width: 992px)').matches) {
        $(document).on('change', 'select.js-matrix-filter-select', function () {
            handleFilterChange($(this).closest('.js-matrix-filter'), $(this).attr('name'));
        });
    } else {
        $(document).on('click', '.js-matrix-filter-apply', function () {
            handleFilterChange($(this).closest('.js-matrix-filter'));
        });
    }
    
    function handleFilterChange(form, changedField = null) {
        const type = form.find('select[name="type"]').val();
        const product = form.find('select[name="product"]').val();
        const version = form.find('select[name="version"]').val();
        const vendor = form.find('select[name="vendor"]').val();
    
        const queryParams = [];
    
        if (changedField === 'product') {
            if (product && product !== '0') {
                queryParams.push('product=' + encodeURIComponent(product));
            }
        } else if (changedField === 'version') {
            if (product && product !== '0') {
                queryParams.push('product=' + encodeURIComponent(product));
            }
            if (version && version !== '0') {
                queryParams.push('version=' + encodeURIComponent(version));
            }
        } else {
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
    
        const queryString = queryParams.join('&');
        const newUrl = window.location.pathname + (queryString ? '?' + queryString : '');
    
        updateUrlAndFetchData(newUrl);
    }
    
    function updateUrlAndFetchData(url) {
        history.pushState(null, '', url);
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function () {
                $('.js-matrix-wrap').addClass('loading');
            },
            success: function (response) {
                $('.js-matrix-wrap').removeClass('loading');
                $('.js-matrix-wrap').html($(response).find('.js-matrix-wrap').html());
    
                $('.js-select').styler({
                    onSelectOpened: function () {
                        updateScrollbars();
                    }
                });
    
                $('.js-matrix-wrap .js-select-scroll ul').each(function () {
                    $(this).addClass('main-scrollbar js-scrollbar');
                });
    
                $('.js-matrix-wrap .js-scrollbar').each(function () {
                    const ps = new PerfectScrollbar(this, {
                        wheelSpeed: 0.2,
                        wheelPropagation: false,
                        suppressScrollX: false,
                    });
                    scrollbars.push(ps);
                });
            }
        });
    }

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

    var aboutClientsSlider = new Swiper('.about-clients__slider', {
        speed: 600,
        slidesPerView: 3,
        spaceBetween: 32,
        loop: true,
        lazy: true,
        autoplay: {
            delay: 2000,
            speed: 500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 24
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 16
            },
        }
    });

    var homeGallerySlider = new Swiper('.home-gallery__slider', {
        speed: 600,
        slidesPerView: 'auto',
        lazy: true,
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
    var videoGideSlider = new Swiper('.video-gide__slider', {
        speed: 600,
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            prevEl: '.video-gide__controls .video-gide__prev',
            nextEl: '.video-gide__controls .video-gide__next',
        },
        breakpoints: {
            575: {
                slidesPerView: 2,
                spaceBetween: 24
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32
            }
        }
    });

    var productSlider = new Swiper('.product-slider__slider', {
        speed: 600,
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            prevEl: '.product-slider .video-gide__prev',
            nextEl: '.product-slider .video-gide__next',
        },
        breakpoints: {
            575: {
                slidesPerView: 2,
                spaceBetween: 24
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32
            }
        }
    });

    $(document).on('click', '.js-platform-video-tag', function(){
        if( !$(this).hasClass('active') ){
            const index = $(this).index();
            const variations = $('.js-platform-video-variation');

            $(this).addClass('active').siblings().removeClass('active');
            variations.hide().eq(index).fadeIn(300);
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

    //forms
    const emailRegEx = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/;

    $(document).on('change', 'select.js-partner-select', function(){
        const select = $(this),
            form = select.closest('form'),
            to = form.find('[name="to"]')
            email = select.find('option:checked').attr('data-email');
        to.val(email);
    })
    $(document).on('change input', '.js-feedback-input:not([data-required])', function(){
        if($(this).val().trim()){
            $(this).removeClass('error');
            toggleErrorLabel($(this), false);
        }
    })

    const selects = document.querySelectorAll('.js-select-custom-field .jq-selectbox__dropdown li');
    selects.forEach((item)=>{

        item.addEventListener('click',function () {
            if(item.hasAttribute('data-email')){
                const wrapper = item.closest('.main-select');
                if (wrapper){
                    const inputmail = wrapper.querySelector('[name="custom_field[to][value]"]');
                    if (inputmail){
                        inputmail.value = item.getAttribute('data-email');
                    }
                }
            }
        })

    })

    // document.addEventListener('DOMContentLoaded', function () {
    //     const submenuItems = document.querySelectorAll('.js-submenu-toggle');
    //
    //     submenuItems.forEach(item => {
    //         const trigger = item.querySelector('span'); // клик по span
    //         const dropdown = item.querySelector('.header-submenu__dropdown');
    //
    //         trigger.addEventListener('click', function (e) {
    //             e.preventDefault();
    //
    //             // Закрываем все другие подменю
    //             document.querySelectorAll('.header-submenu__dropdown').forEach(d => {
    //                 d.classList.remove('active');
    //             });
    //
    //             // Переключаем текущее подменю
    //             dropdown.classList.toggle('active');
    //         });
    //     });
    //
    //     // Закрываем подменю при клике вне его
    //     document.addEventListener('click', function (e) {
    //         if (!e.target.closest('.js-submenu-toggle')) {
    //             document.querySelectorAll('.header-submenu__dropdown').forEach(d => {
    //                 d.classList.remove('active');
    //             });
    //         }
    //     });
    // });

    $(document).on('click', '.header-submenu-mobile .js-submenu-toggle span', function(e) {
        e.preventDefault();

        $('.header-submenu-mobile .header-submenu__dropdown').removeClass('active');

        $(this).closest('.js-submenu-toggle').find('.header-submenu__dropdown').addClass('active');
    });

    $(document).on('click', function(e) {
        // Проверяем, клик был **вне** .js-submenu-toggle
        if (!$(e.target).closest('.js-submenu-toggle').length) {
            $('.header-submenu-mobile .header-submenu__dropdown').removeClass('active');
        }
    });

    $(document).on('submit', '.js-form', function(e){
        e.preventDefault();

        const form = $(this),
            product = form.find('select[name="product"]'),
            partner = form.find('select[name="partner"]'),
            name = form.find('[name="name"]'),
            phone = form.find('[name="phone"]'),
            email = form.find('[name="email"]'),
            specialization = form.find('[name="specialization"]'),
            fileInput = form.find('[name="file"]'),
            agree = form.find('[name="agree"]');

        if(product.length && product.val() == '0'){
            product.addClass('error');
            toggleErrorLabel(product, true);
        }
        
        if(partner.length && partner.val() == '0'){
            partner.addClass('error');
            toggleErrorLabel(partner, true);
        }

        if(name.length && !name.val().trim()){
            name.addClass('error');
            toggleErrorLabel(name, true);
        }

        if(phone.length && !phone.inputmask('isComplete')){
            phone.addClass('error');
            toggleErrorLabel(phone, true);
        }
        
        if(email.length && !emailRegEx.test(email.val())){
            email.addClass('error');
            toggleErrorLabel(email, true);
        }

        if(specialization.length && !specialization.val().trim()){
            specialization.addClass('error');
            toggleErrorLabel(specialization, true);
        }

        if(agree.length && !agree.is(':checked')){
            agree.addClass('error');
        }

        if(!form.find('.js-feedback-input.error').length){
            let formData = new FormData(form[0]);

            formData.append('url', window.location.href);
            formData.append('action', 'feedback_form');

            if(fileInput.length && fileInput[0].files.length > 0){
                formData.append('file', fileInput[0].files[0]);
            }

            $.ajax({
                url: space_obj.ajax_url,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    form.addClass('loading');
                },
                success: function(response){
                    form.removeClass('loading');
                    // form.addClass('disabled');
                    form.trigger('reset');
                    form.find('.js-feedback-input').removeClass('not-empty');
                    form.find('select.js-feedback-input').trigger('change');

                    if( fileInput.length ){
                        fileInput.trigger('change');
                    }

                    $.fancybox.close();

                    if(response.status){
                        $.fancybox.open({
                            src  : '#feedback-success',
                            type : 'inline',
                            opts : {
                                touch: false,
                                keyboard: false,
                                afterClose: function(){
                                    $('style:contains(".compensate-for-scrollbar")').remove();
                                }
                            }
                        });
                    }else{
                        $.fancybox.open({
                            src  : '#feedback-error',
                            type : 'inline',
                            opts : {
                                touch: false,
                                keyboard: false,
                                afterClose: function(){
                                    $('style:contains(".compensate-for-scrollbar")').remove();
                                }
                            }
                        });
                    }
                }
            });
        }
    })



    const inputsRequired =document.querySelectorAll('[data-required]');
    inputsRequired.forEach((field)=>{
        field.addEventListener('change',(e)=>{
            toggleErrorLabelVanilaJs(field, false);
        })
    })


    const formInputsValidate= document.querySelectorAll('[data-validate]');


    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                let classOpened=null;
                if (mutation.target.classList.contains('opened')){
                    classOpened=true;
                }else{
                    classOpened=false;
                }
                if (classOpened===false){
                    const select = mutation.target.querySelector('select')
                    if (select.value==='0'){
                        select.classList.add('error');
                        toggleErrorLabelVanilaJs(select, true);
                    }
                    classOpened=null;
                }
            }
        });
    });


    formInputsValidate.forEach((input)=>{

        switch (input.dataset.validate){
            case 'select':
                observer.observe(input.closest('.jqselect'), {
                    attributes: true, // наблюдать за атрибутами
                    attributeFilter: ['class'] // наблюдать только за атрибутом class
                });

                break;
            case 'empty':
                input.addEventListener('blur',function (e){
                    switch (input.type){
                        case 'text':
                            if (input.value.trim()===''){
                                input.classList.add('error');
                                toggleErrorLabelVanilaJs(input, true);
                            }

                            break;
                        case 'email':
                            if (input.value.trim()===''){
                                input.classList.add('error');
                                toggleErrorLabelVanilaJs(input, true);
                            }

                            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;
                            if (!emailRegex.test( input.value)){
                                input.classList.add('error');
                                toggleErrorLabelVanilaJs(input, true);
                            }
                            break;

                    }


                })

                break;

        }




    })




    const customForms =document.querySelectorAll('.js-form-custom');
    customForms.forEach(form=>{
        form.addEventListener('submit',async (e) => {
            e.preventDefault()
            const fields = form.querySelectorAll('input,textarea,select');
            let error = false
            fields.forEach((field) => {
                if (field.hasAttribute('data-required')) {
                    switch (field.type) {
                        case "select":
                            if (+field.value === 0) {
                                error = true
                                toggleErrorLabelVanilaJs(field, true);
                            }
                            break;
                        default:
                            if (field.value.trim() === '') {
                                error = true
                                toggleErrorLabelVanilaJs(field, true);
                            }
                            break
                    }
                }

            })
            if (!error){
                const formData = new FormData(form);
                formData.append('url', window.location.href);
                formData.append('action', 'feedback_form_custom');
                form.classList.add('loading');
                let response = await fetch( space_obj.ajax_url,{
                    method:'POST',
                    body:formData,

                });
                response = await response.json()
                form.classList.remove('loading');
                form.reset();
                $.fancybox.close();
                if(response.status){
                    $.fancybox.open({
                        src  : '#feedback-success',
                        type : 'inline',
                        opts : {
                            touch: false,
                            keyboard: false,
                            afterClose: function(){
                                $('style:contains(".compensate-for-scrollbar")').remove();
                            }
                        }
                    });
                }else{
                    $.fancybox.open({
                        src  : '#feedback-error',
                        type : 'inline',
                        opts : {
                            touch: false,
                            keyboard: false,
                            afterClose: function(){
                                $('style:contains(".compensate-for-scrollbar")').remove();
                            }
                        }
                    });
                }
            }



        })
    })


})

// Плавный скролл
//function CustomSmoothScroll(target, speed = 100, smooth = 12) {
//    if (target === document)
//        target = (
//            document.scrollingElement ||
//            document.documentElement ||
//            document.body.parentNode ||
//            document.body
//        );
//
//    let moving = false;
//    let pos = target.scrollTop;
//    const frame = (target === document.body && document.documentElement)
//        ? document.documentElement
//        : target;
//
//    target.addEventListener('mousewheel', scrolled, { passive: false });
//    target.addEventListener('DOMMouseScroll', scrolled, { passive: false });
//
//    // следим за ручным скроллом и синхронизируем, если расхождение большое
//    target.addEventListener('scroll', () => {
//        if (!moving && Math.abs(pos - target.scrollTop) > 2) {
//            pos = target.scrollTop;
//        }
//    });
//
//    function scrolled(e) {
//        e.preventDefault();
//
//        const delta = normalizeWheelDelta(e);
//
//        // только если пользователь прокрутил вручную, а не плавно
//        if (Math.abs(pos - target.scrollTop) > 50) {
//            pos = target.scrollTop;
//        }
//
//        pos += -delta * speed;
//        pos = Math.max(0, Math.min(pos, target.scrollHeight - frame.clientHeight));
//
//        if (!moving) update();
//    }
//
//    function normalizeWheelDelta(e) {
//        if (e.detail) {
//            if (e.wheelDelta)
//                return e.wheelDelta / e.detail / 40 * (e.detail > 0 ? 1 : -1);
//            else
//                return -e.detail / 3;
//        } else {
//            return e.wheelDelta / 120;
//        }
//    }
//
//    function update() {
//        moving = true;
//
//        const delta = (pos - target.scrollTop) / smooth;
//        target.scrollTop += delta;
//
//        if (Math.abs(delta) > 0.5) {
//            requestFrame(update);
//        } else {
//            moving = false;
//        }
//    }
//
//    const requestFrame = (
//        window.requestAnimationFrame ||
//        window.webkitRequestAnimationFrame ||
//        window.mozRequestAnimationFrame ||
//        window.oRequestAnimationFrame ||
//        window.msRequestAnimationFrame ||
//        function (func) {
//            window.setTimeout(func, 1000 / 50);
//        }
//    );
//}

// class FramePlayer
// {
//     constructor(parent, totalFrames, fps)
//     {
//         this.canvas = parent.querySelector('canvas');
//         this.ctx = this.canvas.getContext('2d');
//         this.canvas.width = this.canvas.offsetWidth;
//         this.canvas.height = this.canvas.offsetHeight;
//
//         this.pathToImage = parent.dataset.path;
//         this.totalFrames = totalFrames;
//         this.fps = document.hidden ? 30 : fps;
//         this.frames = [];
//         this.currentFrame = 0;
//         this.loadedFrames = 0;
//         this.isPreviewVisible = true;
//
//         this.init()
//         window.addEventListener('resize', this.resize.bind(this));
//     }
//
//     resize() {
//         this.canvas.width = this.canvas.offsetWidth;
//         this.canvas.height = this.canvas.offsetHeight;
//
//         // Перерисовываем текущий кадр после ресайза
//         if (this.frames[this.currentFrame]) {
//             this.drawImageFitTopLeft(this.frames[this.currentFrame]);
//         }
//     }
//
//     async init()
//     {
//         await this.preview();
//         this.preloadFrames(); // Не ждем завершения, начинаем анимацию сразу
//         this.animate(); // Начинаем анимацию сразу после превью
//     }
//
//     async preview()
//     {
//         try {
//             const img = await this.loadImage(this.pathToImage + '/preview.webp');
//             this.drawImageFitTopLeft(img);
//         } catch (error) {
//             console.warn('Preview image failed to load:', error);
//         }
//     }
//
//     // Параллельная загрузка кадров
//     async preloadFrames() {
//         const loadPromises = [];
//
//         for (let i = 1; i <= this.totalFrames; i++) {
//             const promise = this.loadImage(this.pathToImage + `/frame-${String(i).padStart(3, '0')}.webp`)
//                 .then(img => {
//                     this.frames[i-1] = img;
//                     this.loadedFrames++;
//                     return img;
//                 })
//                 .catch(error => {
//                     console.warn(`Failed to load frame ${i}:`, error);
//                     return null;
//                 });
//
//             loadPromises.push(promise);
//         }
//
//         // Ждем загрузку всех кадров в фоне
//         await Promise.all(loadPromises);
//         // console.log(`Loaded ${this.loadedFrames}/${this.totalFrames} frames`);
//     }
//
//     async loadImage(url)
//     {
//         return new Promise((resolve, reject) => {
//             const img = new Image();
//             img.onload = () => resolve(img);
//             img.onerror = reject;
//             img.src = url;
//         });
//     }
//
//     // Анимация с проверкой загрузки
//     animate() {
//         if (this.frames[this.currentFrame]) {
//             this.drawImageFitTopLeft(this.frames[this.currentFrame]);
//             this.isPreviewVisible = false;
//         }
//
//         this.currentFrame = (this.currentFrame + 1) % this.totalFrames;
//
//         setTimeout(() => {
//             requestAnimationFrame(this.animate.bind(this));
//         }, 1000 / this.fps);
//     }
//
//     drawImageFitTopLeft(img) {
//         const offset = 60;
//
//         this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
//         this.ctx.drawImage(
//             img,
//             0, 0, img.width, img.height,
//             -offset, -offset,
//             this.canvas.width + (offset * 2),
//             this.canvas.height + (offset * 2)
//         );
//     }
// }
//
// document.addEventListener('DOMContentLoaded', function (  ) {
//     if (document.querySelector('[data-hero-video]')) {
//         new FramePlayer(document.querySelector('[data-hero-video]'), 150, 60)
//     }
// })