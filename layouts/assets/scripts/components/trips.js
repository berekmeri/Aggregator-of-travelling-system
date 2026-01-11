/**
 * AsyncTrips Web Component
 *
 * A custom HTML element that fetches trip data from an API and renders
 * a list of trip cards with visual loading and error states.
 *
 */
class AsyncTrips extends HTMLElement {
  state = 'idle'; // Current state of the component: idle | loading | success | error
  tripsData = []; // Array to store fetched trip data

  // Constructor initializes API URL from attribute or default.
  constructor() {
    super();
    this.apiUrl = this.getAttribute('api-url') || '?page=api&action=trips';
  }
  
  /**
   * Called when the component is added to the DOM.
   * Renders the initial state and starts fetching trip data.
   */
  connectedCallback() {
    this.render();
    this.loadTrips();
  }

  // Renders the component based on the current state.
  render() {
    let content = '';

    // Render loading state
    if (this.state === 'loading') {
      content = '<div class="trips-loading"><i class="fas fa-spinner fa-spin"></i> Betöltés...</div>';
    }
    // Render error state
    else if (this.state === 'error') {
      content = '<div class="trips-error">Hiba történt az adatok betöltésekor!</div>';
    }
    // Render success state with trips
    else if (this.state === 'success') {
      content = this.tripsData.map(trip => `
        <article class="trip-card">
          <header class="trip-card-header">
            <div>
              <h2>${trip.destination}</h2>
              <p class="trip-card-subtitle">${trip.from} – ${trip.to}</p>
            </div>
            <div class="trip-card-price">
              <span>Összesen</span>
              <strong>${trip.price.toLocaleString()} Ft</strong>
            </div>
          </header>

          <div class="trip-card-summary">
            <div class="trip-summary">
              <i class="fa-solid fa-plane"></i>
              <div>
                <strong>${trip.flight.provider}</strong>
                <p>${trip.flight.from} → ${trip.flight.to}<br>
                ${trip.flight.departure} – ${trip.flight.arrival}</p>
              </div>
            </div>

            <div class="trip-summary">
              <i class="fa-solid fa-hotel"></i>
              <div>
                <strong>${trip.hotel.name}</strong>
                <p>${trip.hotel.nights} éjszaka · ${trip.hotel.extras.join(', ')}</p>
              </div>
            </div>
          </div>
        </article>
      `).join('');
    }
    
    // Set inner HTML including styles
    this.innerHTML = `
      <style>
        .trips-loading, .trips-error {
          text-align: center;
          padding: 2rem;
          font-weight: 500;
          color: #2563eb;
        }

        .trip-card {
          background: #ffffff;
          border-radius: 12px;
          padding: 1.5rem;
          box-shadow: 0 8px 20px rgba(0,0,0,0.06);
          margin-bottom: 1rem;
        }

        .trip-card-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .trip-card-subtitle {
          color: #6b7280;
          font-size: 0.9rem;
        }

        .trip-card-price span {
          display: block;
          font-size: 0.8rem;
          color: #6b7280;
        }

        .trip-card-price strong {
          font-size: 1.4rem;
          color: #2563eb;
        }

        .trip-card-summary {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 1rem;
          margin-top: 1rem;
        }

        .trip-summary {
          display: flex;
          gap: 0.5rem;
        }

        .trip-summary i {
          font-size: 1.5rem;
          color: #2563eb;
          margin-top: 0.2rem;
        }
      </style>

      ${content}
    `;
  }

  // Fetches trip data from the API and updates state accordingly.
  async loadTrips() {
    this.setState('loading'); // Set loading state

    try {
      const response = await fetch(this.apiUrl);
      if (!response.ok)
        throw new Error('Network error!'); // Throw error on network failure
      
      const data = await response.json();
      this.tripsData = data.data || []; // Store trips
      this.setState('success'); // Set success state
    } catch (err) {
      console.error('Trips API error:', err);
      this.setState('error'); // Set error state
    }
  }

  /**
   * Updates the current state and triggers a re-render.
   * 
   * @param {'idle' | 'loading' | 'success' | 'error'} state
   */
  setState(state) {
    this.state = state;
    this.render();
  }
}

// Define custom element
customElements.define('async-trips', AsyncTrips);
