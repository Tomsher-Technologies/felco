// -------------------------------------------------------------
// Laravel Bootstrap Setup
import 'flowbite';
import './bootstrap';


// -------------------------------------------------------------
// Alpine.js for UI Interactions + Collapse Plugin
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;
Alpine.plugin(collapse);
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
  const felcoPd = document.querySelector('#felco-pd');
  if (felcoPd) {
    gsap.fromTo(felcoPd,
      { backgroundColor: "#ffffff" },
      {
        backgroundColor: "#000000",
        ease: "none",
        scrollTrigger: {
          trigger: felcoPd,
          start: "top bottom",
          end: "top center",
          scrub: true,
        },
      }
    );
  }


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
// Additional GSAP Animations (grouped inside DOMContentLoaded)
document.addEventListener("DOMContentLoaded", function () {
  gsap.registerPlugin(ScrollTrigger);

  // Animate background image width from 0% to 100%
  const aboutUsBanner = document.querySelector("#aboutUsBanner");
  if (aboutUsBanner) {
    gsap.fromTo("[data-gsap='bg-width']",
      { width: "0%" },
      {
        width: "100%",
        ease: "power2.out",
        scrollTrigger: {
          trigger: aboutUsBanner,
          start: "top bottom",
          end: "top top",
          scrub: true,
        }
      }
    );

    gsap.to("[data-gsap='bg-width']", {
      filter: "blur(2px)",
      opacity: 0.85,
      scrollTrigger: {
        trigger: aboutUsBanner,
        start: "top 60%",
        end: "bottom top",
        scrub: true,
      }
    });

    gsap.from("[data-gsap='hero-content']", {
      y: 50,
      opacity: 0,
      duration: 1.4,
      ease: "power3.out",
      scrollTrigger: {
        trigger: aboutUsBanner,
        start: "top 80%",
        toggleActions: "play none none reverse"
      }
    });
  }


  // Parallax zoom image fade-in
  gsap.utils.toArray(".parallax-zoom-image").forEach(el => {
    gsap.from(el, {
      scale: 1.2,
      opacity: 0,
      duration: 1.6,
      ease: "power3.out"
    });
  });


  // Animate about image zoom
  const aboutImgZoom = document.querySelector(".about-img-zoom");
  if (aboutImgZoom) {
    gsap.from(aboutImgZoom, {
      scrollTrigger: {
        trigger: aboutImgZoom,
        start: "top 100%",
        end: "bottom 50%",
        scrub: true,
      },
      scale: 0,
      opacity: 0,
      transformOrigin: "center center",
      ease: "power2.out"
    });
  }


  // Industry Section Animations
  const industryStickyImage = document.querySelector("#industryStickyImage");
  if (industryStickyImage) {
    gsap.from(industryStickyImage, {
      opacity: 0,
      scale: 0.95,
      y: 50,
      duration: 1,
      ease: "power2.out",
      scrollTrigger: {
        trigger: industryStickyImage,
        start: "top 80%",
        toggleActions: "play none none reverse"
      }
    });
  }

  const industrySectionHeader = document.querySelector("#industrySectionHeader");
  if (industrySectionHeader) {
    gsap.from(industrySectionHeader, {
      opacity: 0,
      y: 40,
      duration: 0.8,
      ease: "power2.out",
      scrollTrigger: {
        trigger: industrySectionHeader,
        start: "top 85%",
        toggleActions: "play none none reverse"
      }
    });
  }

  const industryProductGrid = document.querySelector("#industryProductGrid");
  if (industryProductGrid) {
    gsap.from(industryProductGrid, {
      opacity: 0,
      y: 60,
      duration: 1,
      ease: "power2.out",
      scrollTrigger: {
        trigger: industryProductGrid,
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
        trigger: industryProductGrid,
        start: "top 90%",
        toggleActions: "play none none reverse"
      }
    });
  }


  // Application Section Animations
  const applicationHeader = document.querySelector("#applicationHeader");
  if (applicationHeader) {
    gsap.from(applicationHeader, {
      opacity: 0,
      y: 40,
      duration: 0.8,
      ease: "power2.out",
      scrollTrigger: {
        trigger: applicationHeader,
        start: "top 85%",
        toggleActions: "play none none reverse"
      }
    });
  }

  const applicationGrid = document.querySelector("#applicationGrid");
  if (applicationGrid) {
    gsap.from(".application-card", {
      opacity: 0,
      y: 40,
      duration: 0.6,
      ease: "power2.out",
      stagger: 0.15,
      scrollTrigger: {
        trigger: applicationGrid,
        start: "top 90%",
        toggleActions: "play none none reverse"
      }
    });
  }


  // Animate common animation-on-scroll elements by data attribute
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


// Additional GSAP Animations for header and steps
document.addEventListener("DOMContentLoaded", () => {
  gsap.registerPlugin(ScrollTrigger);

  // Animate Heading and Description
  const heading = document.querySelector("#heading");
  if(heading) {
    gsap.from(heading, {
      opacity: 0,
      y: -50,
      duration: 1,
      delay: 0.5,
      ease: "power2.out"
    });
  }

  const desc = document.querySelector("#desc");
  if(desc) {
    gsap.from(desc, {
      opacity: 0,
      y: 30,
      duration: 1,
      delay: 1,
      ease: "power2.out"
    });
  }


  // Animate Steps
  for (let i = 1; i <= 4; i++) {
    const step = document.querySelector(`#step${i}`);
    if(step) {
      gsap.from(step, {
        opacity: 0,
        x: (i % 2 === 1) ? -100 : 100,
        duration: 1,
        delay: 0.5 + i * 0.5,
        ease: "power2.out",
        scrollTrigger: {
          trigger: step,
          start: "top 80%",
          toggleActions: "play none none reverse"
        }
      });
    }
  }
});
