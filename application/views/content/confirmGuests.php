<div id="confirmGuests">
	<p id="totalGuests" class="hide"><?php echo $total ?></p>
	<div class="row">
		<div class="col-md-11 offset-md-1">
			<h1>Confirmar</h1>
		</div>
		<form id="confirmForm" class="col-md-12">
			<div class="row">
				<div class="col-md-11 offset-md-1 <?php if($total == 1) echo 'hide'; ?>">
					<label><input type="checkbox" id="select_all"<?php if($total == $total_confirmed) echo 'checked'; ?>> Seleccionar todos</label>
				</div>
				<div class="col-md-11 offset-md-1">
					<label><input type="checkbox" class="checkbox" name="<?php echo $guest[0]->id_g ?>" <?php if($guest[0]->confirmed == 1) echo 'checked'; ?> > <?php echo $guest[0]->name ?></label>
				</div>
				<?php 
					$html = '';
					foreach ($companions as $companion) {
						$html = $html.'<div class="col-md-11 offset-md-1">';
						$html = $html.'<label><input type="checkbox" class="checkbox" name="'.$companion->id_c.'"';
						if($companion->confirmed == 1)
							$html = $html.' checked';
						$html = $html.'> '.$companion->name;
						$html = $html.'</label></div>';
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
					} ?>" id="submitConfirmation" class="btn btn-primary">
				</div>
			</div>
		</form>
	</div>
</div>