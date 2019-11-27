
<script src="<?php echo FRONT_ROOT?>/views/js/sweetalert.min.js"></script>
<?php

   if(!empty($arrayOfErrors)){
      $arrayOfErrors = implode('\n',$arrayOfErrors);?>
      <script>
      var mensajeJS = '<?php echo $arrayOfErrors;?>';
      swal({
            title: "Cuidado",
            text: mensajeJS,
            icon: "warning"
      });
      </script>';
  <?php }?>


</body>
</html>
