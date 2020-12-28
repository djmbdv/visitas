<?php
class HomeTemplate extends Template{

	function config(){
		$this->set_parent("layout");	
	}

	function render(){?>
<a class="btn text-left" href="/login" style="box-shadow: 1px 3px;">Login</a>
<div class="container">
<h1 class="text-center  mt-3 mb-2">Control de Visitas</h1>
<div class="row" style="border-top: solid 1px  #007bff; border-radius: 3px;">
	<div class="col-md-6 text-center">
		<h5 class="text-center p-3 mt-3">Complejo Habitacional RPS</h5>
		<img class="img-responsive p-2" src="<?= $this->S("images/casita.png") ?>" style="box-shadow: 1px 3px;  border-radius: 10%; max-width: 100%; margin: 80px;background-color: white;">
	</div>

	<div class="col-md-6">
		<h5 class="text-center p-3 mt-3">DATOS</h5> 
		<form action="/foto" method="post">
			<div class="form-group">
				<input class="form-control form-control-home" type="text" name="apartamento" placeholder="Apartemento a Visitar" required="" />
			</div>
			<div class="form-group autocomplete">
				<input id="inputVisitado" class="form-control form-control-home" type="text" name="visitado" placeholder="Nombre de la persona a visitar" required="" autocomplete="off" />
			</div>
			<div class="form-group">
				<input class="form-control  form-control-home" type="text" name="nombre" placeholder="Su Nombre y Apellido" required="" />
			</div>
			<div class="form-group">
				<input class="form-control form-control-home" type="text" name="identificacion" placeholder="Numero de Identificacion" required="" />
			</div>
			<div class="form-group">
				<input class="form-control btn-primary" type="submit" name="" value="Tomar Foto" />
			</div>
		</form>
	</div>
</div>
<div class="lead text-center text-muted card p-2 m-2">
	<h2>Para prueba</h2>
	<h5>Dashboard Cliente</h5>
	<p>usuario: <b>cliente</b></p>
	<p>password: <b>1234</b></p>
	<h5>Dashboard Admin</h5>
	<p>usuario: <b>admin</b></p>
	<p>password: 1234</p>
</div>
</div>
<?php 

	}
}