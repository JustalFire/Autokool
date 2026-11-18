# AUTOKOOLI VEEBIPORTAALI KASUTUSJUHEND
## Standard: ISO/IEC/IEEE 26514:2022 (Requirements for Designers and Developers of Information for Users)
### Süsteem: DrivePro Autokool Veebirakendus (PHP MVC)

---

## 1. Sissejuhatus ja Paigaldusjuhend (System Setup & Installation)

### 1.1 Süsteeminõuded
- **Veebiserver:** Apache 2.4+ koos sisselülitatud `mod_rewrite` mooduliga (nt XAMPP, WAMP, LAMP või MAMP).
- **PHP versioon:** PHP 8.0 või uuem (testitud PHP 8.2 peal, vajalik PDO ja pdo_mysql tugi).
- **Andmebaas:** MySQL 5.7+ või MariaDB 10.4+.
- **Veebibrauser:** Google Chrome, Mozilla Firefox, Microsoft Edge, Safari (nii lauaarvutil kui mobiilil).

### 1.2 Kiirpaigaldus XAMPP keskkonnas
1. **Projekti paigutamine:**
   Kopeerige kaust `Autokool-master` oma XAMPP veebijuure kataloogi, näiteks:
   `C:\xampp\htdocs\autokool`
2. **Andmebaasi loomine ja import:**
   - Avage brauseris **phpMyAdmin** (`http://localhost/phpmyadmin` või `http://localhost:81/phpmyadmin`).
   - Looge uus andmebaas nimega: **`autokool`** (kodeering: `utf8mb4_unicode_ci`).
   - Valige loodud andmebaas, vajutage vahekaardile **Import**, valige fail `autokool.sql` ja vajutage **Go / Impordi**.
   *(Märkus: skript loob automaatselt tabelid `courses`, `categories`, `reviews`, `registrations`, `users` ja täidab need valmis andmete ning piltidega ilma vigadeta).*
3. **Konfiguratsiooni kontroll:**
   Failis `inc/Database.php` on vaikeühendus:
   - Host: `localhost`
   - Kasutaja: `root`
   - Parool: `""` (tühi)
   - Andmebaas: `autokool`
4. **Veebilehe avamine:**
   Avage brauseris aadress:
   `http://localhost/autokool/` (või vastavalt pordile: `http://localhost:81/autokool/`).

---

## 2. Külastaja ja Õpilase Kasutusjuhend (Visitor & Student Guide)

### 2.1 Koolituste sirvimine ja kategooriate valik
- **Avaleht:** Esilehel kuvatakse populaarsemad kursused (Top Courses) koos piltide, hindade ja eksamite sooritamise statistikaga.
- **Menüü "Koolitused":**
  - Avaneb rippmenüü kategooriatega:
    - *B-kategooria (Sõiduautod)*
    - *A-kategooria (Mootorrattad)*
    - *C-kategooria (Veoautod)*
    - *Lisakoolitused (Lõppaste, Esmaabi)*
- **Kõik kursused:** Lehel "Kõik kursused" saate kasutada **reaalajas otsinguriba** (trükkige nt "manuaal" või "mootorratas") ja **kategooriate filtreerimisnuppe** – tulemused filtreeritakse hetkega ilma lehte taaslaadimata.

### 2.2 Interaktiivne Hinnakalkulaator
Lehelt **"Hinnakalkulaator"** leiate mugava tööriista oma koolituspaketi kokkupanekuks:
1. **Vali kategooria:** Klõpsake soovitud kategoorial (B, A, C või Lõppaste).
2. **Vali käigukast:** Märkige manuaal- või automaatkäigukast.
3. **Vali lisatunnid:** Liigutage liugurit (slider) lisatundide valimiseks (0 kuni 15 tundi).
4. **Vali lisamoodulid:** Märkige soovi korral linnukesega "Esmaabikoolitus" ja/või "Libedasõidu riskivältimine".
5. **Tulemus:** Ekraani paremas veerus näete reaalajas uuenevat **kogumaksumust** ja **igakuist osamakset (4 osas)**.
6. Klõpsates kollast nuppu **"Registreeru selle paketiga"**, avaneb registreerumisvorm, kuhu on teie valitud paketi info juba lisatud!

