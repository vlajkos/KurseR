<?php


$sqlCreateTable = "CREATE TABLE IF NOT EXISTS courses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    body TEXT,
    date DATE NOT NULL,
    image VARCHAR(255) NOT NULL,
    views INT DEFAULT 0
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'courses' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

function createCourse($name, $slug, $body, $date, $image, $views = 0)
{
    $conn = Database::connectDatabase(); // Assuming you have a method like this in your Database class

    // Prepare the SQL statement
    $sql = "INSERT INTO courses (name,slug, body, date, image, views) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $slug, $body, $date, $image, $views);

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
'naucite-sve-sto-vam-je-potrebno-za-milionske-preglede-na-tiktoku',
"Pridružite nam se na uzbudljivom putovanju kroz svet TikToka i otkrijte tajne postizanja viralnosti na ovoj popularnoj društvenoj mreži! Naš kurs 'Naučite Sve Što Vam Je Potrebno za Milionske Preglede na TikToku' pruža sveobuhvatno iskustvo, čime vam omogućava da ovladate veštinama koje su vam potrebne za osvajanje srca TikTok zajednice.
</br>
</br>
Šta Vas Očekuje:
</br>
<b>Stručni Vodiči:</b> Naučite od najboljih! Naši iskusni TikTokeri, uključujući Lazara i Leu, podeliće sa vama svoje najbolje prakse i savete za kreiranje sadržaja koji će osvojiti pažnju.
</br>
<b>Kreiranje Zabavnih Video Snimaka:</b> Sa praktičnim demonstracijama, istraživaćemo različite stilove i tehnike kreiranja sadržaja koji će oduševiti vaše pratioce.
</br>
<b>Strategije Rasta i Promocije:</b> Otkrijte kako izgraditi vašu TikTok zajednicu i stvoriti autentičnu povezanost sa svojim pratiocima. Razmatraćemo strategije rasta i promocije koje će vam pomoći da povećate vidljivost i stignete do miliona pregleda.
</br>
<b>Kreativni Alati i Efekti:</b> Upoznajte se sa najnovijim kreativnim alatima i efektima koje TikTok nudi. Naučite kako ih koristiti da biste dodali originalnost i atraktivnost vašem sadržaju.
</br>
<b>Analiza Trendova:</b> Pratite najnovije trendove i saznajte kako ih iskoristiti u svoju korist. Razvijajte sadržaj koji je u skladu sa aktuelnim dešavanjima i koji će privući pažnju šire publike.
</br>
Ovaj kurs je savršen za svakoga ko želi da iskoristi pun potencijal TikToka i postane prava zvezda na ovoj platformi. Bez obzira da li ste početnik ili već imate iskustva, očekujte dinamičan i interaktivan pristup učenju koji će vas inspirisati da stvarate nezaboravan sadržaj.
</br>
</br>
Priključite se sada i krenite ka putu postizanja milionskih pregleda na TikToku! 🚀✨", 
'2024-01-12',
'tiktok-course.jpg',
100);

$osnoveKuvanjaKurs = createCourse(
    "Ovladajte Osnovama Kulinarstva",
    'ovladajte-osnovama-kulinarstva',
    "Započnite kulinarsko putovanje i naučite osnovne veštine potrebne da ovladate umetnošću kuvanja. Bez obzira da li ste početnik u kuhinji ili želite da unapredite svoje kulinarsko umeće, naš kurs pruža sveobuhvatno iskustvo kako biste postali samouvereni i vešti kuvar.
    </br>
    </br>
    Šta Vas Očekuje:
    </br>
    <b>Osnovne Tehnike:</b> Od veština rukovanja nožem do ovladavanja različitim metodama kuvanja, naši iskusni kuvari će vas voditi kroz osnovne tehnike koje čine temelj kuvanja.
    </br>
    <b>Poznavanje Namirnica:</b> Istražite svet namirnica i naučite kako ih birati, pripremati i koristiti kako biste unapredili ukus svojih jela. Od začina i svežeg povrća, otkrijte tajne odličnih ukusa.
    </br>
    <b>Ovladavanje Receptima:</b> Zaronite u različite recepte prilagođene početnicima, postepeno prelazeći na kompleksnija jela. Sticanjem praktičnog iskustva, izgrađujte svoje samopouzdanje u kuhinji.
    </br>
    <b>Planiranje Menija:</b> Razumite veštinu kreiranja dobro izbalansiranih i ukusnih menija. Naučite kako efikasno planirati obroke, uzimajući u obzir nutritivnu ravnotežu i raznovrsne ukuse.
    </br>
    <b>Kulinarski Saveti i Trikovi:</b> Iskoristite insider savete i trikove koje profesionalni kuvari koriste kako bi unapredili ukus i prezentaciju svojih jela.
    </br>
    Bez obzira da li kuvate za sebe, porodicu ili prijatelje, ovaj kurs će vam omogućiti da steknete veštine i znanje za stvaranje ukusnih i zadovoljavajućih obroka. Pridružite nam se sada i započnite svoje kulinarsko putovanje! 🍳🌿",
    '2024-02-01',
    'cooking-course.jpg',
    54
);

