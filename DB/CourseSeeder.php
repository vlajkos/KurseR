<?php


$sqlCreateTable = "CREATE TABLE IF NOT EXISTS courses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    body TEXT,
    date DATE NOT NULL,
    views INT DEFAULT 0
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'courses' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

function createCourse($name, $body, $date, $views = 0)
{
    $conn = Database::connectDatabase(); // Assuming you have a method like this in your Database class

    // Prepare the SQL statement
    $sql = "INSERT INTO courses (name, body, date, views) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $body, $date, $views);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Course created successfully.\n";
    } else {
        echo "Error creating course: " . $stmt->error . "\n";
    }

   
    $stmt->close();
  
}
$course = createCourse(
"Naučite Sve Što Vam Je Potrebno za Milionske Preglede na TikToku", 
"Pridružite nam se na uzbudljivom putovanju kroz svet TikToka i otkrijte tajne postizanja viralnosti na ovoj popularnoj društvenoj mreži! Naš kurs 'Naučite Sve Što Vam Je Potrebno za Milionske Preglede na TikToku' pruža sveobuhvatno iskustvo, čime vam omogućava da ovladate veštinama koje su vam potrebne za osvajanje srca TikTok zajednice.
</br>
Šta Vas Očekuje:
</br>
Stručni Vodiči: Naučite od najboljih! Naši iskusni TikTokeri, uključujući Lazara i Leu, podeliće sa vama svoje najbolje prakse i savete za kreiranje sadržaja koji će osvojiti pažnju.
</br>
Kreiranje Zabavnih Video Snimaka: Sa praktičnim demonstracijama, istraživaćemo različite stilove i tehnike kreiranja sadržaja koji će oduševiti vaše pratioce.
</br>
Strategije Rasta i Promocije: Otkrijte kako izgraditi vašu TikTok zajednicu i stvoriti autentičnu povezanost sa svojim pratiocima. Razmatraćemo strategije rasta i promocije koje će vam pomoći da povećate vidljivost i stignete do miliona pregleda.
</br>
Kreativni Alati i Efekti: Upoznajte se sa najnovijim kreativnim alatima i efektima koje TikTok nudi. Naučite kako ih koristiti da biste dodali originalnost i atraktivnost vašem sadržaju.
</br>
Analiza Trendova: Pratite najnovije trendove i saznajte kako ih iskoristiti u svoju korist. Razvijajte sadržaj koji je u skladu sa aktuelnim dešavanjima i koji će privući pažnju šire publike.
</br>
Ovaj kurs je savršen za svakoga ko želi da iskoristi pun potencijal TikToka i postane prava zvezda na ovoj platformi. Bez obzira da li ste početnik ili već imate iskustva, očekujte dinamičan i interaktivan pristup učenju koji će vas inspirisati da stvarate nezaboravan sadržaj.
</br>
Priključite se sada i krenite ka putu postizanja milionskih pregleda na TikToku! 🚀✨", 
'2024-01-12',
1000);