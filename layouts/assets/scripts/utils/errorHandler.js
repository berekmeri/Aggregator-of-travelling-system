/**
 * Handles and normalizes API-related errors.
 * Logs technical details and displays a user-friendly message.
 *
 * @param {Object} error - Error object describing the failure.
 * @param {string} error.type - Error category (timeout, http, network, parse).
 * @param {number} [error.status] - HTTP status code (if applicable).
 * @param {string} [error.message] - Technical or backend-provided message.
 * @param {string} [error.context] - Context identifier of the failed operation.
 */
export function handleError(error) {
  // Log full error details for debugging
  console.error(`[API ERROR - ${error.context}]`, error);

  let message = 'An error occurred!';

  switch(error.type) {
    case 'timeout':
      message = 'The request timed out.';
      break;
    case 'http':
      if(error.status >= 500) {
        message = 'Server error, please try again later.';
      } else if(error.status === 401) {
        message = 'You are not eligible. Please log in.';
      } else if(error.status === 403)  {
        message = 'Access denied.';
      } else if(error.status === 404)  {
        message = 'The requested resource was not found.';
      } else  {
        message = error.message || 'Unknown HTTP error.';
      }
      break;
    case 'network':
      message = 'Network error, check your internet connection.';
      break;
    case 'parse':
      message = 'Response processing failed.';
      break;
  }

  /**
   * @todo Replace alert with a global notification system
   * (toast, snackbar, modal, etc.)
   */
  alert(message);
}
