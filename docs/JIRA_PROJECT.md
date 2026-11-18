# JIRA-PROJEKTI DOKUMENTATSIOON: AUTOKOOL DRIVEPRO (VÕTI: AK)

Dokument kirjeldab Jira projekti struktuuri, eepikaid (Epics), kasutajalugusid (User Stories), alamülesandeid (Tasks), hinnanguid (Story Points), komponente ja vastuvõtukriteeriume (Acceptance Criteria).

---

## 1. Projekti Üldandmed ja Seadistus

- **Projekti nimi:** Autokool DrivePro Veebiportaal
- **Projekti võti (Key):** `AK`
- **Metoodika:** Scrum / Kanban
- **Sprindi pikkus:** 2 nädalat (kokku 3 sprinti)
- **Projekti tüüp:** Software Development (PHP MVC Web Application)
- **Komponendid:** `Database`, `Backend`, `Frontend`, `Admin`, `Localization`, `Docs`

---

## 2. Eepikad (Epics) ja Struktuur

| Epic Key | Eepika Nimetus | Kirjeldus | Prioriteet | Komponent |
| :--- | :--- | :--- | :--- | :--- |
| **AK-E1** | **Andmebaasi ja Domeeni Migratsioon** | NewsPortali malli täielik ümberkujundamine Autokooli domeenile (tabelid, mudelid, kontrollerid). | Kõrgeim (Highest) | Database, Backend |
| **AK-E2** | **Kohanduv Disain ja Dünaamiline UI** | Responsive disain (mobiil, tahvel, desktop), CSS animatsioonid ja interaktiivne JS. | Kõrge (High) | Frontend |
| **AK-E3** | **Koolituste Kataloog ja Reaalajas Otsing** | Kursuste kuvamine kaartidena, kategooriate filter ja JS reaalajas otsinguriba. | Keskmine (Medium) | Frontend, Backend |
| **AK-E4** | **Interaktiivne Hinnakalkulaator** | Dünaamiline kalkulaator lisatundide liuguri ja lisamoodulite reaalajas arvutamiseks. | Keskmine (Medium) | Frontend |
| **AK-E5** | **Registreerimine ja Avaldused** | Kiire registreerumine modaalaknas, valideerimine ja täielik kasutajate registreerimine. | Kõrge (High) | Backend, Frontend |
| **AK-E6** | **Tagasiside ja Arvustuste Süsteem** | Kursusepõhised hinnangud (1-5 tärni) ja kommentaaride lisamine õpilaste poolt. | Madal (Low) | Backend |
| **AK-E7** | **Administratiivne Juhtpaneel (Admin CRUD)**| Administraatori liides kursuste lisamiseks, muutmiseks, kustutamiseks ja avalduste vaatamiseks. | Kõrge (High) | Admin |
| **AK-E8** | **Kakskeelsuse Tugi (ET / RUS)** | Veebisaidi täielik kakskeelsus: eesti ja vene keel päise lülitiga (`?lang=et` / `?lang=ru`). | Kõrge (High) | Localization |
| **AK-E9** | **Standarditele Vastav Dokumentatsioon** | ISO-29148 spetsifikatsioon, ISO-26514 kasutusjuhend ning disainimaketid. | Kõrge (High) | Docs |

---

## 3. Kasutajalood (User Stories), Ülesanded (Tasks) ja Vastuvõtukriteeriumid

### Epic AK-E1: Andmebaasi ja Domeeni Migratsioon
#### AK-1: Andmebaasi struktuuri loomine autokooli teemale
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** Highest | **Komponent:** Database
- **Kirjeldus:** Administraatori ja arendajana soovin, et andmebaas kannaks nime `autokool` ning tabelid peegeldaksid autokooli domeeni (`courses`, `categories`, `reviews`, `registrations`, `users`), et vabaneda NewsPortali jäänustest.
- **Acceptance Criteria:**
  - [x] Andmebaas on `autokool` UTF-8 toega (`utf8mb4_unicode_ci`).
  - [x] NewsPortali tabelid (`news`, `comments`) on täielikult eemaldatud.
  - [x] Loodud on tabelid `courses`, `categories`, `reviews`, `registrations`, `users`.
  - [x] Välisvõtmed (Foreign Keys) ja indeksid seovad kursused kategooriate ja kasutajatega.

