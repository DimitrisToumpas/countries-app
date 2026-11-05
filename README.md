# Countries App

Μια μικρή single-page web εφαρμογή που εμφανίζει όλες τις χώρες του κόσμου μαζί με τις σημαίες τους, σε responsive grid. Η πρόσβαση στην εφαρμογή απαιτεί authentication μέσω Auth0.


## Τεχνολογίες

- **Backend:** Laravel (PHP), Laravel HTTP client, Laravel Cache
- **Frontend:** Vue 3, Vite, Tailwind CSS
- **Authentication:** Auth0 (`@auth0/auth0-vue` στο frontend, επαλήθευση JWT στο backend)
- **Εξωτερική πηγή δεδομένων:** REST Countries API

## Δομή του project

Το repository περιέχει δύο ανεξάρτητα projects, ένα για τον server και ένα για τον client

## Πως δουλεύει 

Το backend (Laravel) παίρνει τα ονόματα των χωρών και τα URLs των σημαιών από το [REST Countries API](https://restcountries.com/) και τα σερβίρει μέσω του δικού του JSON endpoint. Το frontend (Vue.js) καλεί αυτό το endpoint και εμφανίζει το grid.

Vue (frontend)
   ↓ ζητάει /api/countries
CountryController
   ↓ ζητάει τις χώρες από το interface
CachedCountryProvider  →  αν υπάρχουν στη cache, τις δίνει
   ↓ αλλιώς
RestCountriesProvider  →  τις φέρνει από το restcountries.com

## Εγκατάσταση και εκτέλεση

### Προαπαιτούμενα

- PHP 8.2 ή νεότερο και Composer
- Node.js (LTS ή νεότερο) και npm
- Δωρεάν API key από το [REST Countries](https://restcountries.com/sign-up)

### Backend (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Στο αρχείο `backend/.env` συμπλήρωσε το API key:

```
RESTCOUNTRIES_API_KEY=το_κλειδί_σου (https://restcountries.com/sign-up)
RESTCOUNTRIES_BASE_URL=https://api.restcountries.com/countries/v5
```

Το αρχείο `.env` δεν ανεβαίνει στο repository. Γι' αυτό υπάρχει το `.env.example`, που δείχνει ποιες μεταβλητές χρειάζονται.

Εκκίνηση του server:

```bash
php artisan serve
```

Το backend τρέχει στο `http://localhost:8000` και το endpoint είναι το `http://localhost:8000/api/countries`.

### Frontend (Vue)

Σε δεύτερο τερματικό:

```bash
cd frontend
npm install
npm run dev
```

Το frontend τρέχει στο `http://localhost:5173`.

### Σημείωση για το εξωτερικό API

Το δωρεάν πακέτο του REST Countries επιστρέφει το πολύ 100 χώρες ανά αίτημα, οπότε ο provider ζητά τη λίστα σε σελίδες. Το αποτέλεσμα αποθηκεύεται στη cache για 24 ώρες, ώστε το API να μην καλείται σε κάθε επίσκεψη και να μην εξαντλείται το μηνιαίο όριο αιτημάτων.
