﻿# PHP rühmatöö projekt
**Rühmatööde demo päev** on valitud eksamipäev jaanuaris, kuhu tullakse terve rühmaga koos!
## Sporter
**Rühmaliikmed:** Kent Loog, Tanel Otsa!;
**Eesmärk:**
*Rakenduse eesmärk on aidata otsida endale treeningkaaslasi. Kasutaja saab luua ise üritusi ja liituda üritustega*;
*Nt. kui soovid minna discgolfi mängima, aga sul ei ole hetkel sõpru, kes saaks tulla sinuga mängima,*;
*siis saad minna sinna lehele ja luua üritus, kuhu teised saavad liituda või otsida juba kellegi teise poolt loodud olemasoleva ürituse.*;
**Sihtrühm:**
*Aktiivsed sportlikud inimesed, kellel ei meeldi üksi trenni teha.*;
**Eripära:**
*Ei tea ühtegi samalaadset rakendust, mis ideaalselt töötaks.*;

SQL tabelid

CREATE TABLE `s_attend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `attending` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `s_event` (
  `id` int(11) NOT NULL,
  `event` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `info` text,
  `places` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `s_interests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `interest` text NOT NULL,
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `s_user_info` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(10) DEFAULT NULL,
  `birthdate` varchar(30) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


## Tööjuhend
1. Üks rühma liikmetest _fork_'ib endale käesoleva repositooriumi ning annab teistele kirjutamisõiguse/ligipääsu (_Settings > Collaborators_)
1. Muudate vastavalt _git config_'ut
```
git config user.name "Romil Robtsenkov"
git config user.email romilrobtsenkov@users.noreply.github.com
```
1. Üks rühma liikmetest teeb esimesel võimaluse _Pull request_'i (midagi peab olema repositooriumis muudetud)
1. Muuda repositooriumi README.md faili vastavalt nõutele
1. Tee valmis korralik veebirakendus

### Nõuded

1. **README.md sisaldab:**
    * suurelt projekti nime;
    * suurelt projekti veebirakenduse pilt;
    * rühma liikmete nimed;
    * eesmärki (3-4 lauset, mis probleemi üritate lahendada);
    * kirjeldus (sihtrühm, eripära võrreldes teiste samalaadsete rakendustega – kirjeldada vähemalt 2-3 sarnast rakendust mida eeskujuks võtta);
    * funktsionaalsuse loetelu prioriteedi järjekorras, nt
        * v0.1 Saab teha kasutaja ja sisselogida
        * v0.2 Saab lisada huviala
        * ...
    * andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna);
    * **kokkuvõte:** mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).


2. **Veebirakenduse nõuded:**
    * rakendus on terviklik (täidab mingit funktsiooni ja sellega saab midagi teha);
    * terve arenduse ajal on kasutatud _git_'i ja _commit_'ide sõnumid annavad edasi tehtud muudatuste sisu; 
    * kasutusel on vähemalt 6 tabelit;
    * kood on jaotatud klassidesse;
    * koodis kasutatud muutujad/tabelid on inglise keeles;
    * rakendus on piisava funktsionaalsusega ja turvaline;
    * kõik tiimi liikmed on panustanud rakenduse arendusprotsessi.

## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
