# Aggregator of Travelling System – Backend (Django, Windows)

Ez a dokumentum leírja, hogyan lehet a Django alapú backendet **nulláról** lokálisan futtatni **Windows** környezetben.
---

## 1. Előfeltételek

A következő szoftvereknek telepítve kell lenniük:

### Kötelező
- **Python 3.10 vagy újabb**
- Powershell

### Ellenőrzés (PowerShell)
python --version


## 2. Futtatás

### Virtuális környezet létrehozása
python -m venv venv

### Virtuális környezet aktiválása
venv\Scripts\Activate.ps1

### Python csomagok telepítése
python -m pip install --upgrade pip
pip install -r requirements.txt


### Indítás
python manage.py runserver 8000