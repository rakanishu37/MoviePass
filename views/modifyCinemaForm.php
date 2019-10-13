<?php
    //encima de este form cargue la variable y hago getDato en los hidden value
    echo '<pre>';
    print_r($cinema);
    echo '</pre>';
?>



Edite los campos deseados
<form action="<?php echo FRONT_ROOT?>cinema/update" method="post">

<?php
    include VIEWS."cinemaForm.php";
?>
<input type="hidden" name="name_unmodified" value="<?php echo $cinema->getName();?>">

<input type="hidden" name="id" value="<?php echo $cinemaID;?>">
<input type="hidden" name="address_unmodified" value="<?php echo $cinema->getAddress();?>">

<input type="hidden" name="capacity_unmodified" min="1"value="<?php echo $cinema->getCapacity();?>">

<input type="hidden" name="ticketPrice_unmodified" min="1"value="<?php echo $cinema->getTicketPrice();?>">

<select name="status" id="">
    <option value="1">Activo</option>
    <option value="0">Inactivo</option>
</select>


<br>
<button type="submit">Modificar cine</button>
</form>