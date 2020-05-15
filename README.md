# FB-STD   libreria standard di sviluppo app. Versione: 2.0.0
La versione 2.0.0 prevede l'utilizzo della struttura "flex".
## CARATTERISTICHE
### Libreria di base per qualsiasi gestione che permetta di:
- gestire tabelle di database MYSQL anche combinate fra di loro
- produrre stampe da tabelle
- analizzare la struttura di tabelle 
- gestire templates per app gestionali e siti web
- gestire menù a due livelli e relative voci di menù
- gestire utenti con password e livello di accesso alle app
- definire tipologie particolari predefinite tramite apposita tabella
- configurare l'ambiente di lavoro e il database
- gestire templates per gestione amministrativa archivi e aspetto di siti web
- gestione documentazione basata su una struttura: argomento - capitoli - articoli

### Librerie di terze parti
- utilizzo del framework Bootstrap 3
- utilizzo della libreria Jquery

## LIBRERIA DI CLASSI
La cartella `libFB-2.0.0` contiene le classi sviluppate da FB che permettono di gestire:
- campi di input form

![fields][7] 

[7]: tutorial/fields.PNG

- toolbar con immagine - testo e bottoni di comando

![toolbar][4] 

[4]: tutorial/toolbar.png


## INSTALLAZIONE IN LOCALE (Da utilizzare quando la versione 2 sarà definitiva!)
Per installare la libreria in locale necessita:
- web server locale (Come ad esempio XAMPP, di seguito si fa riferimento a XAMPP)
- effettuare il `download.zip` del repository `FB-STD` 

![download][8] 

[8]: tutorial/download.png
- creare una cartella (Per esempio: `fb-std`) per contenere la libreria nella root del web server (Normalmente `htdocs`)
- copiarvi gli archivi decompressi del download.zip
- aprire il browser e digitare: `localhost/fb-std/installa/` che mostra il modulo per inserire i dati necessari all'installazione dell'app.

![installa][9] 

[9]: tutorial/installa.PNG

- compilare tutti i campi con i dati relativi alla vostra installazione con particolare attenzione a quelli relativi al database
- cliccare `OK` per avviare la creazione e, quando terminata, vengono mostrati i messaggi di ciò che è stato fatto

a questo punto aprire il browser e digitare: `localhost/fb-std/` e verrà mostrata la mappa di collegamento

![login][3] 

[3]: tutorial/login.PNG

digitare `admin` sia per utente che per password e accedere e viene mostrata la mappa iniziale con le due voci di menù che vengono mostrate di seguito esplose nelle relative sottovoci

![menu 1][2]                                                        

[2]: tutorial/menu-1.PNG                                            

![menu 2][1] 

[1]: tutorial/menu-2.PNG

selezionare la sottovoce `Backoffice -> utenti` e cambiare le password standard e aggiungere o eliminare utenti se necessario. 
