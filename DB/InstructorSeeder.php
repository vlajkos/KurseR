<?php


$sqlCreateTable = "CREATE TABLE IF NOT EXISTS instructors(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    biography TEXT,
    image VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";

if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'instructors' created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

function createInstructor($name, $surname, $slug, $biography, $image, $email)
{
    $conn = Database::connectDatabase(); // Assuming you have a method like this in your Database class

    // Prepare the SQL statement
    $sql = "INSERT INTO instructors (name, surname, slug, biography, image, email) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $surname, $slug, $biography, $image, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Instructor created successfully.\n";
    } else {
        echo "Error creating instructor: " . $stmt->error . "\n";
    }

   
    $stmt->close();
  
}

$instructor = createInstructor("Lazar", "Filipović", "lazar-filipovic",
"Lazar Filipović, rođen 2002. godine, je istaknuti tiktoker čije stranice na društvenim mrežama odišu pozitivnom energijom i korisnim savetima. Svojim neospornim šarmom i znanjem, Lazar je stekao ogroman broj pratilaca, posebno fokusiranih na teme nege kože i psihoterapije.
</br>
Odrastao u dinamičnom gradu, Lazar je oduvek imao strast prema otkrivanju najnovijih trendova u nezi kože. Sa svojim jedinstvenim pristupom, on ne samo što deli svoje omiljene proizvode, već pruža i dublje razumevanje o značaju samopouzdanja i mentalnog zdravlja.
</br>
Sa svakodnevnim videima na TikToku, Lazar vodi svoje pratioce kroz različite korake nege kože, deleći trikove i savete za postizanje blistave kože. Takođe, njegova posvećenost promociji mentalnog blagostanja izražava se kroz otvorene razgovore o psihoterapiji, podstičući zajednicu da se brine o svom emocionalnom zdravlju.
</br>
Lazar nije samo stručnjak za lepotu i negu, već i zagovornik pozitivnosti i podrške. Njegova biografija sastavljena je od strasti prema deljenju ljubavi prema nezi kože i brizi o mentalnom zdravlju, čime inspiriše mnoge da brinu o sebi i otkriju unutrašnju lepotu.",
'lazar-filipovic.jpg',
'lazarfilip02@gmail.com'
);

$instructor = createInstructor("Lea", "Stanković", 
"lea-stankovic",
"Lea Stanković, rođena 2000. godine, predstavlja sjajnu ličnost na društvenim mrežama koja je osvojila srca svojih pratilaca svojim šarmom, kreativnošću i strašću prema mejkapu. Kroz različite platforme, poput TikToka i YouTube-a, Lea ne samo da pruža vodiče za savršen mejkap, već i deli svoje životne avanture i korisne savete.
</br>
Sa 22 godine, Lea je već postala istaknuta tiktokerka i jutjuberka čije su veštine u mejkapu neosporno impresivne. Njen kreativni pristup šminkanju nije samo izvor inspiracije za mnoge, već i pokazatelj njene stručnosti u umetnosti mejkapa. Bez obzira na to da li je u pitanju svakodnevni mejkap, specijalni događaj ili eksperimentisanje sa najnovijim trendovima, Lea je uvek korak ispred.
</br>
Kroz svoje video sadržaje, Lea takođe deli lične priče, savete o samopouzdanju i iskustva koja inspirišu njenu zajednicu. Njen YouTube kanal pruža detaljne tutorijale, recenzije proizvoda i iskrene razgovore o životu, što je čini ne samo mejkap artistom, već i prijateljem svojih pratilaca.
</br>
Leina biografija odražava energičnu i autentičnu mladu ženu koja ne samo što osvaja svet mejkapa, već i stvara digitalnu zajednicu koja se oseća povezano s njom. Sa osmehom na licu i pažljivo odabranim bojama, Lea Stanković nastavlja da širi radost i ljubav prema mejkapu širom društvenih mreža.",
'lea-stankovic.png',
'leas2000@gmail.com'
);

$instructor = createInstructor("Nenad", "Jankovic", "nenad-jankovic",
"Nenad Jankovic, rođen 1985. godine, je ugledni kuvar i šef kuhinje čije kulinarsko umeće osvaja srca gurmana širom sveta. Sa strašću prema kulinarstvu, Nenad je izgradio reputaciju inovativnog i talentovanog šefa koji neprestano istražuje nove ukuse i tehnike.
</br>
Odrastao u pitoresknom selu, Nenad je od malih nogu pokazivao interesovanje za kuvanje. Njegova porodična kuhinja bila je mesto gde je prvi put otkrio čaroliju stvaranja ukusnih jela. Kroz godine truda i rada, Nenad je stekao obrazovanje u uglednim kulinarskim školama širom Evrope, obogaćujući svoje znanje i veštine.
</br>
Sa bogatim iskustvom rada u vrhunskim restoranima, Nenad je postao prepoznatljiv po svojoj sposobnosti da spoji tradicionalne recepte sa savremenim pristupom. Njegova kuhinja predstavlja harmoniju ukusa i estetike, a svako jelo je pažljivo kreirano kao pravo umetničko delo.
</br>
Nenad nije samo stručnjak u kuhinji, već i zaljubljenik u lokalne sastojke i održivu gastronomiju. Kroz svoj rad, on promoviše sveža i lokalno proizvedena jela, podstičući svest o važnosti podrške lokalnim zajednicama i očuvanja tradicije.
</br>
Sa širokim osmehom i šefovskim šeširom na glavi, Nenad Jankovic ne samo da zadovoljava ukusne pupoljke, već i inspiriše druge da istraže čaroliju kulinarskog sveta.",
'nenad-jankovic.PNG',
'nenadjank85@gmail.com'
);


