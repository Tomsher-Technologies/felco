// -------------------------------------------------------------
// Laravel Bootstrap Setup
import 'flowbite';
import './bootstrap';


// -------------------------------------------------------------
// Alpine.js for UI Interactions
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// -------------------------------------------------------------
// Swiper.js for Sliders
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

// -------------------------------------------------------------
// Toastr for Notifications
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

import { Dropdown, initDropdowns } from 'flowbite';

// Initialize all dropdowns
initDropdowns();


// -------------------------------------------------------------
// GSAP for Animations & Smooth Scrolling
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import ScrollSmoother from 'gsap/ScrollSmoother';
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
window.gsap = gsap;

// -------------------------------------------------------------
// DOM Ready Events
window.addEventListener('load', () => {
  // ---------------------------------------------------------
  // Hero Slider (Fade Effect)
  new Swiper('.hero-swiper', {
    modules: [Navigation, Pagination, Autoplay],
    loop: true,
    effect: 'fade',
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  // ---------------------------------------------------------
  // Industry Slider (Creative Layout)
  new Swiper('.industrySwiper', {
    modules: [Navigation, Autoplay],
    loop: true,
    speed: 900,
    slidesPerView: 1.2,
    spaceBetween: 20,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    navigation: {
      nextEl: '#industryNext',
      prevEl: '#industryPrev',
    },
    breakpoints: {
      640: { slidesPerView: 1.4 },
      768: { slidesPerView: 1.6 },
      1024: { slidesPerView: 2 },
      1280: { slidesPerView: 2.2 },
    },
  });











  // ---------------------------------------------------------
  // GSAP ScrollSmoother Init
  const wrapper = document.querySelector('#smooth-wrapper');
  const content = document.querySelector('#smooth-content');
  if (wrapper && content) {
    ScrollSmoother.create({
      wrapper: '#smooth-wrapper',
      content: '#smooth-content',
      smooth: 1.2,
      effects: true,
    });
  }

  // ---------------------------------------------------------
  // GSAP: Fade-Up Scroll Animation
  gsap.utils.toArray('.gsap-fade-up').forEach((el, index) => {
    gsap.from(el, {
      opacity: 0,
      y: 60,
      duration: 1,
      delay: index * 0.1,
      ease: 'power2.out',
      willChange: 'transform, opacity',
      scrollTrigger: {
        trigger: el,
        start: 'top 90%',
        toggleActions: 'play none none reverse',
      },
    });
  });

  // ---------------------------------------------------------
  // GSAP: Background Color Transition (clean)
  // ---------------------------------------------------------
  // GSAP: Background Color Transition (white → black on scroll)
  gsap.fromTo("#felco-pd",
    { backgroundColor: "#ffffff" },
    {
      backgroundColor: "#000000",
      ease: "none",
      scrollTrigger: {
        trigger: "#felco-pd",
        start: "top bottom",   // Trigger starts when the section hits the bottom of viewport
        end: "top center",     // Ends earlier for faster transition
        scrub: true,           // Enables smooth scroll-linked animation (reversible)
      },
    }
  );




  // ---------------------------------------------------------
  // GSAP: Background Parallax Animation
  gsap.utils.toArray('.bg-parallax').forEach((el) => {
    gsap.fromTo(
      el,
      { x: 100, opacity: 0 },
      {
        x: 0,
        opacity: 1,
        duration: 1.5,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: el,
          start: 'top 85%',
          toggleActions: 'play none none reverse',
        },
      }
    );
  });
});

// -------------------------------------------------------------
// Additional GSAP Animations (non-merged logic)
document.addEventListener("DOMContentLoaded", function () {
  gsap.registerPlugin(ScrollTrigger);

  // Animate background image width from 0% to 100%
  gsap.fromTo("[data-gsap='bg-width']",
    { width: "0%" },
    {
      width: "100%",
      ease: "power2.out",
      scrollTrigger: {
        trigger: "#aboutUsBanner",
        start: "top bottom",
        end: "top top",
        scrub: true,
      }
    }
  );

  // Optional: blur + fade effect on scroll
  gsap.to("[data-gsap='bg-width']", {
    filter: "blur(2px)",
    opacity: 0.85,
    scrollTrigger: {
      trigger: "#aboutUsBanner",
      start: "top 60%",
      end: "bottom top",
      scrub: true,
    }
  });

  // Animate full content block inside banner
  gsap.from("[data-gsap='hero-content']", {
    y: 50,
    opacity: 0,
    duration: 1.4,
    ease: "power3.out",
    scrollTrigger: {
      trigger: "#aboutUsBanner",
      start: "top 80%",
      toggleActions: "play none none reverse"
    }
  });
});



document.addEventListener('DOMContentLoaded', () => {
  gsap.from(".parallax-zoom-image", {
    scale: 1.2,
    opacity: 0,
    duration: 1.6,
    ease: "power3.out"
  });
});






gsap.from(".about-img-zoom", {
  scrollTrigger: {
    trigger: ".about-img-zoom",
    start: "top 100%",   // when the top of the image hits 80% of the viewport
    end: "bottom 50%",
    scrub: true,        // makes it smoothly animate on scroll
  },
  scale: 0,
  opacity: 0,
  transformOrigin: "center center",
  ease: "power2.out"
});




document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // Animate Sticky Image
    gsap.from("#industryStickyImage", {
        opacity: 0,
        scale: 0.95,
        y: 50,
        duration: 1,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#industryStickyImage",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });

    // Animate Header
    gsap.from("#industrySectionHeader", {
        opacity: 0,
        y: 40,
        duration: 0.8,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#industrySectionHeader",
            start: "top 85%",
            toggleActions: "play none none reverse"
        }
    });

    // Animate Product Grid
    gsap.from("#industryProductGrid", {
        opacity: 0,
        y: 60,
        duration: 1,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#industryProductGrid",
            start: "top 85%",
            toggleActions: "play none none reverse"
        }
    });

    gsap.from("#industryProductGrid > div", {
    opacity: 0,
    y: 40,
    duration: 0.6,
    stagger: 0.15,
    ease: "power2.out",
    scrollTrigger: {
        trigger: "#industryProductGrid",
        start: "top 90%",
        toggleActions: "play none none reverse"
    }
});
});



