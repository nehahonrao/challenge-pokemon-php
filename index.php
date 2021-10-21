<?php  
 $pokemon='';
 $is_data = true;
if(empty($_GET['pokemon'])) {
  // Set random count for pokemon 
   
    $count='https://pokeapi.co/api/v2/pokemon-species';
    $datacount=file_get_contents($count);
    $pokemoncount=json_decode($datacount);
    $pokemon =rand(1,$pokemoncount->count);

}  
else {
  $pokemon = $_GET['pokemon'];
}

    $base="https://pokeapi.co/api/v2/pokemon/";
    $url=$base.$pokemon;
    $data=file_get_contents($url);
    $poke=json_decode($data);
   


    $species1=$poke->species;
    $url1=$species1->url;
    $data_evimg=file_get_contents($url1);
    $poke_evimg=json_decode($data_evimg);
    $species_name=$poke_evimg->evolves_from_species;
    if(empty($species_name->name) || $species_name->name == NULL  || $species_name->name == '') {
      $species_namefinal= '';
    }
    else {
    $species_namefinal=$species_name->name;
    $base1="https://pokeapi.co/api/v2/pokemon/";
    $img_species=$base1.$species_namefinal;
    $data1=file_get_contents($img_species);
    $poke_evolution=json_decode($data1);
    }    
  
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style/index.css">
  <title>Pokedex</title>
</head>

<body>
  <div class="pokedex">
    <div class="left-container">
      <div class="left-container__top-section">
        <div class="top-section__blue"></div>
        <div class="top-section__small-buttons">
          <div class="top-section__red"></div>
          <div class="top-section__yellow"></div>
          <div class="top-section__green"></div>
        </div>
      </div>
      <div class="left-container__main-section-container">
        <div class="left-container__main-section">
          <div class="main-section__white">
            <div class="main-section__black" id="res">
              <img src="<?php
              echo $poke->sprites->front_default;
              ?>" alt="pokemon" id="front-img" class="img-display">
              <div class="main-screen ">

              </div>
            </div>
          </div>
          <div class="left-container__controllers">
            <div class="controllers__d-pad">
              <div class="d-pad__cell top"></div>
              <div class="d-pad__cell left"></div>
              <div class="d-pad__cell middle"></div>
              <div class="d-pad__cell right"></div>
              <div class="d-pad__cell bottom"></div>
            </div>


            <form class="form" action="index.php" method="get">
              <p>Insert a Pokemon Name or ID</p>
              <input type="text" name="pokemon" class="textInput" id="userdata">
              <button type="submit" class="send" id="sub">Search</button>
            </form>


          </div>
        </div>   
        <div class="left-container__right">
          <div class="left-container__hinge"></div>
          <div class="left-container__hinge"></div>
        </div>
      </div>
    </div>



    <div class="right-container">
      <div class="id-name">
        <?php echo $poke->id;?></div>
      <div class="right-container__black">
       <div class="right-container__screen">
         <?php echo $poke->name; ?>
      </div>
    </div>

   <div class="right-container__buttons">
   <?php
     foreach ($poke->moves as $k => $move) {
     if($k<4){
      echo '<div class="left-button" id="lb1">'.$move->move->name.'</div>';
      }
   }
   ?>
   </div>

    <div class="right-container-bottom">
        <div class="eval1" id="e1">
        <img src="
        <?php

        if($species_namefinal){
          echo $poke_evolution->sprites->front_default;
        }else{
          echo "img/pok_ev.jpg";
        }
        ?>" alt="" id="eval-img1">
      </div>
     </div>

      <div class="right-container-bottom">
        <div class="eval-name3" id="ev-name2"><?php
        if($species_namefinal){
              echo $species_namefinal;
            }
          else{
              echo "Evolution";
            }
        ?></div>
      </div>


      <div class="right-container-bottom">
        <?php
        if($is_data){
        foreach ($poke->types as $key => $value) {
          if($key < 2){
            
            echo '<div class="eval-name1" id="ev-name">
            '.$value->type->name.'
            </div>';
          }
          }
        }else{
          echo '<div class="eval-name1" id="ev-name">TYPE </div>';
        }
        ?>
      </div>
    </div>

  </div>

</body>
</html>





