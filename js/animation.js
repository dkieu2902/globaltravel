/**
 * Animations initialization script
 * Handles AOS and other animation effects
 */

// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function() {
    initializeAOS();
});

// Make sure animations are refreshed when the page is fully loaded
window.addEventListener('load', function() {
    if (typeof AOS !== 'undefined') {
        setTimeout(function() {
            AOS.refresh();
            console.log('AOS refreshed on window load');
        }, 500);
    }
});

// Helper function to initialize AOS with proper settings
function initializeAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true, // Set to true to have animations appear only once when entering viewport
            mirror: false, // Set to false to prevent mirroring effect
            offset: 50,
            delay: 100,
            anchorPlacement: 'top-bottom',
            disable: false // Enable on all devices including mobile
        });
        
        console.log('AOS initialized with custom settings');
        
        // Force animation reset by removing all AOS classes and re-adding them
        resetAllAnimations();
    } else {
        console.warn('AOS library not found. Animations may not work properly.');
        
        // Try to load AOS dynamically if it's missing
        loadAOSDynamically();
    }
}

// Function to reset all animations
function resetAllAnimations() {
    // First remove all animation classes
    document.querySelectorAll('[data-aos]').forEach(function(element) {
        element.classList.remove('aos-animate');
        element.classList.remove('aos-init');
    });
    
    // Force browser reflow
    document.body.getBoundingClientRect();
    
    // Re-initialize AOS after a short delay
    setTimeout(function() {
        AOS.refreshHard();
    }, 10);
}

// Dynamically load AOS if it's not present
function loadAOSDynamically() {
    // Load CSS
    if (!document.querySelector('link[href*="aos.css"]')) {
        var aosCSS = document.createElement('link');
        aosCSS.rel = 'stylesheet';
        aosCSS.href = 'https://unpkg.com/aos@2.3.1/dist/aos.css';
        document.head.appendChild(aosCSS);
    }
    
    // Load JS
    if (typeof AOS === 'undefined') {
        var aosScript = document.createElement('script');
        aosScript.src = 'https://unpkg.com/aos@2.3.1/dist/aos.js';
        aosScript.onload = function() {
            initializeAOS();
        };
        document.head.appendChild(aosScript);
    }
}

// Detect page refresh/reload and reset animations
window.addEventListener('beforeunload', function() {
    // Store a flag to indicate the page is being refreshed
    sessionStorage.setItem('pageIsRefreshing', 'true');
});

window.addEventListener('DOMContentLoaded', function() {
    if (sessionStorage.getItem('pageIsRefreshing') === 'true') {
        // Page was refreshed, reset the flag
        sessionStorage.removeItem('pageIsRefreshing');
        // Force animation reset after a short delay
        setTimeout(function() {
            resetAllAnimations();
        }, 100);
    }
});

// Handle scroll events more effectively
let lastScrollTop = 0;
let scrollTimeout;

window.addEventListener('scroll', function() {
    const st = window.pageYOffset || document.documentElement.scrollTop;
    
    // Clear previous timeout to avoid multiple refreshes
    clearTimeout(scrollTimeout);
    
    // Detect scroll direction
    const scrollingDown = st > lastScrollTop;
    lastScrollTop = st <= 0 ? 0 : st;
    
    // Set a timeout to refresh AOS when scrolling stops
    scrollTimeout = setTimeout(function() {
        if (typeof AOS !== 'undefined') {
            // Additional check to ensure elements in viewport are properly animated
            document.querySelectorAll('[data-aos]').forEach(function(element) {
                if (!element.classList.contains('aos-animate') && isElementInViewport(element)) {
                    element.classList.add('aos-animate');
                }
            });
        }
    }, 100);
}, { passive: true });

// Handle orientation change on mobile devices
window.addEventListener('orientationchange', function() {
    if (typeof AOS !== 'undefined') {
        setTimeout(function() {
            AOS.refresh();
        }, 300);
    }
});

// Add a special listener for tab changes
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
        setTimeout(function() {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 100);
    }
});

// Helper function to check if element is in viewport
function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.bottom >= 0 &&
        rect.left <= (window.innerWidth || document.documentElement.clientWidth) &&
        rect.right >= 0
    );
}

// Export utility functions to window object
window.AnimationUtils = {
    refreshAnimations: function() {
        if (typeof AOS !== 'undefined') {
            AOS.refresh(true);
        }
    },
    
    resetAllAnimations: resetAllAnimations,
    
    // Force animation on specific elements
    forceAnimation: function(selector) {
        const elements = document.querySelectorAll(selector);
        if (elements.length > 0) {
            elements.forEach(function(el) {
                // Reset animation state
                el.classList.remove('aos-animate');
                
                // Force browser reflow
                void el.offsetWidth;
                
                // Re-add animation class
                if (isElementInViewport(el)) {
                    el.classList.add('aos-animate');
                }
            });
        }
    }
};

// Thêm hiệu ứng hover cho các phần tử cần thiết
const hoverElements = document.querySelectorAll('.hover-effect');
hoverElements.forEach(element => {
    element.addEventListener('mouseenter', function() {
        this.classList.add('hover-active');
    });
    element.addEventListener('mouseleave', function() {
        this.classList.remove('hover-active');
    });
});

// Tối ưu hiệu suất của trang
// Lazy load images
const lazyImages = document.querySelectorAll('.lazy-load');
if ('IntersectionObserver' in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                let lazyImage = entry.target;
                lazyImage.src = lazyImage.dataset.src;
                lazyImage.classList.remove('lazy-load');
                lazyImageObserver.unobserve(lazyImage);
            }
        });
    });

    lazyImages.forEach(function(lazyImage) {
        lazyImageObserver.observe(lazyImage);
    });
}

// Custom animations for specific elements
document.addEventListener('DOMContentLoaded', function() {
    // Staggered animations for lists
    const animatedLists = document.querySelectorAll('.animated-list');
    animatedLists.forEach(function(list) {
        const items = list.querySelectorAll('li');
        items.forEach(function(item, index) {
            item.style.animationDelay = (index * 100) + 'ms';
        });
    });
    
    // Add scroll-triggered fade animations for generic elements
    const fadeElements = document.querySelectorAll('.fade-in-element');
    
    window.addEventListener('scroll', function() {
        fadeElements.forEach(function(element) {
            if (isInViewport(element) && !element.classList.contains('animated')) {
                element.classList.add('animated');
            }
        });
    });
    
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.85 &&
            rect.bottom >= 0
        );
    }
}); 