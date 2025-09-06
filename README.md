# Turistička Agencija – Seminarski Rad

**GitHub:** https://github.com/elab-development/serverske-veb-tehnologije-2024-25-domaci_turisticka_agencija/tree/Domaci_Turisticka_Agencija-2

##  Uvod
Ovo je backend REST API aplikacija za turističku agenciju, izrađena u okviru seminarskog rada iz predmeta *Serverske Veb Tehnologije*. Aplikacija omogućava registraciju korisnika, pregled i upravljanje destinacijama, aranžmanima, rezervacijama i promocijama (akcijama). Koristi Laravel framework.

##  Tehnološki Stack
- PHP 8.x, Laravel 10.x  
- MySQL baza podataka  
- Laravel Sanctum za autentifikaciju (token-based)  
- Storage (uploads) i export CSV  
- Vanjski REST API: OpenWeather za vremensku prognozu

##  Pokretanje projekta
1. Klonirajte repozitorijum:
   ```bash
   git clone https://github.com/elab-development/serverske-veb-tehnologije-2024-25-domaci_turisticka_agencija.git
   cd serverske-veb-tehnologije-2024-25-domaci_turisticka_agencija
   git checkout Domaci_Turisticka_Agencija-2

Instalirajte zavisnosti:

composer install
cp .env.example .env
php artisan key:generate


Podesite .env (DB, OpenWeather API ključ)

Pokrenite migracije i seed:

php artisan migrate --seed


Pokrenite lokalni server:

php artisan serve


Dostupno na http://127.0.0.1:8000

Korisničke uloge
Uloga	Ovlašćenja
Gost	Pregled promocija, destinacija, aranžmana
Registrovan korisnik	Može praviti rezervacije
Admin	Full CRUD nad korisnicima, destinacijama, etc.
API Endpoints
Autentifikacija

POST /api/register – Registracija

POST /api/login – Prijavljivanje

POST /api/logout – Odjava (token-based)

Promena lozinke

POST /api/user/change-password (autorizovano)

Destinacije

GET /api/destinacije – Sve destinacije

POST /api/destinacije – Dodavanje (admin)

PUT /api/destinacije/{id} – Ažuriranje (admin)

DELETE /api/destinacije/{id} – Brisanje (admin)

GET /api/destinacije/{id}/weather – Vremenska prognoza (OpenWeather)

Aranžmani

GET /api/aranzmani – Prikaz (paginacija)

GET /api/aranzmani/search?..., /filter, /lastminute, /akcije – Napredna pretraga/filteri

POST /api/aranzmani – Kreiranje (admin)

PUT /api/aranzmani/{id}, DELETE /api/aranzmani/{id} – Administracija

Upload fajlova (slike aranžmana)

Uslov u store metodi za aranžmane (slika polje u form-data)

Export podataka

GET /api/aranzmani/export/csv – Export svih aranžmana u CSV (admin)

Rezervacije (ulogovani korisnik)

GET /api/rezervacije, POST /api/rezervacije, PUT /api/rezervacije/{id}, DELETE /api/rezervacije/{id}

Akcije (promocije)

GET /api/akcije – Pregled svih promocija

CRUD dostupno samo adminu: POST, PUT, DELETE

Ping test

GET /api/ping → „pong“

Dodatne funkcionalnosti

Paginacija, pretraga, filteri, upload fajlova, export, keširanje

Turistička prognoza preko OpenWeather API

(Predloženo) Currency API za konverziju cena između EUR/RSD – može implementiratiš ako želiš još jedan javni API

Sigurnosne mere

bcrypt za lozinke

Kamin za rate limiting (throttle:api)

Validacije polja sa povratnim JSON porukama

Uputstvo za testiranje (Postman)

Register → Login → preuzmi token

Dodaj Authorization: Bearer {token}

Test REST API: destinacije, aranžmani, rezervacije, akcije (admin)

Test upload (form-data + fajl)

Test export — CSV fajl odgovara listi aranžmana

Test weather endpoint

Git & Komitovi

Minimum 20 smislenih komitova, uključujući i domaće zadatke

Projekat je javnosti dostupan (public repo)

Autor

Ime i prezime: Marko Stamenković

Seminarski rad – jesen 2025.