<?php
class AccountTemplate extends Template{

	function config(){
		$this->set_parent("layout");
		$this->add_part("topbar","topbar");
		$this->add_part("campoNombre","campo",
		 array('name' => "Nombre" ,
		 		'autocomplete' => false,
		 		'required' => true,
		 		'label' =>"Nombre",
		 		'placeholder'=> "Nombre Completo",

		 		'clase'=> 'user',
		 		'value' => $this->T('user')->name,
		  )
		);
		$this->add_part("campoPassword","campo",
		 array('name' => "Nombre" ,
		 		'autocomplete' => false,
		 		'required' => true,
		 		'label' =>"Contraseña",
		 		'placeholder'=> "(Sin Cambio)",
		 		'form_type' => "password",
		 		'clase'=> 'user',
		 		'value' => "",
		  )
		);
		$this->add_part("campoTitulo","campo",
		 array('name' => "Titulo" ,
		 		'autocomplete' => false,
		 		'required' => true,
		 		'label' =>"Título",
		 		'placeholder'=> "Título",
		 		'clase'=> 'user',
		 		'value' => $this->T('user')->titulo
		  )
		);
	}

	function render(){
		$this->render_part("topbar"); 
		?>
<div class="container">
<form class="row" method="PUT" action="/dashboard/users">
	<h1 class="text-center">Account</h1>
	<?php $this->render_part("campoNombre");?>
	<?php $this->render_part("campoPassword");?>
	<?php $this->render_part("campoTitulo");?>
	<input type="submit" name="" value="Guardar">
</div>		
</div>
<?php 
	}
}
