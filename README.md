# Bachelor's Thesis: Refactoring of Kdyby packages

* author: [Filip Procházka](https://is.muni.cz/auth/osoba/433457)
* advisor: [RNDr. Jaroslav Bayer](https://is.muni.cz/auth/osoba/72873)

## Assignment

> Tématem bakalářské práce bude údržba a přepracování (refaktoring) PHP balíčků Kdyby s cílem zajistit podporu nových verzí knihoven Nette, Symfony a Doctrine, zvýšení koherence a usnadnění použití.
>
> Jelikož je student autorem upravovaných balíčků, odpadá potřeba seznámení se s jejich obsahem. Student tedy započne detailní specifikací požadovaných úprav a zjištěním funkcionality, kterou si již komunita Nette realizovala sama, ta představuje potenciálně přebytečný obsah.
>
> Cílem není přepracování všech balíčků Kdyby, u každého však student v textu práce úpravu či ponechání v původní podobě odůvodní. Mezi základní cíle úprav patří:
>
> * zajištění kompatibility s novými verzemi knihoven,
> * optimalizace kódu a dekompozice příliš komplexních balíčků,
> * doplnění komunitou požadované funkcionality,
> * odstranění slepých cest a již nepoužívaných metod či celých funkcionalit,
> * odstranění kódu, který řešil problémy s knihovnami, které již pominuly,
> * automatizace kontrol kvality,
> * automatizace dodržení stylu zápisu programu.
>
> Volba programovacího jazyka je díky povaze práce daná. Veškerý obsah upravovaných balíčků bude veřejně dostupný jak v archivu závěrečné práce, tak komunitě na serveru github. Jelikož u mnohých balíčků se počty stažení pohybují ve statisících, bude student dbát na řádné komentování, testování a dokumentaci, a to zejména v oblasti zpětně nekompatibilních úprav či rušené funkcionality. Jako nepovinné rozšíření práce lze uvažovat demonstraci nové funkcionality Kdyby.

## Preview

* [PDF snapshot of thesis](https://github.com/fprochazka/fi-muni-bachelors-thesis/blob/master/dist/thesis.pdf)

## Writing

**Prepare environment:**

```bash
docker-compose build
```

**Build**

```bash
make
```
**Watch**

```bash
make watch
```
