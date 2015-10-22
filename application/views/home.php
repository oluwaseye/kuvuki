    <div class="container" id="page">

   <!--  <div class="row visible-xs visible-sm">

    <div class="col-xs-12 col-sm-12">

    <div class="form-group">

       <form>

           <input type="text" class="form-control " placeholder="Search...">

       </form>

    </div>

    </div>

    </div> -->

    <div class="row">

    <a href="<?php echo $news_data_latest->link; ?>" target="_blank">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

    

<?php if($news_data_latest->thumbnail==''){?>    

 <div class="imgLiquidFill-latest imgLiquid" style="background-image:url('<?php echo $news_data_latest->ext_thumbnail; ?>'); background-size:cover;background-position:50% 50%; background-repeat:no-repeat;">    

</div>

    <?php }else{ ?> 

<?php $path= '../kuvfeeder/data/thumbnails/'.$news_data_latest->thumbnail;

$type = pathinfo($path, PATHINFO_EXTENSION);

$data = file_get_contents($path);

$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);



?>

  <div class="imgLiquidFill-latest imgLiquid" style="background-image:url('<?php echo $base64;?>'); background-size:cover;background-position:50% 50%; background-repeat:no-repeat;">     

  </div>

    <?php }?>

      

    </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

      <h2 class="featured-headline"><a href="<?php echo $news_data_latest->link; ?>" target="_blank"><?php echo $news_data_latest->title; ?></a></h2>

     <h6><span class="source"><?php echo $news_data_latest->sourcetitle; ?></span> |<span class="tag"> <?php echo $news_data_latest->tags; ?></span>

<span id="favicons">

     <?php $path= '../kuvfeeder/data/favicons/'.$news_data_latest->icon;

$type = pathinfo($path, PATHINFO_EXTENSION);

$data = file_get_contents($path);

$fav64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

 

?>

     <img src="<?php echo $fav64; ?>"/>

     </span>

     </h6>

        <p class="article-content"><?php echo $news_data_latest_description; ?>...</p>

    </div>

    </a>

    </div>



    <div class="row" id="container">

     

   <?php foreach($news_data as $news): ?>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item" id="item">

    <a href="<?php echo $news->link; ?>" target="_blank">

    

    <?php if($news->thumbnail==''){?>

    <div class="imgLiquidFill imgLiquid" style="background-image:url('<?php echo $news->ext_thumbnail; ?>'); background-size:cover;background-position:50% 50%; background-repeat:no-repeat;">

     

     </div>

    <?php }else{ ?> 

   

    <?php $path= '../kuvfeeder/data/thumbnails/'.$news->thumbnail;

$type = pathinfo($path, PATHINFO_EXTENSION);

$data = file_get_contents($path);

$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

 

?>

   <div class="imgLiquidFill imgLiquid" style="background-image:url('<?php echo $base64; ?>'); background-size:cover;background-position:50% 50%; background-repeat:no-repeat;">

    

    </div>

    <?php }?>

    

      <h3 class="headline"><a href="<?php echo $news->link; ?>" target="_blank"><?php echo $news->title; ?></a></h3>

      <div>

     <h6><span class="source"><?php echo $news->sourcetitle; ?></span> |<span class="tag"> <?php echo $news->tags; ?></span>

     <span id="favicons">

     <?php $path= '../kuvfeeder/data/favicons/'.$news->icon;

$type = pathinfo($path, PATHINFO_EXTENSION);

$data = file_get_contents($path);

$fav64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

 

?>

     <img src="<?php echo $fav64; ?>"/>

     </span></h6>

     </div>

        <p class="article-content"><?php echo $news->description; ?>...</p>

      </a>

       </div>





<?php endforeach; ?>





  



   

</div>

</div>

     <!-- /container -->







