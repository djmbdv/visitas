<?php
class HomeTemplate extends Template{

	function config(){
		$this->set_parent("layout");	
	}

	function render(){
		/*
*/	$this->add_part("campoVisitado","campo",
		 array('name' => "visitado" ,
		 		'autocomplete' => true,
		 		'required' => true,
		 		'placeholder'=> "Nombre de la persona a visitar",
		 		'end_point'=> '/api/habitantes/',
		 		'autocomplete_att'=>'s',
		 		'add_class' => 'form-control-home'
		  )
		);
$this->add_part("campoApartamento","campo",
		 array('name' => "apartamento" ,
		 		'autocomplete' => true,
		 		'required' => true,
		 		'placeholder'=> "Apartamento a donde se dirige",
		 		'end_point'=> '/api/apartamentos/',
		 		'autocomplete_att'=>'s',
		 		'clase'=> 'apartamento',
		 		'add_class' => 'form-control-home'
		  )
		);

		?>

<a class="btn btn-sm" href="/logout/"><i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i></a>
<div class="container">
<h1 class="text-center  mt-3 mb-2">Control de Visitas</h1>
<div class="row" style="border-top: solid 1px  #007bff;">
	<div class="col-md-6 text-center">
		<h4 class="text-center p-3 mt-3">Complejo Habitacional RPS</h4>
		<img class="img-fluid shadow-2-strong"  src="<?=  $this->T("user")->image  ?? $this->S("images/casita.png") ?>" style="box-shadow: 1px 3px; max-width: 80%; margin: 40px;background-color: white;">
	</div>

	<div class="col-md-6">
		<h4 class="text-center p-3 mt-3">DATOS</h4> 
		<form action="/foto" method="post">
			<?php $this->render_part("campoApartamento");?>
			<?php $this->render_part("campoVisitado");?>
			<div class="form-group form-control-home">
				<input class="form-control " type="text" name="nombre" placeholder="Su Nombre y Apellido" required="" />
			</div>
			<div class="form-group form-control-home">
				<input class="form-control " type="text" name="identificacion" placeholder="Numero de Identificacion" required="" />
			</div>
			<div class="form-group form-control-home">
				<input class="form-control btn-primary" type="submit" name="" value="Tomar Foto" />
			</div>
		</form>
	</div>
</div>
<hr>
<div class="small text-center text-muted card p-2 m-2">
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