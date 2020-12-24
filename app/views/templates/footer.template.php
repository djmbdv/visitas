<?php

/**
 * 
 */
class FooterTemplate extends Template
{
	
	function config()
	{
		# code...
	}
	function render(){?>

      <footer class="pt-4 my-md-10 pt-md-10  border-top text-center">
        <div class="row">
          <div class="col-12 col-md">
            <h4 class="mb-2" > REMOTE PC SOLUTIONS </h4>
            <small class="d-block mb-3 text-muted">&copy; 2020</small>
          </div>
          
        </div>
      </footer>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>

<?php	}
}