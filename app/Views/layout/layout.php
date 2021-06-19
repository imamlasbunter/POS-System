<?php 
    echo view('layout/Header');
  ?>



  <?php 
    echo view('layout/nav');
    echo view('layout/sidebar');
  ?>

 

  <?=$this->renderSection('content')?>


  <?php 
    echo view('layout/footer');
  ?>

 
