<?php
class RegistroTemplate extends Template{

	function config(){
		$this->set_parent("layout");	
	}

	function render(){?>

<div class="container">
<h1 class="text-center">
Registro</h1>

<a href="/login"></a>
</div>
<?php 

	}
}