### 2.3 Kiire registreerumine kursusele
- Iga kursuse kaardil ja detaillehel on nupp **"Registreeru kursusele"**.
- Nupule vajutades avaneb sujuv hüpikaken (modal).
- Sisestage oma nimi, e-posti aadress, telefoninumber ja küsimused/eelistatud aeg.
- Vajutage **"Kinnita registreerimine"**. Teie avaldus salvestatakse andmebaasi tabelisse `registrations` ja ekraanile kuvatakse kinnitusteade.

### 2.4 Tagasiside ja Arvustuste jätmine
1. Avage meelepärane kursus (vajutage "Loe lähemalt").
2. Kerige lehe allossa sektsioonini **"Jäta oma tagasiside"**.
3. Sisestage oma nimi, valige tärnihinnang (1 kuni 5 tärni) ja kirjutage oma kommentaar.
4. Vajutage **"Saada arvustus"**. Arvustus ilmub koheselt teistele õpilastele nähtavale.

### 2.5 Keele vahetamine (Keelesäte EST / RUS)
- Veebilehe ülaservas asub keelelüliti **EST | RUS**.
- Klõpsates nupule **RUS**, tõlgitakse kogu lehe navigatsioon, nupud, teated ning ka andmebaasist tulevad kursuste kirjeldused koheselt vene keelde.
- Klõpsates nupule **EST**, lülitub leht tagasi eesti keelele.
- Teie keele-eelistus salvestatakse brauseri sessiooni, seega säilib valitud keel ka teistel alamlehtedel liikudes.

---

## 3. Administraatori Kasutusjuhend (Administrator Guide)

### 3.1 Juhtpaneeli sisselogimine
1. Avage aadress: `http://localhost/autokool/admin/` (või vajutage peamenüüs "Administratsioon").
2. Sisestage sisselogimisandmed:
   - **Email:** `admin@autokool.ee`
   - **Parool:** `123456`
3. Vajutage nuppu **"Logi sisse"**.

### 3.2 Töölaud (Dashboard)
Peale sisselogimist avaneb administraatori juhtpaneel, mis kuvab reaalajas statistikat:
- Aktiivsete kursuste arv
- Kategooriate arv
- Uute veebiavalduste arv
- Arvustuste koguarv

### 3.3 Kursuste nimekiri ja toimingud (CRUD)
Vajutage ülamenüüs **"Kursuste haldus"** (`courseAdmin`):
- Kuvatavas tabelis näete kõiki kursusi koos pisipildi, nimetuse, kategooria, hinna ja kestusega.
- **Muutmine (Pliiatsi ikoon):**
  - Saate muuta kursuse nime, hinda, kestust, kirjeldust ning laadida üles uue pildi.
  - Vajutage "Salvesta muudatused".
- **Kustutamine (Prügikasti ikoon):**
  - Süsteem küsib kinnitust. Kinnitamisel kustutatakse kursus ja sellega seotud tagasiside andmebaasist.

### 3.4 Uue kursuse lisamine
1. Vajutage nupule **"Lisa kursus"** (`courseAdd`).
2. Täitke väljad:
   - Kursuse nimetus
   - Kategooria rippmenüüst
   - Hind (€)
   - Käigukasti tüüp
   - Kestus ja õppemaht
   - Kirjeldus
   - Kaanepildi fail (JPG/PNG)
3. Vajutage **"Salvesta koolitus"**. Uus kursus on koheselt nähtav veebisaidi külastajatele.

### 3.5 Veebiavalduste vaatamine
1. Vajutage ülamenüüs **"Avaldused"** (`registrationsAdmin`).
2. Tabelis kuvatakse kõik veebilehe ja kalkulaatori kaudu saadetud registreerumised koos kandidaadi nime, kursuse, kontakttelefoni ja lisatud soovidega.

### 3.6 Väljalogimine
Vajutage paremas ülanurgas asuvale nupule **"Välju"** – seanss lõpetatakse turvaliselt.
