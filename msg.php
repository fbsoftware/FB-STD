<?php

// zona messaggi unificati
if(isset($_SESSION['esito'])) 
     {
     echo "<div class='row'>";
     echo "<div class='col-md-6'>";
     // errori

     if ($_SESSION['esito'] > -1  && $_SESSION['esito'] < 51)      // 0 - 50
          {
      echo "<div class='alert alert-danger'>";
          if ($_SESSION['esito'] == 0)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Operazione abortita per errori "; 
          if ($_SESSION['esito'] == 1)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Operazione invalida ";
          if ($_SESSION['esito'] == 2)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Operazione annullata dall'utente ";
          if ($_SESSION['esito'] == 4)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Effettuare una scelta ";
          if ($_SESSION['esito'] == 5)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Pagamento gi&agrave; effettuato";          
          echo "</div>";
          }  
               
     // successo
     if ($_SESSION['esito'] > 50  && $_SESSION['esito'] < 101)    // 51 - 100
          {
     echo "<div class='alert alert-success'>";
          if ($_SESSION['esito'] == 53) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Record cancellato";
          if ($_SESSION['esito'] == 54) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Record aggiunto";
          if ($_SESSION['esito'] == 55) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Record modificato";
          if ($_SESSION['esito'] == 56) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Immagine cancellata"; 
          if ($_SESSION['esito'] == 57) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Immagine caricata"; 
          if ($_SESSION['esito'] == 58) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Immagine scaricata";
          if ($_SESSION['esito'] == 59) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Record archiviato";
          if ($_SESSION['esito'] == 60) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;Record ripristinato";          
          echo "</div>";
          }

     // warning
     if ($_SESSION['esito'] > 100  && $_SESSION['esito'] < 151)    // 101 - 150
          {
      echo "<div class='alert alert-warning'>";
          if ($_SESSION['esito'] == 101)    echo "<img src='images/xdb.png' height=20 alt='nota'>&nbsp;&nbsp;Nota";
           echo "</div>";
          }      

     // info
     if ($_SESSION['esito'] > 150  && $_SESSION['esito'] < 201)    // 151 - 200
          {
     echo "<div class='alert alert-info'>";
          if ($_SESSION['esito'] == 151)     echo "<img src='images/info.png' height=20 alt='info'>&nbsp;&nbsp;Informazione";
          echo "</div>";
          }      

          echo "</div>";
          echo "</div>";
     unset($_SESSION['esito']);
     }
// zona messaggi unificati
if(isset($_SESSION['errore'])) 
     {
     echo "<div class='container'>";
     echo "<div class='row'>";
     echo "<div class='col-md-6'>";
     // errori

     if ($_SESSION['errore'] > -1  && $_SESSION['errore'] < 51)      // 0 - 50
          {
      echo "<div class='alert alert-danger'>";
          if ($_SESSION['errore0'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Codice mancante <br />"; 
          if ($_SESSION['errore1'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Importo nullo o negativo <br />";
          if ($_SESSION['errore2'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;E-mail invalida <br />";
          if ($_SESSION['errore3'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;URL invalida <br />";
          if ($_SESSION['errore4'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Descrizione mancante <br />";
          if ($_SESSION['errore5'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;Tipo mancante <br />";

          echo "</div>";
          }  

          echo "</div>";
          echo "</div>";

     unset($_SESSION['errore']);
     unset($_SESSION['errore0']);
     unset($_SESSION['errore1']);
     unset($_SESSION['errore2']);
     unset($_SESSION['errore3']);
     unset($_SESSION['errore4']);
     unset($_SESSION['errore5']);
     }               
    

?>