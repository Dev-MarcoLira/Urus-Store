<?php

  function setFlag($class, $status, $msg){

    echo (
      "<div id='myModal' class='$class'>

        <div class='modal-content $status'>
          <div class='modal-header'>
            <h2>$status</h2>
          </div>
          <div class='modal-body'>
            <p>$msg</p>
          </div>
        </div>

      </div>"
    );
  }
?>