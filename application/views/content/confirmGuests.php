<div id="confirmGuests">
	<p id="totalGuests" class="hide"><?php echo $total ?></p>
	<div class="row confirm-container">
		<div class="col-md-4 offset-md-4 title-container">
			<h1 class="confirm-title">Confirmar</h1>
		</div>
		<form id="confirmForm" class="col-md-4 offset-md-4 confirm-square">
			<div class="row">
				<div class="col-md-11 offset-md-1 <?php if($total == 1) echo 'hide'; ?>">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" id="select_all" class="custom-control-input" <?php if($total == $total_confirmed) echo 'checked'; ?>>
						<label class="custom-control-label" for="select_all">Seleccionar todos</label>
					</div>
					<div style="width:90%;"><hr></div>
				</div>
				<div class="col-md-11 offset-md-1">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input checkbox" id="<?php echo $guest[0]->id_g ?>" name="<?php echo $guest[0]->id_g ?>" <?php if($guest[0]->confirmed == 1) echo 'checked'; ?>>
						<label class="custom-control-label" for="<?php echo $guest[0]->id_g ?>"><?php echo $guest[0]->name ?></label>
					</div>
					<!--<label><input type="checkbox" class="checkbox" name="<?php echo $guest[0]->id_g ?>" <?php if($guest[0]->confirmed == 1) echo 'checked'; ?> > <?php echo $guest[0]->name ?></label>-->
				</div>
				<?php
					$html = '';
					foreach ($companions as $companion) {
						$html = $html.'<div class="col-md-11 offset-md-1"><div class="custom-control custom-checkbox">';
						$html = $html.'<input type="checkbox" class="custom-control-input checkbox" name="'.$companion->id_c.'" id="'.$companion->id_c.'"';
						//$html = $html.'<label><input type="checkbox" class="checkbox" name="'.$companion->id_c.'"';
						if($companion->confirmed == 1)
							$html = $html.' checked';
						//$html = $html.'> '.$companion->name;
						$html = $html.'><label class="custom-control-label" for="'.$companion->id_c.'">'.$companion->name.'</label></div></div>';
					}
					echo $html;
				?>
				<div class="col-md-2 offset-md-4">
					<input type="submit" value="<?php if($total_confirmed > 0){
						if($total > 1){
							echo 'Confirmar '.$total_confirmed.'/'.$total;
						}else{
							echo 'Confirmar';
						}
					}else{
						if($total > 1){
							echo 'No podremos asistir';
						}else{
							echo 'No podré asistir';
						}
					} ?>" id="submitConfirmation" class="btn btn-secondary button-bottom">
				</div>
			</div>
		</form>
	</div>
</div>
