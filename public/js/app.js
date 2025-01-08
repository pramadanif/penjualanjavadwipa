import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var pageScrollLinks = document.querySelectorAll('a.page-scroll');
    pageScrollLinks.forEach(function(anchor) {
        anchor.addEventListener('click', function(event) {
            event.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    document.addEventListener('scroll', function() {
        var sections = document.querySelectorAll('section');
        var scrollPos = window.scrollY || document.documentElement.scrollTop;

        sections.forEach(function(section) {
            var navLinks = document.querySelectorAll('.navbar-fixed-top a');
            if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + section.id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });

    var menuItems = document.querySelectorAll('.navbar-collapse ul li a');
    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var navbarToggle = document.querySelector('.navbar-toggle');
            if (navbarToggle && getComputedStyle(navbarToggle).display !== 'none') {
                navbarToggle.click();
            }
        });
    });
});
