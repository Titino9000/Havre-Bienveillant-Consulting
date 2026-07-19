// main.js – Modern interactions for RyzhaTech

// Preloader
$(window).on('load', function() {
    $('.preloader').fadeOut(500);
});

// Counter Animation (trigger when visible)
function animateCounters() {
    $('.counter-count').each(function() {
        const $el = $(this);
        const target = parseInt($el.data('count')) || 0;
        if ($el.data('animated')) return;
        $el.data('animated', true);
        $el.prop('Counter', 0).animate({
            Counter: target
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $el.text(Math.ceil(now));
            },
            complete: function() {
                $el.text(target);
            }
        });
    });
}

// Intersection Observer for counters
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.counter-count').forEach(el => {
    counterObserver.observe(el);
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Sticky Navbar
$(window).scroll(function() {
    if ($(this).scrollTop() > 50) {
        $('.navbar-area').addClass('scrolled');
    } else {
        $('.navbar-area').removeClass('scrolled');
    }
});

// Back to top button
$(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
        $('.go-top').addClass('active');
    } else {
        $('.go-top').removeClass('active');
    }
});
$('.go-top').on('click', function() {
    $('html, body').animate({ scrollTop: 0 }, 800);
});


