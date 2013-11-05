SASS boilerplate
================

Features
--------

+ Modulær kode som bygges til én stor CSS-fil ved kompilasjon
+ Skjelett for responsivt design ferdig oppsatt
+ Fleksibelt, prosentbasert spaltesystem som fungerer cross-browser
+ Oppsatt med de mest brukte funksjonene og variablene ut av esken

Filer (i den rekkefølgen de oppstår)
------------------------------------

+ master.scss
+ _normalize.scss
+ _mixins.scss
+ _ui.scss
+ _grid.scss
+ _base.scss
+ _components.scss
+ _tiny.scss
+ _small.scss
+ _medium.scss
+ _large.scss
+ _huge.scss
+ _massive.scss

Filenes roller
--------------

**master.scss**

Samlefil for all kode. Ingenting skal ligge her annet enn import-instruksjoner til SASS så alle filene inkluderes. Dersom webfonter eller andre CSS-filer skal importeres, skal det gjøres i den første seksjonen på siden.

**_normalize.scss**

Nyeste versjon av [normalize.css](http://necolas.github.io/normalize.css/), strippet for overflødige kommentarer. Denne skal ikke endres, med mindre det er for å oppgradere versjon. Pass på breaking changes.

**_mixins.scss**

Alle SASS-funksjoner (mixins) skal ligge i denne filen. Ut av esken ligger det funksjoner for å lage gradients, omformulere boksmodell, fikse clearing i floats, kjøre transitions og lage avrundede hjørner. Bruk mixins aktivt for å automatisere prosesser som brukes ofte.

**_ui.scss**

Her lagres alle variabler som brukes i utseende; farger, skrifttyper, størrelser etc.

**_grid.scss**

SASS-funksjoner for oppsett og produksjon av spaltesystem i CSS. Merk her at det finnes funksjoner som kan definere størrelser uten å måtte bruke klassenavn i HTML, og at det så langt det lar seg gjøre, er best å bruke disse i CSS for å unngå overflødig kode i HTML-filene våre.

**_base.scss**

Her ligger definisjoner for så godt som alle nødvendige HTML-tagger på det aller mest grunnleggende nivået. Forsøk å skrive kode så mest mulig utseende ligger i disse taggene, slik at klassenavn kun brukes der disse er nødvendige. På denne måten får vi et mer konsistent design.

**_components.scss**

Samlefil for komponentkode - dette vil si kode som ikke er på det helt grunnleggende nivået som beskrevet i _base.scss. Kort fortalt, alt som er en del av selve designet som ikke er dekket av grunnleggende tagger.

**_tiny.scss**

Kode for responsivt design på enheter med skjermstørrelse mindre enn 480px i bredde.

**_small.scss**

Kode for responsivt design på enheter med skjermstørrelse fra 481px i bredde og oppover.

**_medium.scss**

Kode for responsivt design på enheter med skjermstørrelse fra 768px i bredde og oppover.

**_large.scss**

Kode for responsivt design på enheter med skjermstørrelse fra 1280px i bredde og oppover.

**_huge.scss**

Kode for responsivt design på enheter med skjermstørrelse fra 1680px i bredde og oppover.

**_massive.scss**

Kode for responsivt design på enheter med skjermstørrelse fra 1920px i bredde og oppover.


Bygging
-------

Merk: for å bygge en CSS-fil fra boilerplaten, må du ha Ruby, SASS og Sublime Text installert på maskinen din. Følg tutorials som ligger i dokumentasjonsrepoen for instruksjoner rundt dette.

For å bygge en CSS-fil av hele boilerplaten, se først til at riktig build system er i bruk i Sublime Text (se Tools -> Build system -> SASS). Åpne deretter master.scss, og trykk Ctrl+B / Cmd+B for å bygge til CSS. Pass på at du ikke forsøker å bygge noen av de andre filene, dette vil ikke fungere da SASS bygger den aktive filen.