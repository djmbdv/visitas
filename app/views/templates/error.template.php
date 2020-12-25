<?php
class ErrorTemplate extends Template
{
	
	function config()
	{
		$this->set_parent("layout");
	}
	function render(){?>
	<div class="container">
		<h1>Error 404</h1>
	</div>
	<?php
	}
}