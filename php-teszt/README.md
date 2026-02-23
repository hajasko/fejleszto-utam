# PHP-teszt

Helyi futtatáshoz szükséges: 
-XAMPP (Apache + MySQL)
-fejleszto-teszt adatbázis létrehozása
-SQL séma: 
            CREATE TABLE felhasznalok (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nev VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                kor INT
            );

            INSERT INTO felhasznalok (nev, email, kor) VALUES
            ('Kiss János', 'kiss.janos@example.com', 32),
            ('Nagy Éva', 'nagy.eva@example.com', 28),
            ('Kovács Péter', 'kovacs.peter@example.com', 45);