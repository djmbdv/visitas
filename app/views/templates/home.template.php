<?php
class HomeTemplate extends Template{

	function config(){
		$this->set_parent("layout");	
	}

	function render(){?>

<div class="container">
<h1 class="text-center  mt-5">Administración de Visitas</h1>
<img src="<?= $this->S("images/casita.png") ?>" style="box-shadow: 1px 3px; border-radius: 30%; width: 200px; margin: 100px;">
<a class="btn" href="/login" style="box-shadow: 1px 3px;">Login</a>
<div class="lead text-center text-muted card p-2 m-2">
	<h2>Para prueba</h2>
	<p>usuario: <b>admin</b></p>
	<p>password: <b>1234</b></p>
</div>
</div>
<?php 

	}
}