<?php
?>
<style media="screen">
.fb-highlight
  {
    border: 1px solid #dad55e;
    border-radius: 10px;
  	background: #fffa90;
  	color: #777620;
}
.fb-error {
  border: 1px solid #f1a899;
  border-radius: 10px;
	background: #fddfdf;
	color: #5f3f3f;
}
</style>

<?php
// zona messaggi unificati
if(isset($_SESSION['esito']))
     {
	 echo	 "<div class='f-flex fd-row jc-start'>";

     // errori

     if ($_SESSION['esito'] > -1  && $_SESSION['esito'] < 51)      // 0 - 50
          {
      echo "<div class='fb-error'>";
          if ($_SESSION['esito'] == 0)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$OP_DEL_ERR."</p>" ;
          if ($_SESSION['esito'] == 1)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$OP_INV."</p>";
          if ($_SESSION['esito'] == 2)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$OP_ANN_UTE."</p>";
          if ($_SESSION['esito'] == 4)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$EFF_SCELTA."</p>";
          if ($_SESSION['esito'] == 5)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$PAG_EFFE."</p>";
          if ($_SESSION['esito'] == 6)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;Tipo file NON csv</p>";
          if ($_SESSION['esito'] == 7)      echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/attenzione.png' alt='attenzione' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;File troppo grande
		</p>";

          echo "</div>";

          }

     // successo
     if ($_SESSION['esito'] > 50  && $_SESSION['esito'] < 101)    // 51 - 100
          {
     echo "<div class='fb-highlight'>";
          if ($_SESSION['esito'] == 53) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$REC_CAN."</p>";
          if ($_SESSION['esito'] == 54) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$REC_ADD."</p>";
          if ($_SESSION['esito'] == 55) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$REC_MOD."</p>";
          if ($_SESSION['esito'] == 56) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$IMM_CAN."</p>";
          if ($_SESSION['esito'] == 57) echo "<p class='fb-p1'><<img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$IMM_CAR."</p>";
          if ($_SESSION['esito'] == 58) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$IMM_SCA."</p>";
          if ($_SESSION['esito'] == 59) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$REC_ARC."</p>";
          if ($_SESSION['esito'] == 60) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;".$REC_RIP."</p>";
          if ($_SESSION['esito'] == 61) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;<strong>Attenzione!</strong>&nbsp;&nbsp;".$TMP_SEL."</p>";
           if ($_SESSION['esito'] == 62) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		&nbsp;&nbsp;<strong>File CSV esportato!</strong>";
    if ($_SESSION['esito'] == 63) echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
      &nbsp;&nbsp;<strong>File CSV caricato!</strong>";
 echo "</div>";
          }

     // warning
     if ($_SESSION['esito'] > 100  && $_SESSION['esito'] < 151)    // 101 - 150
          {
      echo "<div class='fb-highlight'>";
          if ($_SESSION['esito'] == 101)    echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
          &nbsp;&nbsp;".$NOTE."</p>";
           echo "</div>";
          }

     // info
     if ($_SESSION['esito'] > 150  && $_SESSION['esito'] < 201)    // 151 - 200
          {
     echo "<div class='fb-highlight'>";
          if ($_SESSION['esito'] == 151)     echo "<p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
            &nbsp;&nbsp;".$INFO."</p>";
          echo "</div>";
          }

     unset($_SESSION['esito']);
     }





// zona messaggi unificati
if(isset($_SESSION['errore']))
     {
     // errori

     if ($_SESSION['errore'] > -1  && $_SESSION['errore'] < 51)      // 0 - 50
          {
          if ($_SESSION['errore0'] == 1)
		  echo "<div class='fb-error'>
          <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
          <strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_COD."</div>";

          if ($_SESSION['errore1'] == 1)
			echo "<div class='fb-error'>
          <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		<strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_IMPO."</div>";

          if ($_SESSION['errore2'] == 1)
          echo "<div class='fb-error'>
              <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		<strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_MAIL."</div>";

          if ($_SESSION['errore3'] == 1)
          echo "<div class='fb-error'>
              <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		<strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_URL."</div>";

          if ($_SESSION['errore4'] == 1)
          echo "<div class='fb-error'>
              <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		<strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_DESC."</div>";

          if ($_SESSION['errore5'] == 1)
		  echo "<div class='fb-error'>
          <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
		<strong>Attenzione!</strong>&nbsp;&nbsp;".$ERR_TIPO."</div>";

    if ($_SESSION['errore6'] == 1)
echo "<div class='fb-error'>
    <p class='fb-p1'><img src='https://fbsoftware.github.io/FB-CODE/images/info.png' alt='info' height='25' />
<strong>Attenzione!</strong>&nbsp;&nbsp;Limiti di cancellazione errati!</div>";
          }


require('unset_errori.php');
     }
     echo "</div>";		// flex

?>
