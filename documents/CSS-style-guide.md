Retningslinjer for kode
=======================

Følgende retningslinjer for å skrive CSS-kode i gruppa er for å sikre uniform kode tvers over plattformer, og skal følges av samtlige:

+ **Ingen ID-tagger**: ID-tagger skal ikke brukes i CSS-selektorer. Dette er reservert til Javascript.
+ **Ingen overkvalifisert kode**: Ikke skriv `div.sidebar` - skriv `.sidebar`
+ **Ingen underscores**: Ikke skriv `.sidebar_left` - skriv `.sidebar-left`
+ **Maksimal gjenbruk av kode**: Kode skal skrives slik at koden kan brukes igjen og igjen i andre elementer hvis nødvendig.
+ **Færrest mulig vendor prefixes**: Minst mulig bruk av kode som er laget for spesielle nettlesere og motorer.