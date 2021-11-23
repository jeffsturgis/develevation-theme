<?php /* Template Name: Pacman Tempalte */ ?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel='stylesheet' id='google-fonts-css'  href='https://fonts.googleapis.com/css?family=Montserrat%3A100%2C300%2C900&#038;ver=4.8.2' type='text/css' media='all' />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <script src="/wp-content/themes/develevation-theme/assets/js/TweenMax.min.js"></script>
    <script src="/wp-content/themes/develevation-theme/assets/js/plugins/MorphSVGPlugin.min.js"></script>
    <style>
      html, body, #page {width: 100%; height: 100%; margin: 0; padding: 0}
      #page { background: #085692; position: relative;}
      .bg-img {background-image: url(/wp-content/uploads/2017/10/jeff.svg); background-position: center; width: 100%; height: 100%; background-size: cover; position: absolute; z-index: 1; }
      #logo {cursor: pointer; width: 100%; left: 50%; transform: translateX(-50%) translateY(-70%); position: absolute; top: 50%; z-index: 2;}
      #logo svg {width: 100%; height: auto; }
      
      #cursor {color: #fff; font-size: 60px; position: absolute; top: 64%; display: inline-block;  left: 50%; transform: translateX(-50%); z-index: 3;}
      #bottom-link {position: absolute; bottom: 30px; right: 30px;  z-index: 150; display: none;}
      #bottom-link a {background: rgba(111, 172, 219, 0.7); padding: 20px; color: #fff; font-family: arial; line-height: 40px; text-decoration: none; font-family: 'Montserrat', sans-serif; border-radius: 3px;}
      #bottom-link a:hover {background: rgba(111, 172, 219, 1)}
    </style>
  </head>
  <body>
    <audio id="pacman-munch"  loop>
      <source src="" type="audio/wav">      
      Your browser does not support the audio element.
    </audio>
    <div id="page">
      <div id="bottom-link"><a href="/skills">Skip Intro</a></div>
      <div class="bg-img"></div>
      <div id="logo">
      <?php include("pacman.svg");?>  
      </div>
      <div id="cursor"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></div>
    </div>
    <script type="text/javascript">
      var cursorInterval;
      var tl, tl2, tl3;
      
      var chomp = new Audio("/wp-content/themes/develevation-theme/assets/sound/pacman_chomp.mp3");
      var chompCount = 0;
      chomp.addEventListener('ended', function() {
        chompCount++;
        if (chompCount > 3) {
          return;
        }
          this.currentTime = 0;
          this.play();
          
      }, false);
      
      
      var death = new Audio("/wp-content/themes/develevation-theme/assets/sound/pacman_death.mp3");
      $(document).ready(function(){
        var curPos = 0;
        var cursorPositions = [64, 55, 49];
        cursorInterval = setInterval(function(){
          $("#cursor").css("top", cursorPositions[curPos++] + "%");         
          curPos %= cursorPositions.length;
        }, 500);
        $("#logo").on("click", function(){
          $("#bottom-link").fadeIn(300);
          $("#logo").off("click");
          clearInterval(cursorInterval);
          $("#cursor").fadeOut(300);
          tl = new TimelineMax({onComplete: beginChomping});
          //tl.to("#path7515, #path7511, #path3103, #path7519, #path7517", 2, {morphSVG: "#path7177", ease: Elastic.easeOut.config(1, 1.3)}, 0);
          
          tl.to("#path7515", 1, {morphSVG: "#path7177", ease: Elastic.easeOut.config(1, 0.9)}, 0);
          tl.to("#path7511, #path4326, #path3103", 2, {morphSVG: "#path4326", ease: Elastic.easeOut.config(1, 1.1)}, 0);
          tl.to("#path7519, #path7517", 1, {morphSVG: "#path4328", ease: Elastic.easeOut.config(1, 0.5)}, 0);          
          
          tl.to("#path7511, #path4326, #path3103", 2, {morphSVG: "#path7177", ease: Elastic.easeOut.config(1, 1.3)}, 1);
          tl.to("#path7519, #path7517", 2, {morphSVG: "#path7177", ease: Elastic.easeOut.config(1, 0.6)}, 1);
          
          tl.to("#path3115, #path8909, #path8907, #path3017", 2, {morphSVG: "#path8892"}, 0);
          tl.to("#path3021", 2, {morphSVG: "#path8895"}, 0);
          tl.to("#path3025", 2, {morphSVG: "#path8897"}, 0);
          tl.to("#path3029, #path3033", 2, {morphSVG: "#path8899"}, 0);
          tl.to("#path3035", 2, {morphSVG: "#path8901"}, 0);
          tl.to("#path3047, #path3081", 2, {morphSVG: "#path8903"}, 0);
          
          function beginChomping(){
            $("#path4326, #path4328").hide();
            $("#path7515, #path7511, #path3103, #path7519, #path7517").hide();
            $("#path3115, #path8909, #path8907, #path3017, #path3021, #path3025, #path3029, #path3033, #path3035, #path3047, #path3081").hide();
            chomp.play();
            $("#layer2").show();
            tl2 = new TimelineMax({repeat:-1, yoyo:true});
            
            tl2.to("#path7177", 0.15, {morphSVG: "#path7281"}, 0);
            tl2.to("#path8903", 0.20, {opacity: 0}, 0);
            
            tl = new TimelineMax({onComplete: pacmanDeath });
            var tripTime = 3;
            tl.to("#path7177", tripTime, {x: 1000, ease:Linear.easeNone}, 0);
            tl.to("#g8876", tripTime, {x: -265, ease:Linear.easeNone}, 0);            
            tl.to("#path8892", 0.1, {opacity: 0},  (tripTime /6));
            tl.to("#path8895", 0.1, {opacity: 0},  2 *(tripTime /6));
            tl.to("#path8897", 0.1, {opacity: 0},  3 *(tripTime /6));
            tl.to("#path8899", 0.1, {opacity: 0},  4 *(tripTime /6));
            tl.to("#path8901", 0.1, {opacity: 0},  5 *(tripTime /6));
            tl.to("#path8903", 0.1, {opacity: 0},  tripTime);
            tl.to("#path7177", tripTime, {x: 1000, ease:Linear.easeNone}, 0);
          }
          
          function pacmanDeath(){
            
            
            tl2.stop();
            
            tl = new TimelineMax({paused: true, onComplete: function(){
              $("#layer5").hide();
              $("#layer7").show().fadeOut(50, function(){
                setTimeout(function(){
                  window.location = "/skills/";
                }, 500);
              });
              
              
            }});
            
            tl.to("#path10300", 0.55, {morphSVG: "#path10302"}, 0);
            tl.to("#path10300", 0.55, {morphSVG: "#path10304"});
            $("#path7177").delay(1000).fadeOut(0);
            $("#g8876").delay(1000).fadeOut(0, function(){$("#layer5").show();death.play(); tl.play();
                                            
                                            } );
            
          }
          
        });
        
        
        
        
      });
    </script>
  </body>
</html>
