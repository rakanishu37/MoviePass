Elija el genero que quiera filtrar
<form action="<?php echo FRONT_ROOT?>movie/filterMovies" method="post">
<select name='filteredGenre'>
    <?php 
        foreach ($genreList as $genre) {  ?> 
        <option value="<?php echo $genre->getName() ?>"> <?php echo $genre->getName() ?></option>
    <?php } ?>
    </select>
<button type="submit">Filtrar</button>
</form>