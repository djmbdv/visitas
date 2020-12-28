<?php
class PaginatorTemplate extends Template{


	function render(){
		$c = $this->T("count");
		$p = $this->T("page");
		?>
		<ul class="pagination justify-content-center " >
  <li class="page-item <?= ($p - 1  < 1 )?"disabled":"" ?>" ><a class="page-link" href="page=<?=$p-1 ?>"  ><<</a></li>
  <?php
   for ($i = 0; $i*20 <  $c; $i++): ?>
  <li class="page-item <?=$p==($i+1)?"active":""?>">
  	<a class="page-link" href="page=<?=$i+1 ?>" ><?= $i+1 ?></a>
  </li>
<?php endfor; ?>
 <li class="page-item   <?= ($p > $c/20 )?"disabled":"" ?>">
 <a class="page-link" href="page=<?=$p+1 ?>">
 >>
 </a>
 </li>
 
</ul>
<?php
 	}
 }