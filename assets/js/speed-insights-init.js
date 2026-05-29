/* =========================================================
VERCEL SPEED INSIGHTS INITIALIZATION
========================================================= */

/**
 * Initialize Vercel Speed Insights
 * This script loads and initializes the Vercel Speed Insights
 * to track web vitals and performance metrics.
 */

(function() {
    'use strict';
    
    // Load the Speed Insights module dynamically
    // Using the production script from Vercel's CDN
    const script = document.createElement('script');
    script.src = 'https://va.vercel-scripts.com/v1/speed-insights/script.js';
    script.defer = true;
    script.dataset.sdkn = '@vercel/speed-insights';
    script.dataset.sdkv = '1.3.1';
    
    // Initialize the queue for Speed Insights
    if (!window.si) {
        window.si = function() {
            (window.siq = window.siq || []).push(arguments);
        };
    }
    
    // Inject the script into the document head
    document.head.appendChild(script);
    
    // Optional: Log initialization in development
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        console.log('[Speed Insights] Initialized for development');
    }
})();
