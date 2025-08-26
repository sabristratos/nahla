import './bootstrap';
import { initAnimationDirectives, initScrollAnimations, enhanceButtonInteractions } from './animations';
import anchor from '@alpinejs/anchor';

// Register Alpine.js plugins before Alpine starts
Alpine.plugin(anchor);

// Initialize animation directives
initAnimationDirectives(Alpine);

// Initialize animations when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initScrollAnimations();
    enhanceButtonInteractions();
});
