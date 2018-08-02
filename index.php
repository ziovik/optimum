
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Optimum beauty</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style_index.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   
  <link href="css1/animate.css" rel="stylesheet"/>
  <link href="css1/waypoints.css" rel="stylesheet"/>

  <script src="main.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="js1/jquery.waypoints.min.js" type="text/javascript"></script>
  <script src="js1/waypoints.js" type="text/javascript"></script>
   
</head>
<body>
   <section class="intro">
       <div class="inner">
           <div class="content">
              <section class="os-animation" data-os-animation="bounceInUp" data-os-animation-delay=".1s">
                  <img id="ohnoes" src="img/logo_index.png">
                  <div id="info"></div>
              </section>
              <section class="os-animation" data-os-animation="bounceInUp" data-os-animation-delay="0s" style="padding-left: 250px;">
                  <div  id="link1" style="float: left; padding-right: 50px; ">
                     <a href="loading_d.php"  class="btn">Дистрибьютор</a><br><br>
                        
                  </div>
                  <div  id="link2" style="float: left;">
                    <a href="loading_c.php" class="btn">Заказчик</a><br><br>
                      
                  </div>
                 

             </section>
          </div>
       </div>

  </section>



<script>
  var infoDiv = document.getElementById("info");
  
  var countdown = document.getElementById("countdown");
  var countItDown = function() {
    var currentTime = parseFloat(countdown.textContent);
    if (currentTime > 0) {
       countdown.textContent = currentTime - 1;   
    } else {
        window.clearInterval(timer);
    }
    
  };
  var timer = window.setInterval(countItDown, 1000);
  
  // Step 1. What element do we want to animate?
  var ohnoes = document.getElementById("ohnoes");
  ohnoes.style.width = "50px";
  
  // Step 2. What function will change it each time?
  var startTime = new Date().getTime();
  var makeItBigger = function() {
      var currTime = new Date().getTime();
      var newWidth = (50 + ((currTime - startTime)/1000) * 90);
       ohnoes.style.width = newWidth + "px"; 
       
       if (newWidth < 300) {
           window.requestAnimationFrame(makeItBigger);
       }
    
  };
  makeItBigger();
  </script>
 
</body>
</html>