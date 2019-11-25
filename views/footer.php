<?php

   if(!empty($arrayOfErrors)){
      foreach($arrayOfErrors as $message) ?>
      <div class="message-container" id="message-container">
         <div class="message-content">
            <p><?= $message ?></p>
            <button id="button-close">Close</button>
         </div>
      </div>
      <script src="<? JS_PATH . "/message.js" ?> "></script>
      <script>
         openMessage();
      </script>
  <?php } ?>



</body>
</html>
