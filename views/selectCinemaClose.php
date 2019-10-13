Elija cine a cerrar
<form action="<?php echo FRONT_ROOT?>cinema/closeCinema" method="post">
    <!--Es muy parecido a chooseCinemaID pero en este solo muestra los cines activos -->
    <?php foreach($cinemaList as $cinema){ ?>
        <?php if($cinema->getStatus() == true){?>
            <label><?php echo $cinema->getName(); ?></label>
            <input type="radio" name="idCinema" id="" value="<?php echo $cinema->getId();?>"> 
        <?php }?>
    <?php }?>
    <button type="submit">Cerrar Cine</button>
</form>