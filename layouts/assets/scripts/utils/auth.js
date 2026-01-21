/**
 * LocalStorage key used to store the authentication token.
 * @type {string}
 */
const AUTH_LOCAL_STORAGE_KEY = 'AUTH_TOKEN';

/**
 * Stores the authentication token in LocalStorage.
 *
 * @param {string} token - JWT or auth token received from the backend.
 */
export function setAuthToken(token) {
  localStorage.setItem(AUTH_LOCAL_STORAGE_KEY, token);
}

/**
 * Retrieves the authentication token from LocalStorage.
 *
 * @returns {string|null} The stored auth token or null if not found.
 */
export function getAuthToken() {
  return localStorage.getItem(AUTH_LOCAL_STORAGE_KEY);
}

/**
 * Removes the authentication token from LocalStorage.
 * Typically used during logout.
 */
export function clearAuthToken() {
  localStorage.removeItem(AUTH_LOCAL_STORAGE_KEY);
}