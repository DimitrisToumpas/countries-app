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

## ...
