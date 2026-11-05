# Countries App

Single-page web εφαρμογή που εμφανίζει όλες τις χώρες του κόσμου μαζί με τις σημαίες τους, σε responsive grid. Η πρόσβαση απαιτεί authentication μέσω Auth0.

## Τεχνολογίες

- **Backend:** Laravel, PHP, Laravel HTTP Client, Laravel Cache
- **Frontend:** Vue 3, Vite
- **Authentication:** Auth0
- **External API:** REST Countries API
- **Containerization:** Docker, Docker Compose

## Αρχιτεκτονική

Το project αποτελείται από δύο ανεξάρτητα applications:

- **Backend:** Ανακτά τα ονόματα των χωρών και τα URLs των σημαιών από το REST Countries API και τα διαθέτει μέσω του `/api/countries`.
- **Frontend:** Ζητά τα δεδομένα από το Laravel backend και εμφανίζει τις χώρες σε responsive grid.
- **Authentication:** Η αυθεντικοποίηση των χρηστών πραγματοποιείται μέσω Auth0. Οι χώρες εμφανίζονται μόνο μετά από επιτυχημένη σύνδεση, ενώ οι μη αυθεντικοποιημένοι χρήστες ανακατευθύνονται στη διαδικασία σύνδεσης του Auth0.
- **Caching:** Τα δεδομένα των χωρών αποθηκεύονται στην Laravel Cache για 6 ώρες, (μέσα στο CountryController).

* CountryProvider: Είναι το interface που ορίζει τη μέθοδο allCountries().

* RestCountriesProvider: Υλοποιεί το CountryProvider και περιέχει τη λογική ανάκτησης των χωρών από το REST Countries API.

* CountryController: Καλεί τη μέθοδο allCountries() μέσω του CountryProvider, ενώ αναλαμβάνει και το caching των αποτελεσμάτων μέσω Cache::remember().

## Προαπαιτούμενα

- Docker Desktop ή Docker Engine
- Docker Compose
- Λογαριασμός Auth0
- REST Countries API key, εφόσον απαιτείται από το API plan

## Ρύθμιση περιβάλλοντος

Πριν από την εκτέλεση:

Δημιούργησε το αρχείο `backend/.env`, αντιγράφοντας το `backend/.env.example`.
Συμπλήρωσε τα απαραίτητα Auth0 credentials, βεβαιώσου ότι υπάρχουν και οι απαραίτητες μεταβλητές περιβάλλοντος.

### Λήψη του project

clone [DimitrisToumpas/countries-app](https://github.com/DimitrisToumpas/countries-app.git)
από τον root φακελο "countries-app"
εκτέλεσε : docker compose build

### Εκκίνηση της εφαρμογής

εκτέλεσε : docker compose up

> **Σημείωση:** Οι παραπάνω διευθύνσεις ισχύουν μέσω Docker Compose. Αν εκτελέσεις την εφαρμογή χωρίς Docker, θα πρέπει να ξεκινήσεις ξεχωριστά το backend (Laravel) και το frontend (Vue/Vite), ακολουθώντας τις αντίστοιχες διαδικασίες εκκίνησης.