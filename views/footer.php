<?php
   
   if(!empty($arrayOfErrors)){
      $arrayOfErrors = implode('\n',$arrayOfErrors);?>
      <script>
      var mensajeJS = '<?php echo $message;?>';
      swal({
            title: "Cuidado",
            text: mensajeJS,
            icon: "warning"
      });
      </script>';
  <?php }?>


</body>
</html>
