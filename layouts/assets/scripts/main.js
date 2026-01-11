/**
 * Main application entry point
 *
 * This file imports all core components, services, and utility functions,
 * and exposes them globally on the `window` object for easy access
 * in the browser console or inline scripts.
 */

// ============================
// Components
// ============================
import './components/button.js'; // AsyncButton Web Component
import './components/trips.js'; // AsyncTrips Web Component

// ============================
// Services / API layers
// ============================
import * as API from './services/api.js';
import * as AmadeusAPI from './services/apiAmadeus.js';
import * as SupabaseAPI from './services/apiSupabase.js';

// ============================
// Utilities
// ============================
import * as Auth from './utils/auth.js';
import * as ErrorHandler from './utils/errorHandler.js';

// ============================
// Expose globally
// ============================
// This allows debugging or calling functions directly from the browser console
window.API = API;
window.AmadeusAPI = AmadeusAPI;
window.SupabaseAPI = SupabaseAPI;
window.Auth = Auth;
window.ErrorHandler = ErrorHandler;