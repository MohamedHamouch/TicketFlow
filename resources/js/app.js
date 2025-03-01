import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Dropdown Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeUserMenu();
    initializeMobileMenu();
});

function initializeUserMenu() {
    const userMenuButton = document.querySelector('.user-menu-button');
    const userMenuItems = document.querySelector('.user-menu-items');

    if (userMenuButton && userMenuItems) {
        // Toggle dropdown on button click
        userMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            userMenuItems.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenuItems.contains(event.target)) {
                userMenuItems.classList.add('hidden');
            }
        });

        // Handle keyboard navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                userMenuItems.classList.add('hidden');
            }
        });
    }
}

function initializeMobileMenu() {
    const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });
    }
}