<?php

// zona messaggi unificati
if(isset($_SESSION['esito'])) 
     {
     echo "<div class='col-md-6'>";
     // errori

     if ($_SESSION['esito'] > -1  && $_SESSION['esito'] < 51)      // 0 - 50
          {
      echo "<div class='alert alert-danger'>";
          if ($_SESSION['esito'] == 0)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$OP_DEL_ERR." "; 
          if ($_SESSION['esito'] == 1)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$OP_INV." ";
          if ($_SESSION['esito'] == 2)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$OP_ANN_UTE." ";
          if ($_SESSION['esito'] == 4)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$EFF_SCELTA." ";
          if ($_SESSION['esito'] == 5)      echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$PAG_EFFE." ";          
          echo "</div>";
          }  
               
     // successo
     if ($_SESSION['esito'] > 50  && $_SESSION['esito'] < 101)    // 51 - 100
          {
     echo "<div class='alert alert-success'>";
          if ($_SESSION['esito'] == 53) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$REC_CAN." ";
          if ($_SESSION['esito'] == 54) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$REC_ADD." ";
          if ($_SESSION['esito'] == 55) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$REC_MOD." ";
          if ($_SESSION['esito'] == 56) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$IMM_CAN." "; 
          if ($_SESSION['esito'] == 57) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$IMM_CAR." "; 
          if ($_SESSION['esito'] == 58) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$IMM_SCA." ";
          if ($_SESSION['esito'] == 59) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$REC_ARC." ";
          if ($_SESSION['esito'] == 60) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$REC_RIP." ";          
          if ($_SESSION['esito'] == 61) echo "<img src='images/ok.png' height=20 alt='ok'>&nbsp;&nbsp;".$TMP_SEL." ";          
 
 echo "</div>";
          }

     // warning
     if ($_SESSION['esito'] > 100  && $_SESSION['esito'] < 151)    // 101 - 150
          {
      echo "<div class='alert alert-warning'>";
          if ($_SESSION['esito'] == 101)    echo "<img src='images/xdb.png' height=20 alt='nota'>&nbsp;&nbsp;".$NOTA." "; 
           echo "</div>";
          }      

     // info
     if ($_SESSION['esito'] > 150  && $_SESSION['esito'] < 201)    // 151 - 200
          {
     echo "<div class='alert alert-info'>";
          if ($_SESSION['esito'] == 151)     echo "<img src='images/info.png' height=20 alt='info'>&nbsp;&nbsp;".$INFO." "; 
          echo "</div>";
          }      

          echo "</div>";
          echo "</div>";
     unset($_SESSION['esito']);
     }
// zona messaggi unificati
if(isset($_SESSION['errore'])) 
     {
     echo "<div class='col-md-6'>";
     // errori

     if ($_SESSION['errore'] > -1  && $_SESSION['errore'] < 51)      // 0 - 50
          {
      echo "<div class='alert alert-danger'>";
          if ($_SESSION['errore0'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_COD."<br />"; 
          if ($_SESSION['errore1'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_IMPO."<br />"; 
          if ($_SESSION['errore2'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_MAIL."<br />"; 
          if ($_SESSION['errore3'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_URL."<br />"; 
          if ($_SESSION['errore4'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_DESC."<br />"; 
          if ($_SESSION['errore5'] == 1)      
          echo "<img src='images/stop.png' height=20 alt='stop'>&nbsp;&nbsp;".$ERR_TIPO."<br />"; 
          echo "</div>";
          }  

          echo "</div>";
          echo "</div><br/>";

     unset($_SESSION['errore']);
     unset($_SESSION['errore0']);
     unset($_SESSION['errore1']);
     unset($_SESSION['errore2']);
     unset($_SESSION['errore3']);
     unset($_SESSION['errore4']);
     unset($_SESSION['errore5']);
     }               
    

?>