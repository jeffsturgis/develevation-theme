<?php /* Template Name: Pacman Tempalte */
$years_old = 35;
?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel='stylesheet' id='google-fonts-css'  href='https://fonts.googleapis.com/css?family=Montserrat%3A100%2C300%2C900&#038;ver=4.8.2' type='text/css' media='all' />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <script src="/wp-content/themes/develevation-theme/assets/js/TweenMax.min.js"></script>
    <script src="/wp-content/themes/develevation-theme/assets/js/plugins/MorphSVGPlugin.min.js"></script>
    <script src="/wp-content/themes/develevation-theme/assets/js/jquery.spaceBalls.js"></script>
    <script type='text/javascript' src='/wp-content/themes/develevation-theme/assets//midi.js'></script>
    
    <style>
      html, body, #page {width: 100%; height: 100%; margin: 0; padding: 0}
      #page { background: #085692; position: relative;}
      .bg-img {background-image: url(/wp-content/uploads/2017/10/jeff.svg); background-position: center; width: 100%; height: 100%; background-size: cover; position: absolute; z-index: 1; }
      #cake {width: 40%; left: 50%; transform: translateX(-50%) translateY(-42%); position: absolute; top: 50%; z-index: 2;}
      #cake svg {width: 100%; height: auto; }
      
      #cursor {color: #fff; font-size: 60px; position: absolute; top: 18%; display: inline-block;  left: 34%; transform: translateX(-50%); z-index: 3;}
      #bottom-link {position: absolute; bottom: 30px; right: 30px;  z-index: 150; display: none;}
      #bottom-link a {background: rgba(111, 172, 219, 0.7); padding: 20px; color: #fff; font-family: arial; line-height: 40px; text-decoration: none; font-family: 'Montserrat', sans-serif; border-radius: 3px;}
      #bottom-link a:hover {background: rgba(111, 172, 219, 1)}
      #carouselwrapper {height: 100vh;}
      .candle {position: absolute; z-index: 3; position: absolute; top: 25%; left: 50%; background: url('/wp-content/themes/develevation-theme/candle.svg'); background-size:cover; width: 15px; height: 120px; }
      .candle:before{
        positon:relative; top: -40px; background: #fff; padding: 0px; margin: 0px; content: ''; left: 50%; border: 0px solid #fff; border-radius: 25px;
        -webkit-animation: mymove 5s infinite; /* Safari 4.0 - 8.0 */
  animation: mymove 5s infinite;
      }
<?php
  $center = ['y' => 27, 'x' => 49];
  for($i = 1; $i <= $years_old; $i++){
    $angle = round((360 / $years_old) * $i, 0);
    $x = round(cos(deg2rad($angle))* 17)  +$center['x'];
    $y = round(sin(deg2rad($angle))* 18)  +$center['y'];
    
    echo '#candle' . $i . '{ left: ' . $x . '%; top: ' . $y . '%; z-index: ' . $y . '}' . "\n";
  }
  
?>
      @-webkit-keyframes mymove {
        50% {box-shadow: 10px 20px 30px #fff;}
      }
      
      @keyframes mymove {
        50% {box-shadow: 10px 20px 30px #fff;}
      }
    </style>
  </head>
  <body>
      
    <audio id="happy-bday-song"  loop>
      <source src="" type="audio/wav">      
      Your browser does not support the audio element.
    </audio>
    <div id="page">
      <div id="bottom-link"><a href="/skills">Move on</a></div>
      <div class="bg-img"></div>
      <div id="cake">
      <?php include("happy-birthday-adam.svg");?>  
      </div>
      
      <?php
      for($i = 1; $i <= $years_old; $i++){
        $x = round(cos(deg2rad($i))*40)+$center['x'];
        $y = round(sin(deg2rad($i))*20)+$center['y'];
        echo '<div id="candle' . $i . '" class="candle"></div>';
      }
      ?>
    </div>
    
    <script type="text/javascript">
      var cursorInterval;
      var tl, tl2, tl3;
      var originalPaths = [];
                       
      
      $(document).ready(function(){
        
      
        MIDIjs.initAll();
        MIDIjs.play('/wp-content/themes/develevation-theme/assets/sound/happy-birthday-adam.mid');
        
        
        
      });
    </script>
  </body>
</html>
