<?php foreach($cinemaList as $cinema){ ?>
    <label><?php echo $cinema->getName(); ?></label>
    <input type="radio" name="idCinema" id="" value="<?php echo $cinema->getId();?>"> 
<?php }?>

