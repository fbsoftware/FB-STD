<?php   ?>
<div class="<?php echo $iimgcol; ?>">
 <div>
 <a data-toggle="modal"  href="#artimg<?php echo $count; ?>">
  <img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive" title="<?php echo $iimgtit; ?>"> 
 </a> 
 </div>
<div>
<div class="modal fade"  role="dialog" id="artimg<?php echo $count; ?>">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="modal-title"><?php echo $iimgtit; ?></h4>
   </div>
   <div class="modal-body">
    <img src="<?php echo $iimg; ?>" alt="<?php echo $iimg; ?>" class="img-responsive">
   </div>
 </div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div><!-- .modal-fade --> 
</div>
</div><!-- .colonna -->

<?php    ?>
	
