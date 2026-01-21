import { handleError } from './../utils/errorHandler.js';
import { getAuthToken } from './../utils/auth.js';

/**
 * Default request timeout in milliseconds.
 * @type {number}
 */
const DEFAULT_TIMEOUT = 10_000;

/**
 * Sends an AJAX API request with optional authentication,
 * timeout handling, and PHP-compatible payload support.
 *
 * @param {Object} options - API request configuration.
 * @param {string} options.url - Target endpoint URL.
 * @param {string} [options.method='POST'] - HTTP method.
 * @param {Object|string|null} [options.data=null] - Request payload.
 * @param {Object} [options.headers={}] - Additional HTTP headers.
 * @param {number} [options.timeout=DEFAULT_TIMEOUT] - Request timeout in ms.
 * @param {boolean} [options.auth=true] - Whether to attach auth token.
 * @param {string} [options.context='generic'] - Context identifier for error handling.
 * @param {boolean} [options.phpMode=false] - Enable x-www-form-urlencoded payload.
 *
 * @returns {Promise<{success: boolean, data: any, context: string}>}
 */
export async function apiRequest({
  url,
  method = 'POST',
  data = null,
  headers = {},
  timeout = DEFAULT_TIMEOUT,
  auth = true,
  context = "generic",
  phpMode = false
}) {
  // Attach Authorization header if authentication is enabled
  if (auth) {
    const token = getAuthToken();
    if (token) {
      headers['Authorization'] = `Bearer ${token}`;
    }
  }

  let ajaxData = null;
  let contentType = undefined;
  
  // Prepare request payload and content type
  if (data) {
    if (phpMode) {
      // PHP-compatible form encoding
      ajaxData = typeof data === 'object' ? $.param(data) : data;
      contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
    } else {
      // JSON payload
      ajaxData = typeof data === 'object' ? JSON.stringify(data) : data;
      contentType = 'application/json; charset=UTF-8';
    }
  }

  return new Promise((resolve, reject) => {
    // Manual timeout handling
    const abortTimeout = setTimeout(() => {
      reject({ type: 'timeout', message: 'Request timed out', context });
    }, timeout);

    $.ajax({
      url,
      method,
      data: ajaxData,
      contentType,
      headers,
      /**
       * Successful HTTP response handler.
       *
       * @param {*} response - Response data from the server.
       */
      success: function(response) {
        clearTimeout(abortTimeout);
        resolve({ success: true, data: response, context });
      },
      /**
       * HTTP error handler.
       *
       * @param {jqXHR} jqXHR - jQuery XHR object.
       * @param {string} textStatus - Status text.
       * @param {string} errorThrown - Thrown error message.
       */
      error: function(jqXHR, textStatus, errorThrown) {
        clearTimeout(abortTimeout);
        const errorObject = {
          type: 'http',
          status: jqXHR.status,
          message: jqXHR.responseJSON?.message || errorThrown || textStatus,
          context
        };
        handleError(errorObject);
        reject(errorObject);
      }
    });
  });
}
