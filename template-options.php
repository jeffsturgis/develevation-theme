<?php /* Template Name: Options */
$optionData =  file_get_contents(dirname(__FILE__) . '/tsla-20220121-20200505.json');

?>
<script>

var optionData = <?php echo $optionData;?>;
console.log(optionData);
var currentStockPrice = 761.19;
for(k in optionData.payload.strikeQuotes){

        var strike = optionData.payload.strikeQuotes[k]['strikePrice'];
        var ask = optionData.payload.strikeQuotes[k]['quotes']['CALL']['ask'];
        var bid = optionData.payload.strikeQuotes[k]['quotes']['CALL']['bid'];
        var avg = bid - ((bid - ask)/2);
        var exVal = avg + strike;
        document.write(strike + ": " + ask + "/" + bid + "/" + avg + " ... " + exVal + "<br>");

1880+63.65


}
</script>
