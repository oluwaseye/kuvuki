//MASONRY FOR NEWS ITEMS
 var $container = $('#container');
 $container.imagesLoaded( function() {
        $container.masonry('reload',{
  // options
  itemSelector: '.item',
  layoutMode: 'fitRows'
})
});

//page loader
var nanobar = new Nanobar();
//move bar
nanobar.go( 30 ); // size bar 30%

// Finish progress bar
nanobar.go(100);

$(document).ready(function(){
   $(".imgLiquidFill").imgLiquid();
   $(".imgLiquidFill-latest").imgLiquid({
    fill: true
   });

   
});