#### AK-2: Puhas UTF-8 andmebaasi tõmmis ilma BOM-ita
- **Tüüp:** Task | **Story Points:** 3 | **Prioriteet:** High | **Komponent:** Database
- **Kirjeldus:** Luua `autokool.sql` skript, mis impordib puhtalt phpMyAdminisse ilma staatilise analüüsi vigadeta (ilma UTF-16LE või UTF-8 BOM baitideta).
- **Acceptance Criteria:**
  - [x] Fail algab ASCII kommentaariga `-- ` ilma BOM-ita (esimesed baidid `2D 2D 20`).
  - [x] phpMyAdmin impordib faili 0 veateatega.
  - [x] Lisatud on valmis algandmed: 5 kategooriat ja 7 reaalset kursust (A, B manuaal/automaat, C, lõppaste, esmaabi).

#### AK-3: PHP Mudelite refaktoorimine MVC arhitektuuris
- **Tüüp:** Task | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Backend
- **Kirjeldus:** Asendada vana NewsPortali mudelid uute klassidega: `Course.php`, `Category.php`, `Review.php`, `Enrollment.php`, `Register.php`.
- **Acceptance Criteria:**
  - [x] Kõik andmebaasipäringud teostatakse läbi `Database` klassi ja PDO ühenduse.
  - [x] SQL süstimise (SQL Injection) vastane kaitse ja tüüpide teisendamine (`intval`, `floatval`).

---

### Epic AK-E2: Kohanduv Disain ja Dünaamiline UI
#### AK-4: Responsive küljendus ja mobiilivaade
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Frontend
- **Kirjeldus:** Nutitelefoni kasutajana soovin, et autokooli veebileht avaneks mugavalt mobiilis (responsive), menüü oleks kokkupandav ja kaardid loetavad ekraanidel 320px kuni 1920px.
- **Acceptance Criteria:**
  - [x] Viewport meta-tag on määratud (`width=device-width, initial-scale=1`).
  - [x] Bootstrap ruudustik kohandub automaatselt (1 veerg mobiilis, 2 tahvlis, 3 töölaual).
  - [x] Mobiilimenüü töötab "hamburger" nupuga.

#### AK-5: Kaartide CSS efektid ja visuaalne hierarhia
- **Tüüp:** Story | **Story Points:** 3 | **Prioriteet:** Medium | **Komponent:** Frontend
- **Kirjeldus:** Külastajana soovin kaasaegset ja professionaalset visuaalset kogemust kaarditõstete, sujuvate üleminekute ja kleebistega.
- **Acceptance Criteria:**
  - [x] Kursusekaartidel on CSS `transform: translateY(-5px)` ja kasti varju efekt (`box-shadow`) hiirega peale liikumisel.
  - [x] Hinnasildid on esile tõstetud kollase aktsendiga (`#f39c12`).

---

### Epic AK-E3: Koolituste Kataloog ja Reaalajas Otsing
#### AK-6: Kategooriate järgi filtreerimine
- **Tüüp:** Story | **Story Points:** 3 | **Prioriteet:** High | **Komponent:** Backend
- **Kirjeldus:** Külastajana soovin filtreerida kursusi kategooria järgi (A, B, C, erikoolitused).
- **Acceptance Criteria:**
  - [x] Kategooriate rippmenüü päises kuvab aktiivsed kategooriad andmebaasist.
  - [x] Valitud kategooria kuvab ainult vastavaid kursuseid.

#### AK-7: Reaalajas otsing (JS Live Search)
- **Tüüp:** Story | **Story Points:** 3 | **Prioriteet:** Medium | **Komponent:** Frontend
- **Kirjeldus:** Külastajana soovin kursuste lehel kohest reaalajas otsingut nime ja kirjelduse järgi ilma lehe taaslaadimiseta.
- **Acceptance Criteria:**
  - [x] Klaviatuurilt trükkides peidab JavaScript mittevastavad kaardid koheselt.
  - [x] Kui vastuseid ei leidu, kuvatakse viisakas teade "Ühtegi kursust ei leitud".