$instructor = createInstructor("Marija", "Nikolic", "marija-nikolic",
"Marija Nikolic, rođena 1990. godine, je strastvena instruktorka pevanja čije zvučne vibracije oduševljavaju sve one koji tragaju za izrazom kroz melodiju. Sa velikim ljubavnim glasom i neospornim muzičkim talentom, Marija je postala mentorka mnogima u svetu muzike.
</br>
Odrasla u muzičkoj porodici, Marija je već u ranim godinama otkrila svoju ljubav prema pevanju. Tokom godina, stekla je formalno muzičko obrazovanje i usavršavala svoj vokalni dar. Njen pristup podučavanju je osnažujući, fokusiran na razvoj individualnog izraza i tehnike pevanja.
</br>
Kroz dinamične časove pevanja, Marija inspiriše svoje učenike da pronađu svoj jedinstveni glas i izraze emocije kroz muziku. Njeno posvećenje umetnosti pevanja nije samo u tehničkom usavršavanju, već i u stvaranju sigurnog prostora za izražavanje i samopouzdanje.
</br>
Marija nije samo instruktorka, već i zaljubljenik u različite muzičke žanrove. Njena biografija je priča o ljubavi prema muzici, mentorstvu i radosti deljenja muzičkog iskustva sa svetom.",
'marija-nikolic.PNG',
'marija.nikolic.music@gmail.com'
);

$instructor = createInstructor("Milica", "Majstorovic", "milica-majstorovic",
"Milica Majstorovic, rođena 1988. godine, je talentovana šminkerka čija kreativnost i veština ulepšavaju lica i stvaraju umetnička dela na svakom koraku. Sa širokim spektrom boja i paleta, Milica je postala sinonim za besprekornu šminku koja ističe prirodnu lepotu.
</br>
Odrasla u svetu umetnosti i estetike, Milica je svoju strast prema šminkanju otkrila još u tinejdžerskim godinama. Kroz formalno obrazovanje i rad u renomiranim salonima lepote, stekla je bogato iskustvo u stvaranju različitih stilova, od suptilnih dnevnih lookova do glamuroznih večernjih izdanja.
</br>
Milica pristupa svakom licu kao platnu, istražujući i naglašavajući jedinstvene karakteristike svake osobe. Njena šminka je spoj preciznosti, inovacije i ljubavi prema detaljima. Kroz individualne časove šminkanja, deli svoje tajne i tehnike sa zaljubljenicima u svet lepote.
</br>
Milica nije samo šminkerka, već i zagovornik samopouzdanja i ljubavi prema sebi. Njena biografija je priča o stvaranju lepote, inspiraciji i podsticanju svakog pojedinca da zasija u sopstvenom sjaju.",
'milica-majstorovic.PNG',
'milica.makeup.artist@gmail.com'
);

$instructor = createInstructor("Marko", "Bozovic", "marko-bozovic",
"Marko Bozovic, rođen 1965. godine, je stručnjak za fotografiju čije oko za detalje i umetnički pristup čine njegove slike nezaboravnim vizuelnim iskustvom. Sa godinama iskustva u svetu fotografije, Marko deli svoje znanje i strast sa svima koji žele otkriti tajne zabeležavanja trenutaka.
</br>
Odrastao u kreativnom okruženju, Marko je oduvek bio fasciniran snagom fotografije da uhvati jedinstvene trenutke i ispriča priču kroz objektiv. Njegova putovanja i istraživanja različitih kultura dodatno su obogatila njegov fotografski stil, čineći ga jedinstvenim u pristupu i izrazu.
</br>
Kroz svoje kurseve fotografije, Marko prenosi svoje tehničko znanje i umetnički senzibilitet na polaznike. Njegov pristup podučavanju kombinuje tehničke veštine sa kreativnim izazovima, pružajući učenicima sveobuhvatno iskustvo u svetu fotografije.
</br>
Marko nije samo fotograf, već i entuzijasta za priče koje se kriju iza svake slike. Njegova biografija je priča o istraživanju sveta kroz objektiv, otkrivanju lepote u svakodnevnim trenucima i inspirisanju drugih da vide svet kroz novi vizuelni ugao.",
'marko-bozovic.PNG',
'marko.bozovic.photo@gmail.com'
);


