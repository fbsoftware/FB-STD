<?php
echo	"<section id='contatti'>";
// pannello
		echo "<div class='f-flex fd-column fb-bgcolor-".TMP::$tcolor."'>"; 
		if (isset(TMP::$tcttit)) { echo "<h1>".TMP::$tcttit."</h1>"; } 
				if (isset(TMP::$tcttext)) { echo "<p>".TMP::$tcttext."</p>"; }
		echo "</div>";	
?>            
            <form id="contatti" method="post">
			
                <div class="col-xs-12 col-sm-6"> 
                      <div id="nome-block" class="form-group">
                        <label class="control-label" for="nome" id="nome-label">Nome (*) </label>
                        <input type="text" class="form-control" id="nome" placeholder="Inserisci Nome">
                        </div>
                </div>
                        
                <div class="col-xs-12 col-sm-6"> 
                      <div id="cognome-block" class="form-group">
                        <label class="control-label" for="cognome" id="cognome-label">Cognome (*) </label>
                        <input type="text" class="form-control" id="cognome" placeholder="Inserisci Cognome">
                      </div>
                </div>
                        
              <div class="col-xs-12 col-sm-6"> 
                  <div id="email-block" class="form-group">
                    <label class="control-label" for="email" id="email-label">Email (*) </label>
                    <input type="text" class="form-control" id="email" placeholder="Inserisci Email">
                  </div>
             </div>
                     
             <div class="col-xs-12 col-sm-6"> 
                  <div id="telefono-block" class="form-group">
                    <label class="control-label" for="telefono" id="telefono-label">Telefono </label>
                    <input type="text" class="form-control" id="telefono" placeholder="Inserisci Telefono">
                  </div>
            </div>
                    
                   
            <div class="col-xs-12 col-sm-12">
                <div id="messaggio-block" class="form-group">   
                    <label class="control-label" id="messaggio-label" for="messaggio"> Messaggio (*) </label><br>
                    <textarea style="width:100%; min-height:200px" id="messaggio" name="messaggio" maxlength="1500" placeholder="Inserisci Messaggio"></textarea>
                </div>
            </div>    
                    
            <div class="col-xs-12 col-sm-12 text-right"> 
		  	<span id="caratteriRimanenti">1500</span> caratteri rimanenti 
			  </div>
<!-- ================================================================================= -->
 <div class="row">                  
            <div class="col-xs-3 col-sm-3">
            	<div id="risultato-block" class="form-group">  
                    <input name="addendo1" type="text" id="addendo1" size="1" readonly="" value="1"> +   
                    <input name="addendo2" type="text" id="addendo2" size="1" readonly="" value="1"> =
                    <input name="risultato" type="text" id="risultato" size="2"> 
                    <label class="wide" id="risultato-label" for="risultato">Inserisci il risultato 
                  <br />Per dimostrare che sei un umano.</label>
                </div>
           </div>  
     
            <div class="col-xs-3 col-sm-3 text-center">    
                    <button id="submitButton" type="submit" style="min-width:200px" 
				class="btn-<?php echo TMP::$tcolor; ?> btn-lg">Invia</button>
            </div>
                    
             <div class="col-xs-6 col-sm-6">  
                  <div id="privacy-block" class="checkbox form-group">
                    <label class="wide" for="privacy" id="privacy-label">
                      <input type="checkbox" name="privacy" id="privacy">Acconsento al trattamento dei miei dati personali in base alle normative attualmente vigenti. </label>         
                 </div>
            </div> 
 		</div>     <!-- row --> 
<!-- ================================================================================= -->		       
		</form>
</section>