---

### Epic AK-E4: Interaktiivne Hinnakalkulaator
#### AK-8: Dünaamiline koolituse hinna ja osamaksete kalkulaator
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** Medium | **Komponent:** Frontend
- **Kirjeldus:** Tulevase õpilasena soovin interaktiivset kalkulaatorit `/calculator`, kus saan valida baaskursuse, lisatundide arvu liuguriga (slider) ja lisamoodulid ning näha koheselt kogusummat ja osamakseid.
- **Acceptance Criteria:**
  - [x] Reaalajas arvutamine JavaScripti abil ilma lehe taaslaadimiseta.
  - [x] Lisatundide liugur (slider 0-20 tundi, 35 €/tund) uuendab hinda koheselt.
  - [x] Märkeruudud (libedasõit 85€, pimedasõit 60€, esmaabi 50€) liidetakse summale.
  - [x] Kuvatav 4 osamakse arvutus.
  - [x] Nupp "Registreeru selle paketiga" suunab valitud andmetega registreeruma.

---

### Epic AK-E5: Registreerimine ja Avaldused
#### AK-9: Kiire registreerumise modaalaken (Quick Enroll Modal)
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Frontend
- **Kirjeldus:** Külastajana soovin registreeruda kursusele ühe klõpsuga avanevast modaalpopUp-aknast igalt kursusekaardilt.
- **Acceptance Criteria:**
  - [x] Modaalaken avaneb kursuse kaardil klõpsates "Kiirregistreerimine".
  - [x] Kursuse valik ja nimetus on eeltäidetud.
  - [x] Sisestatud andmed (eesnimi, perekonnanimi, isikukood, e-post, telefon) valideeritakse ja salvestatakse tabelisse `registrations`.
  - [x] Kasutajale kuvatakse õnnestumise kinnitusteade (Flash alert).

#### AK-10: Kasutajakonto registreerimine ja turvalisus
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** Medium | **Komponent:** Backend
- **Kirjeldus:** Kasutajana soovin registreerida isikliku konto portaalis.
- **Acceptance Criteria:**
  - [x] Paroolid räsitakse tööstusstandardi algoritmiga `password_hash($pass, PASSWORD_DEFAULT)` (Bcrypt).
  - [x] E-posti unikaalsuse kontroll andmebaasis.

---

### Epic AK-E7: Administratiivne Juhtpaneel (Admin CRUD)
#### AK-12: Administraatori autentimine
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Admin
- **Kirjeldus:** Autokooli omanikuna soovin parooliga kaitstud ligipääsu administreerimisele aadressil `/admin`.
- **Acceptance Criteria:**
  - [x] Ligipääsukontroll sessiooni baasil (`$_SESSION['status'] == 'admin'`).
  - [x] Volitamata kasutaja suunatakse sisselogimise vormile.

#### AK-13: Kursuste haldus (CRUD) ja piltide laadimine
- **Tüüp:** Story | **Story Points:** 8 | **Prioriteet:** High | **Komponent:** Admin
- **Kirjeldus:** Administraatorina soovin kursusi lisada, muuta ja kustutada ning lisada pildi otse failist.
- **Acceptance Criteria:**
  - [x] Täielik CRUD (Create, Read, Update, Delete) koolitustele.
  - [x] Pildi laadimine binaarkujul (`MEDIUMBLOB`) andmebaasi.
  - [x] Mõlema keele (ET ja RU) pealkirjade, kirjelduste ja parameetrite samaaegne toimetamine.

#### AK-14: Laekunud avalduste nimekiri
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** Medium | **Komponent:** Admin
- **Kirjeldus:** Administraatorina soovin vaadata kõiki laekunud avaldusi ühes tabelis kontaktide ja ajatemplitega.
- **Acceptance Criteria:**
  - [x] Tabel `/admin/registrationsAdmin` kuvab kursuse nime, kandideerija nime, isikukoodi, telefoni, e-posti ja kuupäeva.

---