$naprednaFotografijaKurs = createCourse(
    "Istražite Napredne Tehnike Fotografije",
    "istrazite-napredne-tehnike-fotografije",
    "Povećajte svoje veštine fotografisanja na sledeći nivo sa našim kursom 'Istražite Napredne Tehnike Fotografije'. Bez obzira da li ste nadolazeći fotograf ili iskusni profesionalac, ovaj kurs je dizajniran da unapredi vašu kreativnu viziju i tehničku veštinu.
    </br>
    </br>
    Šta Ćete Naučiti:
    </br>
    <b>Napredne Postavke Aparata:</b> Zaronite u složenosti postavki fotoaparata, uključujući otvor blende, brzinu zatvarača i ISO. Naučite kako kreativno koristiti ove postavke da biste uhvatili zadivljujuće slike.
    </br>
    <b>Ovladavanje Kompozicijom:</b> Unapredite svoje veštine kompozicije i istražite napredne tehnike za okvirivanje, pravilo trećina, vodeće linije i još mnogo toga. Pretvorite obične scene u vizuelno privlačne fotografije.
    </br>
    <b>Tehnike Osvetljavanja:</b> Razumite nijanse prirodne i veštačke svetlosti. Istražite tehnike manipulacije svetla kako biste stvorili atmosferu i istakli svoj subjekt.
    </br>
    <b>Magija Postprocesiranja:</b> Zaronite u svet naknadne obrade i otkrijte kako unaprediti svoje slike pomoću softvera poput Adobe Lightroom i Photoshop. Naučite kako da donesete svoju kreativnu viziju u život.
    </br>
    <b>Fotografisanje Posebnih Subjekata:</b> Istražite tehnike fotografisanja specifičnih subjekata, kao što su portreti, pejzaži i arhitektura. Ovladajte veštinom hvatanja jedinstvenih i privlačnih trenutaka.
    </br>
    Bez obzira da li vas zanima profesionalna fotografija ili jednostavno želite da izrazite svoju kreativnost putem vizuala, ovaj kurs je vaša kapija ka naprednoj fotografiji. Pridružite nam se sada i oslobodite pun potencijal svoje kamere! 📷✨",
    '2024-03-15',
    'photography-course.jpg',
    31
);


$pevanjeZaPocetnikeKurs = createCourse(
    "Pevanje za Početnike",
    "pevanje-za-pocetnike",
    "Započnite svoje muzičko putovanje sa kursom 'Pevanje za Početnike'. Bez obzira da li ste apsolutni početnik ili već imate malo iskustva, ovaj kurs pruža osnovne tehnike pevanja i prilagođava se vašem nivou veštine. Iskusite radost izražavanja svojih osećanja kroz pesmu dok istražujete različite aspekte vašeg vokalnog potencijala.
    </br>
    </br>
    Šta Ćete Naučiti:
    </br>
    <b>Osnove Tehnike Disanja:</b> Razvijte pravilne tehnike disanja koje će vam pomoći da postignete jasan i snažan zvuk. Disanje je ključno za uspešno pevanje.
    </br>
    <b>Vežbe za Razvoj Glasovnih Opsega:</b> Upoznajte se sa vežbama koje će vam pomoći da proširite svoj glasovni opseg i postignete stabilnost u visokim i niskim tonovima.
    </br>
    <b>Artikulacija i Izražajnost:</b> Naučite kako pravilno izgovarati reči i dodajte izražajnost svojem pevanju. Ovladajte veštinom prenosa emocija kroz svoj vokalni nastup.
    </br>
    <b>Analiza Teksta Pesme:</b> Razumejte značenje pesme i kako to preneti kroz svoje pevanje. Analizirajte tekstualne elemente i prilagodite svoj izraz pesmi.
    </br>
    <b>Samopouzdanje na Sceni:</b> Razvijajte samopouzdanje u svojem pevačkom nastupu. Savladajte tremu i naučite tehnike suočavanja sa publikom.
    </br>
    Ovaj kurs je savršen za sve koji žele da otkriju radost pevanja i unaprede svoje veštine. Bez obzira da li pevate uživo ili želite poboljšati svoje pevačke sposobnosti, pridružite nam se sada i istražite svoj pevački potencijal! 🎤🎶",
    '2024-04-01',
    'singing-course.PNG',
    22
);
$sminkanjeKurs = createCourse(
    "Umetnost Šminkanja: Osnove i Saveti",
    "umetnost-sminkanja-osnove-i-saveti",
    "Zaronite u fascinantan svet šminkanja sa našim kursom 'Umetnost Šminkanja: Osnove i Saveti'. Bez obzira da li ste početnik ili želite unaprediti svoje veštine, ovaj kurs pruža temeljne tehnike i tajne za postizanje besprekornog izgleda. Istaknite svoju kreativnost kroz detaljno vođene lekcije koje će vam omogućiti da eksperimentišete s različitim stilovima i tehnologijama šminkanja, prilagođenim vašem jedinstvenom izrazu lepote.
    </br>
    </br>
    Šta Ćete Naučiti:
    </br>
    <b>Pravilna Priprema Kože:</b> Otkrijte korake za pripremu kože pre šminkanja, uključujući hidrataciju i osnovnu negu kože.
    </br>
    <b>Tehnike Nanošenja Osnovne Šminke:</b> Naučite kako pravilno nanositi podlogu, korektor i puder kako biste postigli glatku i dugotrajnu osnovu.
    </br>
    <b>Isticanje Očiju:</b> Ovladajte tehnikama za isticanje očiju pomoću senki, ajlajnera i maskare. Kreirajte različite stilove za svaku priliku.
    </br>
    <b>Konturisanje i Osvežavanje Lica:</b> Saznajte kako konturisati lice kako biste naglasili karakteristike i koristili rumenilo za zdrav izgled.
    </br>
    <b>Umetnost Ruževa i Karmina:</b> Razvijte veštine nanošenja ruževa i karmina u skladu sa oblikom lica i tonom kože. Kreirajte raznovrsne usne izglede.
    </br>
    Bez obzira da li želite svakodnevni dnevni izgled, večernji glamur ili se pripremate za poseban događaj, ovaj kurs će vam pomoći da postignete željeni izgled. Pridružite nam se sada i istražite umetnost šminkanja! 💄✨",
    '2024-05-01',
    'makeup-course.jpg',
    12
);


