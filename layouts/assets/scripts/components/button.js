/**
 * AsyncButton Web Component
 *
 * A custom HTML element that represents a button capable of handling
 * asynchronous actions with visual states:
 * - idle
 * - loading
 * - success
 * - error
 *
 * The button can display icons, disable itself during async operations,
 * and automatically reset its state after a configurable delay.
 */

class AsyncButton extends HTMLElement {/**
  * AsyncButton Web Component
  *
  * A custom HTML element that represents a button capable of handling
  * asynchronous actions with visual states:
  * - idle
  * - loading
  * - success
  * - error
  *
  * The button can display icons, disable itself during async operations,
  * and automatically reset its state after a configurable delay.
  */
  state = 'idle';

  /**
   * Timeout reference used to reset the button state.
   * @type {number | null}
   */
  resetTimeout = null;

  /**
   * Initializes default values for the component.
   */
  constructor() {
    super();
    this.state = 'idle';
    this.resetTimeout = null;
  }

  /**
   * Initializes default values for the component.
   */
  connectedCallback() {
    this.render();
  }

  /**
   * Renders the button UI based on the current state and attributes.
   */
  render() {
    const text = this.getAttribute("text") || "";
    const icon = this.getAttribute("icon");
    const iconPos = this.getAttribute("icon-position") || "before";

    let content = `<span>${text}</span>`;
    let iconHtml = '';

    if (this.state === 'loading') {
      iconHtml = '<i class="fas fa-spinner fa-spin"></i>';
    } else if (this.state === 'success') {
      iconHtml = '<i class="fas fa-check"></i>';
    } else if (this.state === 'error') {
      iconHtml = '<i class="fas fa-times"></i>';
    } else if (icon) {
      iconHtml = `<i class="fas ${icon}"></i>`;
    }

    // Place icon before or after text
    if (iconHtml) {
      content = 
        iconPos === 'after'
          ? `<span>${text}</span>${iconHtml}`
          : `${iconHtml}<span>${text}</span>`;
    }

    this.innerHTML = `
      <style>
        button {
          padding: 10px 16px;
          font-size: 14px;
          cursor: pointer;
        }
        button:disabled {
          opacity: 0.6;
          cursor: not-allowed;
        }
        i {
          margin: 0 6px;
        }
      </style>

      <button ${this.state === "loading" ? "disabled" : ""}>
        ${content}
      </button>
    `;

    // Attach click handler
    this.querySelector('button')
      .addEventListener('click', () => this.handleClick());
  }

  /**
   * Handles button click and executes the async function
   * defined in the "on-click" attribute.
   *
   * @returns {Promise<void>}
   */
  async handleClick() {
    const fnName = this.getAttribute('on-click');
    
    // Validate function existence on window
    if (!fnName || typeof window[fnName] !== 'function') {
      return;
    }

    this.setState('loading');

    try {
      await window[fnName]();
      this.setState('success');
    } catch (error) {
      console.error('Custom button error:', error);
      this.setState('error');
      
    }

    this.handleReset();
  }

  /**
   * Resets the button state to 'idle' after a delay,
   * unless the freeze-state attribute is enabled.
   */
  handleReset() {
    const freezeState = (this.getAttribute("freeze-state") || 'false') === "true";
    const freezeTime = parseInt(this.getAttribute('freeze-time') || 3000);

    if (freezeState) {
      return;
    }

    clearTimeout(this.resetTimeout);
    this.resetTimeout = setTimeout(() => {
      this.setState('idle')
    }, freezeTime);
  }

  /**
   * Updates the current state and re-renders the component.
   *
   * @param {'idle' | 'loading' | 'success' | 'error'} state
   */
  setState(state) {
    this.state = state;
    this.render();
  }
}

// Register the custom element
customElements.define("async-button", AsyncButton);