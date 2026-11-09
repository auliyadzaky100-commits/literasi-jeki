(function ($) {
    'use strict';

    // Function to hide preloader
    var preloader = $('.dt_preloader');
    function plotoHidePreloader() {
        $('body').addClass('overlay--enabled')
        if (preloader.length) {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        }
    }
    if (preloader.length) {
        $('.dt_preloader-close').on('click', function () {
            preloader.addClass('loaded');
            preloader.delay(600).fadeOut();
            $('body').removeClass('overlay--enabled');
        });
    }

    // Function to initialize Owl Slider Main
    function plotoSplitTitleWords($element) {
        const text = $element.data('text');

        if (!text) {
            const content = $element.html();
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = content;
            $element.html('');

            let wordIndex = 0;

            tempDiv.childNodes.forEach(node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    // Trim karo aur empty nodes ignore karo
                    const trimmedText = node.textContent.trim();
                    if (!trimmedText) return; // Empty text node ko skip kar do

                    const words = trimmedText.split(' ');
                    words.forEach((word, index) => {
                        if (word) {
                            const delay = wordIndex * 0.1;
                            $element.append(`<span style="animation-delay: ${delay}s">${word}</span>`);
                            wordIndex++;
                        }
                        if (index < words.length - 1) {
                            $element.append(' ');
                        }
                    });
                } else if (node.nodeType === Node.ELEMENT_NODE) {
                    const delay = wordIndex * 0.1;
                    const clone = node.cloneNode(true);
                    const wrapper = document.createElement('span');
                    wrapper.style.animationDelay = `${delay}s`;
                    wrapper.appendChild(clone);
                    $element.append(wrapper);

                    const wordCount = node.textContent.trim().split(' ').length;
                    wordIndex += wordCount;
                }
            });
            return;
        }

        const words = text.split(' ');
        $element.html('');

        words.forEach((word, index) => {
            const delay = index * 0.1;
            $element.append(`<span style="animation-delay: ${delay}s">${word} </span>`);
        });
    }

    function plotoPrepareAllTitles() {
        $('.dt_slider--one .title').each(function () {
            plotoSplitTitleWords($(this));
        });
    }

    function plotoAnimateCurrentSlideContent() {
        const $activeSlide = $('.dt_slider .owl-item.active').not('.cloned');
        const $title = $activeSlide.find('.title');
        const $subtitle = $activeSlide.find('.subtitle');
        const $text = $activeSlide.find('.text');
        const $btnGroup = $activeSlide.find('.dt_btn-group');

        // Skip if already animated
        if ($activeSlide.hasClass('content-animated')) return;

        // Remove animations from all other slides
        $('.dt_slider .owl-item').removeClass('content-animated');
        $('.dt_slider .title').removeClass('animate-title');
        $('.dt_slider .subtitle').removeClass('animate-subtitle');
        $('.dt_slider .text').removeClass('animate-text');
        $('.dt_slider .dt_btn-group').removeClass('animate-buttons');

        // Add animation classes
        $title.addClass('animate-title');
        $subtitle.addClass('animate-subtitle');
        $text.addClass('animate-text');
        $btnGroup.addClass('animate-buttons');

        // Mark this slide as animated
        $activeSlide.addClass('content-animated');
    }

    function plotoOwlCarousels() {
        $(".dt_owl_carousel").each(function () {
            const $carousel = $(this);
            const options = typeof $carousel.data("owl-options") === "object"
                ? $carousel.data("owl-options")
                : JSON.parse($carousel.attr("data-owl-options"));

            $carousel.owlCarousel(options)
                .on('initialized.owl.carousel', function () {
                    plotoPrepareAllTitles();         // Split title words to spans
                    if ($('.dt_slider').hasClass('dt_slider--one')) {
                        plotoAnimateCurrentSlideContent(); // Animate first slide
                    }
                })
                .on('translated.owl.carousel', function () {
                    if ($('.dt_slider').hasClass('dt_slider--one')) {
                        plotoAnimateCurrentSlideContent(); // Animate after slide transition
                    }
                });
        });
    }

    // Function to handle scrolling and update progress bar
    function plotoUpdateProgressBar() {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();

        // 100% → 0% value
        var percent = 100 - ((scroll / height) * 100);

        // Clamp value between 0 and 100
        percent = Math.max(0, Math.min(100, percent));

        // Apply to .water
        document.querySelector('.dt_uptop .water').style.transform =
            `translateY(${percent}%)`;
    }

    // Event handling for scrolling and updating progress bar
    $(window).on('scroll', function () {
        $('.dt_uptop').toggleClass('active', $(this).scrollTop() > 50);
        plotoUpdateProgressBar();
    });

    // Function to handle click event for scrolling to top
    $('.dt_uptop').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 550);
    });

    // Btn Effect Six
    setTimeout(() => {
        document.querySelectorAll(".btn--effect-six .dt-btn").forEach(button => {
            const originalHTML = button.innerHTML;
            // Use min-width to preserve layout
            button.style.minWidth = (button.offsetWidth + 1) + "px";

            button.addEventListener("mouseover", () => {
                if (!button.classList.contains("animating") && !button.classList.contains("mouseover")) {
                    button.classList.add("animating", "mouseover");

                    const tempDiv = document.createElement("div");
                    tempDiv.innerHTML = originalHTML;
                    const chars = Array.from(tempDiv.childNodes);

                    setTimeout(() => button.classList.remove("animating"), (chars.length + 1) * 50);

                    const animationType = button.dataset.animation || "text-spin";
                    button.innerHTML = "";

                    chars.forEach(node => {
                        if (node.nodeType === Node.TEXT_NODE) {
                            node.textContent.split("").forEach(char => {
                                if (char.trim() !== "" || char === " ") {
                                    button.innerHTML += `<span class="letter">${char === " " ? "&nbsp;" : char}</span>`;
                                }
                            });
                        } else {
                            // Agar element node hai, direct add karo, span me wrap mat karo
                            button.appendChild(node);
                        }
                    });

                    // Animate sirf spans ko
                    button.querySelectorAll(".letter").forEach((span, index) => {
                        setTimeout(() => span.classList.add(animationType), 50 * index);
                    });
                }
            });

            button.addEventListener("mouseout", () => {
                button.classList.remove("mouseover");
                button.innerHTML = originalHTML;
            });
        });
    }, 100);

    setTimeout(() => {
        document.querySelectorAll(".btn--effect-one .dt-btn, .btn--effect-two .dt-btn, .btn--effect-three .dt-btn").forEach(button => {
            if (button.querySelector(".text")) return;

            const originalHTML = button.innerHTML;
            button.innerHTML = "";

            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = originalHTML;

            Array.from(tempDiv.childNodes).forEach(node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    if (node.textContent.trim() !== "") {
                        const text = node.textContent;
                        const content = text.trim();

                        const leadingMatch = text.match(/^\s*/);
                        const leading = leadingMatch ? leadingMatch[0] : "";

                        const trailingMatch = text.match(/\s*$/);
                        const trailing = trailingMatch ? trailingMatch[0] : "";

                        if (leading) button.appendChild(document.createTextNode(leading));

                        // outer span
                        const span = document.createElement("span");
                        span.classList.add("btn-text");

                        // inner span
                        const inner = document.createElement("span");
                        inner.textContent = content;

                        span.appendChild(inner);
                        button.appendChild(span);

                        if (trailing) button.appendChild(document.createTextNode(trailing));
                    } else {
                        button.appendChild(node);
                    }
                } else {
                    button.appendChild(node);
                }
            });
        });
    }, 100);

    if ($('.smoother-yes').length) {
        const lenis = new Lenis({
            smoothWheel: true,
            wheelMultiplier: 1.2,
            duration: 1.5,
            lerp: 0.1,
        });
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Handle scroll animation for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                const id = el.getAttribute('href')?.slice(1);
                if (!id) return;
                const target = document.getElementById(id);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Function to handle lenis prevent for dynamic select woo checkout
        if ($('body.woocommerce-checkout').length) {
            const lenisPreventDynamic = () => {
                document.querySelectorAll('.select2-results__options:not([data-lenis-prevent])').forEach((el) => {
                    el.setAttribute('data-lenis-prevent', '');
                });
            };
            const observer = new MutationObserver((mutationsList) => {
                mutationsList.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === 1 && node.matches('.select2-results__options')) {
                            lenisPreventDynamic();
                        } else if (node.nodeType === 1 && node.querySelector('.select2-results__options')) {
                            lenisPreventDynamic();
                        }
                    });
                });
            });
            observer.observe(document.body, {
                childList: true,
                subtree: true,
            });
            lenisPreventDynamic();
        }
    }

    // Title Animation
    const bodyClass = document.body.classList;
    const animationStyle = [...bodyClass].find(cls => cls.startsWith("use-animation-style-"));

    document.querySelectorAll(".text-animate").forEach(el => {
        let split;

        switch (animationStyle) {
            case "use-animation-style-1":
                split = new SplitText(el, {
                    type: "chars, words"
                });
                gsap.from(split.words, {
                    duration: 1,
                    delay: 0.5,
                    x: 20,
                    autoAlpha: 0,
                    stagger: 0.05,
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%"
                    }
                });
                break;

            case "use-animation-style-2":
                split = new SplitText(el, {
                    type: "chars, words"
                });
                gsap.from(split.chars, {
                    duration: 2,
                    delay: 0.1,
                    x: 20,
                    autoAlpha: 0,
                    stagger: 0.03,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 85%"
                    }
                });
                break;

            case "use-animation-style-3":
                if (el.animation) {
                    el.animation.progress(1).kill();
                    el.split.revert();
                }
                el.split = new SplitText(el, {
                    type: "lines,words,chars",
                    linesClass: "split-line"
                });
                gsap.set(el, {
                    perspective: 400
                });
                gsap.set(el.split.chars, {
                    opacity: 0,
                    x: "50"
                });
                el.animation = gsap.to(el.split.chars, {
                    scrollTrigger: {
                        trigger: el,
                        start: "top 90%"
                    },
                    x: "0",
                    y: "0",
                    rotateX: "0",
                    opacity: 1,
                    duration: 1,
                    ease: "back.out(1.7)",
                    stagger: 0.02
                });
                break;

            case "use-animation-style-4":
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        end: 'bottom 60%',
                        scrub: false,
                        markers: false,
                        toggleActions: 'play none none none'
                    }
                });
                const itemSplitted = new SplitText(el, {
                    type: "words, lines"
                });
                gsap.set(el, {
                    perspective: 400
                });
                itemSplitted.split({
                    type: "lines"
                });
                tl.from(itemSplitted.lines, {
                    duration: 1,
                    delay: 0.3,
                    opacity: 0,
                    rotationX: -80,
                    force3D: true,
                    transformOrigin: "top center -50",
                    stagger: 0.1
                });
                break;
        }
    });

    // Odometer
    if ($(".odometer").length) {
        $('.odometer').appear();
        $('.odometer').appear(function () {
            var odo = $(".odometer");
            odo.each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
            window.odometerOptions = {
                format: 'd',
            };
        });
    }

    // Section title animation on scroll into view
    function plotoAnimateSectionTitles() {
        if (window.innerWidth < 768) return;

        const animatedTitles = document.querySelectorAll('.sec-title');

        const setInitialStyles = (chars, animationType) => {
            gsap.set(chars, {
                opacity: 0,
                display: 'inline-block',
                transformOrigin: 'center center',
                ...(() => {
                    switch (animationType) {
                        case 'slide-down': return { y: -20 };
                        case 'rotate': return { rotation: -90 };
                        case 'zoom-in': return { scale: 0 };
                        case 'fade-up': return { y: 20 };
                        case 'bounce-in': return { scale: 0.5 };
                        case 'flip': return { rotationY: 90 };
                        default: return { x: 20 };
                    }
                })()
            });
        };

        const animateChars = (chars, animationType) => {
            gsap.to(chars, {
                opacity: 1,
                duration: 0.8,
                stagger: 0.03,
                ease: "back.out(1.7)",
                ...(() => {
                    switch (animationType) {
                        case 'slide-down': return { y: 0 };
                        case 'rotate': return { rotation: 0 };
                        case 'zoom-in': return { scale: 1 };
                        case 'fade-up': return { y: 0 };
                        case 'bounce-in': return { scale: 1 };
                        case 'flip': return { rotationY: 0 };
                        default: return { x: 0 };
                    }
                })()
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const animationType = el.getAttribute('data-animation') || 'slide-right';
                    const split = new SplitType(el, { types: 'chars' });
                    setInitialStyles(split.chars, animationType);
                    animateChars(split.chars, animationType);
                    observer.unobserve(el); // Run once
                }
            });
        }, { threshold: 0.2 });

        animatedTitles.forEach(el => observer.observe(el));
    }

    // Function to initialize FancyBox for lightbox images
    function plotoLightbox() {
        if ($('.dt_lightbox_img').length) {
            $('.dt_lightbox_img').fancybox({
                openEffect: 'fade',
                closeEffect: 'fade',
                helpers: { media: {} }
            });
        }
        $('.wp-block-image').each(function () {
            $(this).find("a").attr('data-fancybox', 'gallery');
        });
        if ($('.wp-block-image a').length) {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "share", "close"],
                loop: false,
                protect: true
            });
        }
    }

    // Accordion
    $(document).on("click", ".accordion__title", function () {
        const accordionWrapper = $(this).parent();
        const accordionContent = $(this).parent().find(".accordion__content").first();
        const accordionOpen = "accordion--open";

        // If this accordion is already open
        if (accordionWrapper.hasClass(accordionOpen)) {
            accordionContent.slideUp(); // Close the content.
            accordionWrapper.removeClass(accordionOpen); // Remove the accordionm--open class.
        } else {
            accordionContent.slideDown(); // Show this accordion's content.
            accordionWrapper.addClass(accordionOpen); // Add the accordion--open class.
        }
    });

    // Function to initialize headline and preloader on window load
    function plotoInitializeComponents() {
        $(window).on('load', function () {
            plotoHidePreloader();
            plotoUpdateProgressBar();
            plotoAnimateSectionTitles();
        });
    }

    $(document).ready(function () {
        plotoPrepareAllTitles(); // Setup spans
        plotoOwlCarousels(); // Init everything
        plotoLightbox(); // Initialize lightbox
    });

    // Initialize headline and preloader
    plotoInitializeComponents();

})(jQuery);
