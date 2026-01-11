<h1>Async-button</h1>

<h2>Default Button + Icon</h2>

<async-button
  text="Button"
  icon="fa-save"
></async-button>

<h2>Icon Position</h2>

<async-button
  text="Before"
  icon="fa-save"
  on-click="saveData">
</async-button>

<async-button
  text="After"
  icon="fa-trash"
  icon-position="after"
  on-click="deleteData">
</async-button>

<h2>Freeze State</h2>

<async-button
  text="Freeze State"
  icon="fa-trash"
  icon-position="after"
  on-click="deleteData"
  freeze-state="true"
>
</async-button>

<h2>Freeze Time</h2>

<async-button
  text="Freeze Time"
  icon="fa-trash"
  icon-position="after"
  on-click="deleteData"
  freeze-time="8000"
>
</async-button>

<h2>API TEST</h2>

<async-button
  text="API Get method test"
  icon="fa-trash"
  icon-position="after"
  on-click="fetchApiData"
  freeze-time="8000"
>
</async-button>

<async-button
  text="API Post method test"
  icon="fa-trash"
  icon-position="after"
  on-click="postApiData"
  freeze-time="8000"
>
</async-button>

<script>
  async function saveData() {
    const res = await fetch("save.php", { method: "POST" });
    if (!res.ok) throw new Error("Hiba");
  }

  async function deleteData() {
    await new Promise(r => setTimeout(r, 1500));
  }

  async function fetchApiData() {
    try {
      const response = await window.API.apiRequest({
        url: '?page=api',
        method: 'GET',
        context: 'fetchApiData'
      });
      console.log('Sikeres GET válasz:', response.data);
    } catch(error) {
      console.error('Hiba GET kérésnél:', error);
    }
  }

  async function postApiData() {
    try {
      const response = await window.API.apiRequest({
        url: '?page=api',
        type: 'POST',
        data: { name: 'Tom', age: 30, action: 'register' },
        phpMode: true
      });
      console.log('Sikeres POST válasz:', response.data);
    } catch (error) {
      console.error('Hiba POST kérésnél:', error);
    }
  }
</script>