### Epic AK-E8: Kakskeelsuse Tugi (ET / RUS)
#### AK-15: Keelevaliku lüliti päises (EST | RUS)
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Localization
- **Kirjeldus:** Külastajana soovin lehe ülaservas ühe klõpsuga vahetada keelt eesti ja vene keele vahel, säilitades hetkel vaadatava alamlehe ja parameetrid.
- **Acceptance Criteria:**
  - [x] Päises asuvad lingid `EST` ja `RUS`. Aktiivne keel on esile tõstetud `.active-lang`.
  - [x] Keel salvestatakse PHP sessiooni `$_SESSION['lang']`.
  - [x] URL parameeter `?lang=ru` või `?lang=et` uuendab sessiooni ja suunab sujuvalt tagasi.

#### AK-16: Kasutajaliidese tõlkesüsteem (UI Dictionary)
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Localization
- **Kirjeldus:** Arendajana soovin mugavat `__('võti')` abifunktsiooni, mis tagastab teksti aktiivses keeles.
- **Acceptance Criteria:**
  - [x] Loodud `inc/Lang.php` koos initsialiseerimise ja tõlkefunktsiooniga `__($key)`.
  - [x] Tõlkefailid `lang/et.php` ja `lang/ru.php` katavad 100% kasutajaliidese tekstidest.

#### AK-17: Dünaamilise andmebaasi sisu lokaliseerimine
- **Tüüp:** Story | **Story Points:** 5 | **Prioriteet:** High | **Komponent:** Localization
- **Kirjeldus:** Külastajana soovin, et ka kursuste nimed, kirjeldused, kestused ja kategooriad oleksid valitud keeles.
- **Acceptance Criteria:**
  - [x] Tabelites `courses` ja `categories` on eraldi veerud `_et` ja `_ru`.
  - [x] SQL päringutes kasutatakse dünaamilist `CASE WHEN '$lang' = 'ru' THEN ... ELSE ... END AS title`, vältides vaadete (views) dubleerimist.

---

## 4. Jira Impordi Juhend (CSV External System Import)

Kogu see backlog on ette valmistatud ja asub projektis failina:
`docs/jira_import_autokool.csv`

### Sammud Jira pilveversioonis (Jira Cloud) või kooli Jira serveris:
1. Logi sisse Jiras oma kontoga.
2. Vali ülevalt paremalt **Settings (Hammasratas)** -> **System**.
3. Vasakult menüüst vali **External System Import** -> **CSV**.
4. Vali fail `docs/jira_import_autokool.csv`.
5. Vali projektiks olemasolev projekt (või loo uus projekt võtmega `AK`).
6. Väljade vastendamine (Field Mapping):
   - `Issue Type` -> **Issue Type**
   - `Issue key` -> **Issue Key**
   - `Summary` -> **Summary**
   - `Description` -> **Description**
   - `Priority` -> **Priority**
   - `Story Points` -> **Story Points**
   - `Epic Link` -> **Epic Link**
   - `Component` -> **Component/s**
7. Klõpsa **Begin Import**. Kõik eepikad, lood ja ülesanded luuakse automaatselt koos linkidega!

---

## 5. Sprindijaotus ja Rollid

| Sprint | Fookus | Eepikad ja Lood | Tulemus |
| :--- | :--- | :--- | :--- |
| **Sprint 1 (2 näd)** | DB migratsioon & Küljendus | AK-E1 (AK-1, AK-2, AK-3), AK-E2 (AK-4, AK-5) | Töötav Autokooli MVC skeem, andmebaas, responsiivne esileht |
| **Sprint 2 (2 näd)** | Funktsionaalsus & JS efektid | AK-E3 (AK-6, AK-7), AK-E4 (AK-8), AK-E5 (AK-9, AK-10) | Kataloog, live search, hinnakalkulaator, avalduste salvestamine |
| **Sprint 3 (2 näd)** | Admin, Kakskeelsus & Dokumendid | AK-E7 (AK-12..14), AK-E8 (AK-15..17), AK-E9 (AK-18..20) | Admin CRUD, EST/RUS tugi, ISO dokumentatsioon, lõpptestimine |
