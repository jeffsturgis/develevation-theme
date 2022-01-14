<?php /* Template Name: Pacman Tempalte */ ?>
<html>
  <head>
    <title>DevElevation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel='stylesheet' id='google-fonts-css'  href='https://fonts.googleapis.com/css?family=Montserrat%3A100%2C300%2C900&#038;ver=4.8.2' type='text/css' media='all' />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <script src="/wp-content/themes/develevation-theme/assets/js/TweenMax.min.js"></script>
    <script src="/wp-content/themes/develevation-theme/assets/js/plugins/MorphSVGPlugin.min.js"></script>
    <script src="/wp-content/themes/develevation-theme/assets/js/jquery.spaceBalls.js"></script>
    <style>
      html, body, #page {width: 100%; height: 100%; margin: 0; padding: 0}
      #page { background: #085692; position: relative;}
      .bg-img {background-image: url(/wp-content/uploads/2017/10/jeff.svg); background-position: center; width: 100%; height: 100%; background-size: cover; position: absolute; z-index: 1; }
      #logo {cursor: pointer; width: 100%; left: 50%; transform: translateX(-50%) translateY(-70%); position: absolute; top: 50%; z-index: 2;}
      #logo svg {width: 100%; height: auto; }

      #cursor {color: #fff; font-size: 60px; position: absolute; top: 64%; display: inline-block;  left: 50%; transform: translateX(-50%); z-index: 3;}
      #like-my-balls {position: absolute; bottom: 30px; right: 50%;  z-index: 150; display: none; color: #fff; font-family: arial; }
      #bottom-link {position: absolute; bottom: 30px; right: 30px;  z-index: 150; display: none;}
      #bottom-link a {background: rgba(111, 172, 219, 0.7); padding: 20px; color: #fff; font-family: arial; line-height: 40px; text-decoration: none; font-family: 'Montserrat', sans-serif; border-radius: 3px;}
      #bottom-link a:hover {background: rgba(111, 172, 219, 1)}
      #hidden-link {position: absolute; bottom: 30px; left: 30px;  z-index: 150; ;}
      #hidden-link a {text-decoration: none}
      #carouselwrapper {height: 100vh;}
    </style>
  </head>
  <body>

    <audio id="pacman-munch"  loop>
      <source src="" type="audio/wav">
      Your browser does not support the audio element.
    </audio>
    <div id="page">

      <div id="like-my-balls">How do ya like deez Space Balls?</div>
      <div id="bottom-link"><a href="/skills">Move on</a></div>
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
        var explosionLeft = $("#g2993").offset().left + $("#g2993")[0].getBoundingClientRect().width;
        var explosionTop = $("#g2993").offset().top + $("#g2993")[0].getBoundingClientRect().height;
        var curPos = 0;
        var cursorPositions = [64, 55, 49];
        cursorInterval = setInterval(function(){
          $("#cursor").css("top", cursorPositions[curPos++] + "%");
          curPos %= cursorPositions.length;
        }, 500);
        $("#logo").on("click", function(){
          $(".bg-img").fadeOut(3000);
          $("#bottom-link").fadeIn(300);

          $("#logo").off("click");
          clearInterval(cursorInterval);
          $("#cursor").fadeOut(300);
          tl = new TimelineMax({onComplete: beginChomping});
          //tl.to("#path7515, #path7511, #path3103, #path7519, #path7517", 2, {morphSVG: "#path7177", ease: Elastic.easeOut.config(1, 1.3)}, 0);

          var paths = [];
          paths[0] = {"#path7515" : "#path7177"};
          paths[1] = {"#path7511, #path4326, #path3103" : "#path4326"};
          paths[2] = {"#path7519, #path7517" : "#path4328"};
          paths[3] = {"#path7511, #path4326, #path3103" : "#path7177"};
          paths[4] = {"#path7519, #path7517" : "#path7177"};
          paths[5] = {"#path3115, #path8909, #path8907, #path3017" : "#path8892"};
          paths[6] = {"#path3021" : "#path8895"};
          paths[7] = {"#path3025" : "#path8897"};
          paths[8] = {"#path3029, #path3033" : "#path8899"};
          paths[9] = {"#path3035" : "#path8901"};
          paths[10] = {"#path3047, #path3081" : "#path8903",};

          var randVals = [];
          for(i in paths){
            for(tweenFrom in paths[i]){
              var tweenTo = paths[i][tweenFrom];
              console.log(tweenFrom + " to " + tweenTo);
              var rand = Math.random();
              if (!randVals[tweenTo]) {
                randVals[tweenTo] = 0;
              }
              if (!randVals[tweenFrom]) {
                randVals[tweenFrom] = 0;
              }
              randVals[tweenTo] += rand;
              console.log(randVals[tweenTo]);
              tl.to(tweenFrom, 2, {morphSVG: tweenTo, ease: Elastic.easeOut.config(1, 0.9), delay: randVals[tweenTo]}, 0);
            }

          }
          console.log(randVals);


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
              var startPos = {clientX: explosionLeft, clientY: explosionTop};
              //{clientX:  ($(window).width() - $("#g2993").offset().left + $("#g2993").outerWidth()), clientY: ($(window).height() - $("#g2993").offset().top + $("#g2993").outerHeight())}
              //$("#layer7").show().fadeOut(50);
              $("#logo").hide();
              $("#page").append("<div id='carouselwrapper' ></div>");
              $('#carouselwrapper').spaceBalls(
                {
                  num_balls: 100,
                  background:  "rgba(8,86,146,.5)",
                  'ball_speed': .96,
                  'ball_colors': ["rgba(248,248,0, 1)" , "rgba(248,164,0, 1)", "rgba(202,248,0, 1)" ],
                  'composition': "lighten",
                  'startPos': startPos,

                }
              );
              $("#like-my-balls").fadeIn(300);
            }});

            tl.to("#path10300", 0.55, {morphSVG: "#path10302"}, 0);
            tl.to("#path10300", 0.55, {morphSVG: "#path10304"});
            $("#path7177").delay(1000).fadeOut(0);
            $("#g8876").delay(1000).fadeOut(0, function(){
              $("#layer5").show();death.play(); tl.play();

            });

          }

        });




      });
      window.onerror = function (msg, url, lineNo, columnNo, error) {
  alert(msg);

  return false;
}
    </script>
  </body>
</html>
