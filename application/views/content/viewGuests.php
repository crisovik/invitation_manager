<div id="viewGuests">
	<div class="row">
		<div class="col-md-11 offset-md-1">
			<h1>Invitados</h1>
		</div>
		<div class="col-md-12">
			<?php
				$html = '<div class="row"><div class="col-md-2 offset-md-2"><h4>TOTAL</h4></div><div class="col-md-2"><h4>'.$confirmed.' / '.$total.'</h4></div></div>';
				foreach ($guests as $guest) {
					$html = $html.'<div class="row">';
					$html = $html.'<div class="col-md-2 offset-md-2"><p class="'.$guest['confirmed'].'">'.$guest['name'].'</p></div>';
					if ($guest['total'] > 1) {
						$html = $html.'<div class="col-md-2"><p><button type="button" class="btn btn-link" data-toggle="collapse" data-target="#id'.$guest['id_g'].'" aria-expanded="false" aria-controls="id'.$guest['id_g'].'">'.$guest['total_confirmed'].' / '.$guest['total'].'</button></p></div>';
					}else {
						$html = $html.'<div class="col-md-2"><p class="one-guest">'.$guest['total_confirmed'].' / '.$guest['total'].'</p></div>';
					}
					$html = $html.'</div><div class="row collapse" id="id'.$guest['id_g'].'">';
					foreach ($guest['companion'] as $companion) {
						$html = $html.'<div class="col-md-9 offset-md-3" ><p class="'.$companion['confirmed'].'">'.$companion['name'].'</p></div>';
					}
					$html = $html.'</div>';
				}
				$html = $html.'<div class="row"><div class="col-md-2 offset-md-2"><h4>TOTAL</h4></div><div class="col-md-2"><h4>'.$confirmed.' / '.$total.'</h4></div></div>';
				echo $html;
			?>
		</div>
	</div>
</div>