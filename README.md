# Lokaverkefni_haust_2016
Lokaverkefni haustannar 2016 í Tækniskólanum í Reykjavík

## Spurningasíða
Þetta er vefsíða sem gerir notendum kleift að spurja spurninga og/eða svara spurningum annarra notenda. Vefsíðan er mótuð að miklu leiti eftir [Stackoverflow.com](https://www.stackoverflow.com).

## <a name="uppsetning"></a>Uppsetning
Meðhöndlun gagna fer fram með PHP aðferðum tegndum við MySql gagnagrunn og er því nauðsynlegt að hafa aðgang að umhverfi sem styður PHP og MySql.
CSS reglur voru hannaðar með [Sass](http//www.sass-langs.com/install) en einnig er hægt að breyta css reglum beint í "mainpage.css" skjalinu og er því ekki nauðsynlegt að hafa aðgang að Sass málinu.

## Keyrsla
Ef notandi hefur aðgang að PHP og MySql umhverfi (sjá [uppsetningu](#uppsetning)) er nóg að nota git til þess að ná í skránnar eða hala niður .zip skránni frá þessu "repository".

1. Git aðferð:

   Klónið þetta "repository" í umhverfi sem höndlar PHP og MySql
   ```
   $ git clone https://github.com/danielthorr/Lokaverkefni_haust_2016`
   ```
   Síðasta skrefið er að breyta "Includes/connection.php" skránni til þess að tengjast við MySql gagnagrunninn þinn.

1. .zip aðferð:

   Halið niður .zip skránni með því að smella á "Clone or download" takkann á þessu "repository" og veljið "Download .zip".
   "Extract-ið" innihald .zip skránnar í umhverfi sem meðhöndal PHP og MySql.
   
   Síðasta skrefið er að breyta "Includes/connection.php" skránni til þess að tengjast við MySql gagnagrunninn þinn.

## Stillingar
Eins og fram kom í [uppsetningu](#uppsetning) er hægt að nota [Sass](http//www.sass-langs.com/) til þess að breyta CSS reglum.
Vefsíðan notar API sem kallast [TinyMCE](https://www.tinymce.com/) fyrir spurningar og "comments" til þess að veita notanda sniðmöguleika. Vefsíðan þeirra inniheldur allar upplýsingar um stillingar þess.