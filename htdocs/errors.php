<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <small><?php  echo $error ?></small> <br>
  	<?php endforeach ?>
  </div>
<?php  endif ?>