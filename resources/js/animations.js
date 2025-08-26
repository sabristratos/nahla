import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// Custom Alpine.js Animation Directives
export function initAnimationDirectives(Alpine) {
    // Fade in with stagger animation
    Alpine.directive('fade-in', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const delay = config.delay || 0;
        const duration = config.duration || 0.8;
        const stagger = config.stagger || 0.2;
        
        // Set initial state
        gsap.set(el.children || el, { 
            opacity: 0, 
            y: 20,
            scale: 0.95
        });
        
        // Animate in
        gsap.to(el.children || el, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration,
            delay,
            stagger,
            ease: "power2.out"
        });
    });

    // Slide up animation
    Alpine.directive('slide-up', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const delay = config.delay || 0;
        const duration = config.duration || 0.6;
        
        gsap.fromTo(el, 
            { 
                opacity: 0, 
                y: 40,
                filter: "blur(4px)"
            },
            {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                duration,
                delay,
                ease: "power2.out"
            }
        );
    });

    // Scale in animation
    Alpine.directive('scale-in', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const delay = config.delay || 0;
        const duration = config.duration || 0.5;
        
        gsap.fromTo(el,
            {
                opacity: 0,
                scale: 0.8,
                rotation: -5
            },
            {
                opacity: 1,
                scale: 1,
                rotation: 0,
                duration,
                delay,
                ease: "back.out(1.7)"
            }
        );
    });

    // Floating animation for decorative elements
    Alpine.directive('float', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const amplitude = config.amplitude || 10;
        const duration = config.duration || 3;
        
        gsap.to(el, {
            y: `+=${amplitude}`,
            duration,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
        
        gsap.to(el, {
            rotation: 5,
            duration: duration * 1.5,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    });

    // Parallax effect
    Alpine.directive('parallax', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const speed = config.speed || 0.5;
        
        gsap.to(el, {
            y: () => window.innerHeight * speed,
            ease: "none",
            scrollTrigger: {
                trigger: el,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            }
        });
    });

    // Enhanced hover effects
    Alpine.directive('hover-lift', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const scale = config.scale || 1.05;
        const y = config.y || -8;
        const duration = config.duration || 0.3;
        
        el.addEventListener('mouseenter', () => {
            gsap.to(el, {
                scale,
                y,
                duration,
                ease: "power2.out"
            });
        });
        
        el.addEventListener('mouseleave', () => {
            gsap.to(el, {
                scale: 1,
                y: 0,
                duration,
                ease: "power2.out"
            });
        });
    });

    // Reveal animation with ScrollTrigger
    Alpine.directive('reveal', (el, { expression, modifiers }, { evaluate }) => {
        const config = expression ? evaluate(expression) : {};
        const direction = config.direction || 'up';
        const distance = config.distance || 60;
        const duration = config.duration || 0.8;
        
        let fromVars = { opacity: 0 };
        let toVars = { opacity: 1, duration, ease: "power2.out" };
        
        switch(direction) {
            case 'up':
                fromVars.y = distance;
                toVars.y = 0;
                break;
            case 'down':
                fromVars.y = -distance;
                toVars.y = 0;
                break;
            case 'left':
                fromVars.x = distance;
                toVars.x = 0;
                break;
            case 'right':
                fromVars.x = -distance;
                toVars.x = 0;
                break;
        }
        
        gsap.fromTo(el, fromVars, {
            ...toVars,
            scrollTrigger: {
                trigger: el,
                start: "top 85%",
                toggleActions: "play none none reverse"
            }
        });
    });
}

// Enhanced testimonial animations
export function animateTestimonialTransition(container, newContent) {
    const timeline = gsap.timeline();
    
    // Fade out current content with scale from center
    timeline.to(container, {
        opacity: 0,
        scale: 0.95,
        duration: 0.3,
        ease: "power2.in",
        transformOrigin: "center center"
    })
    // Update content
    .call(() => {
        container.innerHTML = newContent;
    })
    // Fade in new content with zoom from center
    .fromTo(container, 
        { 
            opacity: 0, 
            scale: 0.9,
            transformOrigin: "center center"
        },
        {
            opacity: 1,
            scale: 1,
            duration: 0.5,
            ease: "back.out(1.7)",
            transformOrigin: "center center"
        }
    );
    
    return timeline;
}

// Product image reveal sequence
export function animateProductImages() {
    const timeline = gsap.timeline();
    
    // Animate each product image with stagger
    timeline.fromTo('.product-image', 
        {
            opacity: 0,
            scale: 0.8,
            rotationY: 45,
            transformOrigin: "center center"
        },
        {
            opacity: 1,
            scale: 1,
            rotationY: 0,
            duration: 1,
            stagger: 0.2,
            ease: "back.out(1.7)"
        }
    );
    
    return timeline;
}

// Initialize scroll-triggered animations
export function initScrollAnimations() {
    // Refresh ScrollTrigger on window resize
    window.addEventListener('resize', () => {
        ScrollTrigger.refresh();
    });
    
    // Make animation functions globally available
    window.animateTestimonialTransition = animateTestimonialTransition;
    window.animateProductImages = animateProductImages;
}

// Button interaction animations
export function enhanceButtonInteractions() {
    document.querySelectorAll('[data-animate="button"]').forEach(button => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                scale: 1.05,
                duration: 0.3,
                ease: "power2.out"
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                scale: 1,
                duration: 0.3,
                ease: "power2.out"
            });
        });
        
        button.addEventListener('mousedown', () => {
            gsap.to(button, {
                scale: 0.98,
                duration: 0.1,
                ease: "power2.out"
            });
        });
        
        button.addEventListener('mouseup', () => {
            gsap.to(button, {
                scale: 1.05,
                duration: 0.2,
                ease: "power2.out"
            });
        });
    });
}