<?php

/**
 * 
 */
class SaludoTemplate extends Template
{
	
	function config()
	{
		$this->set_parent("layout");
	}
	function render(){?>
<a class="btn btn-sm" href="/logout/" style="box-shadow: 1px 3px;"><i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i></a>
<div class="container">
<h1 class="text-center  mt-3 mb-2">Control de Visitas</h1>
<div class="row" style="border-top: solid 1px  #007bff; border-radius: 3px;">
	<div class="col-md-6 text-center">
		<h5 class="text-center p-3 mt-3">Complejo Habitacional RPS</h5>
		<img class="img-fluid shadow-2-strong"  src="<?=  $this->T("user")->image  ?? $this->S("images/casita.png") ?>" style="box-shadow: 1px 3px; max-width: 80%; margin: 40px;background-color: white;">
	</div>

	<div class="col-md-6 text-center">
		<h4 class="text-center p-3 mt-3">Visita Registrada</h4>
		<h2 class="text-center p-3 mt-3">Gracias</h2> 
		<a class="btn btn-primary mt-3 text-center" href="/">Volver</a>

	</div>
</div>
</div>
<script type="text/javascript">
	setTimeout(function() {
		window.location = "/"
	}, 3000);
</script>


<?php
	}
}