document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // Animate Applications Header
    gsap.from("#applicationHeader", {
        opacity: 0,
        y: 40,
        duration: 0.8,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#applicationHeader",
            start: "top 85%",
            toggleActions: "play none none reverse"
        }
    });

    // Animate Application Cards
    gsap.from(".application-card", {
        opacity: 0,
        y: 40,
        duration: 0.6,
        ease: "power2.out",
        stagger: 0.15,
        scrollTrigger: {
            trigger: "#applicationGrid",
            start: "top 90%",
            toggleActions: "play none none reverse"
        }
    });
});





window.addEventListener("load", () => {
  gsap.registerPlugin(ScrollTrigger);

  gsap.utils.toArray(".animate-on-scroll").forEach((el, index) => {
    const animType = el.dataset.anim || "fade-up";

    switch (animType) {
      case "zoom":
        gsap.from(el, {
          opacity: 0,
          scale: 0.8,
          duration: 1,
          ease: "back.out(1.7)",
          scrollTrigger: {
            trigger: el,
            start: "top 85%",
            toggleActions: "play none none reverse"
          }
        });
        break;

      case "rotate-left":
        gsap.from(el, {
          opacity: 0,
          rotation: -10,
          x: -60,
          duration: 1.2,
          ease: "power4.out",
          scrollTrigger: {
            trigger: el,
            start: "top 90%",
            toggleActions: "play none none reverse"
          }
        });
        break;

      case "clip-reveal":
        gsap.fromTo(
          el,
          {
            clipPath: "inset(0 100% 0 0)",
            opacity: 0
          },
          {
            clipPath: "inset(0 0% 0 0)",
            opacity: 1,
            duration: 1.2,
            ease: "power2.out",
            scrollTrigger: {
              trigger: el,
              start: "top 85%",
              toggleActions: "play none none reverse"
            }
          }
        );
        break;

      default: // fade-up
        gsap.from(el, {
          opacity: 0,
          y: 30,
          duration: 0.8,
          delay: index * 0.1,
          ease: "power2.out",
          scrollTrigger: {
            trigger: el,
            start: "top 90%",
            toggleActions: "play none none reverse"
          }
        });
        break;
    }
  });
});






