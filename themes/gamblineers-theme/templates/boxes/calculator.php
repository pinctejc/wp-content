<!-- <img src="<?php echo CF_DIST_IMAGES; ?>placeholders/bonus-calculator.png" alt=""> -->

<div id="calc-envelope" class="calc-envelope mw-100"> <span class="how-does-the-calc-work">?<span class="how-does-the-calc-work-text"><div>This calculator uses basic math to determine your odds of winning or losing any money while using casino bonuses.</div><div>All results displayed by the calculator are theoretical, which means if a lot of players used a bonus according to the input quantities, their averaged outcome should approach the calculator's result.</div><div>You should always keep in mind that gambling your money involves a certain risk and no result produced by this calculator can guarantee you a winning scenario.</div><div>This calculator has been developed and is owned exclusively by Gamblineers. Any unauthorised distribution of the calculator is strictly prohibited.</div> </span></span><h2 class="h3 mt-20 mb-10 tc-w ta-c calc-heading"> Bonus Calculator</h2><div class="author"> by <img loading="lazy" src="https://gamblineers.com/wp-content/uploads/2021/04/Logo_90x15_white.png" width="90" height="15" alt="Gamblineers logo"></div><form name="gamblineers-calc"><table class="calc-table"><tbody><tr><td width="50%"><label for="bonus-type">Bonus type: <span class="pink">*</span></label></td><td width="50%"><select id="bonus-type" name="bonus-type"><option class="item-1" value="none">--Select--</option><option value="no-deposit">No deposit (free spins)</option><option value="match">Match (deposit) bonus</option><option value="faucet">Faucet bonus</option> </select></td></tr><tr class="conditional match"><td width="50%"><label for="match-percent">Match bonus %: <span class="pink">*</span></label></td><td width="50%"><input type="number" id="match-percent" name="match-percent"></td></tr><tr class="conditional match faucet"><td width="50%"><label for="amount">Maximum bonus amount (USD): <span class="pink">*</span></label></td><td width="50%"><input type="number" id="amount" name="amount"></td></tr><tr class="conditional match no-deposit"><td width="50%"><label for="fs-no">Free spins amount:<span class="conditional no-deposit pink">*</span></label></td><td width="50%"><input type="number" id="fs-no" name="fs-no"></td></tr><tr class="conditional match"><td width="50%"><label for="wagering-on">Wagering on:</label></td><td width="50%"><select id="wagering-on" name="wagering-on"><option value="bonus">Bonus</option><option value="deposit">Deposit</option><option value="bonus-deposit">Bonus and deposit</option> </select></td></tr><tr class="conditional match no-casino"><td width="50%"><label for="match-wagering">Match bonus wagering:<span class="pink">*</span></label></td><td width="50%"><input type="number" id="match-wagering" name="match-wagering"></td></tr><tr class="conditional match no-deposit fs-wagering"><td width="50%"><label for="fs-wagering">Free spins wagering:<span class="conditional no-deposit pink">*</span></label></td><td width="50%"><input type="number" id="fs-wagering" name="fs-wagering"></td></tr><tr class="conditional no-deposit match fs-wagering"><td width="50%"><label for="fs-rtp">RTP of the free spins game: <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text"><div>= 100 % - house edge</div><div>For the game with the free spins.</div><div><a href="https://gamblineers.com/how-to-find-rtp/"><u>How to find RTP?</u></a></div></span></span></label></td><td width="50%"><input type="number" id="fs-rtp" name="fs-rtp"></td></tr><tr class="conditional match"><td width="50%"><label for="deposit-amount">Your deposit (USD): <span class="pink">*</span></label></td><td width="50%"><input type="number" id="deposit-amount" name="deposit-amount"></td></tr><tr><td width="50%"><label for="rtp">RTP of the game you will play: <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text"><div>= 100 % - house edge</div><div>For the game you will play with the bonus money.</div><div><a href="https://gamblineers.com/how-to-find-rtp/"><u>How to find RTP?</u></a></div></span></span></label></td><td width="50%"><input type="number" id="rtp" name="rtp"></td></tr><tr class="conditional match no-deposit"><td width="50%"><label for="game-contribution">Game contribution to wagering (in %): <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text"><div>Not all games contribute in full to wagering.</div><div><a href="https://gamblineers.com/bitcoin-casino-bonuses/#wagering-contribution"><u>Read more here</u></a></div></span></span></label></td><td width="50%"><input type="number" id="game-contribution" name="game-contribution"></td></tr></tbody></table><div class="buttons"> <button type="button" class="calculate-button" onclick="calculateFunction()">CALCULATE</button> <button type="reset" class="reset-button" onclick="calculateFunction()">RESET</button></div></form><div id="result" class="result"><div id="temp-result" class="temp-result"><strong>RESULT WILL BE DISPLAYED HERE...</strong></div> <span id="actual-result" class="conditional"><div id="default-values"></div><div><strong>ALL PLAYING MONEY: </strong><span id="all-playing-money"></span> <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text"><div><strong>Deposit: </strong><span id="deposit-result"></span></div><div><strong>Match bonus: </strong><span id="bonus-result"></span></div><div><strong>Free spins bonus: </strong><span id="fs-bonus-result"></span></div><div><strong>Faucet bonus: </strong><span id="faucet-result"></span></div> </span></span></div><div class="wagering-amount"><strong>AMOUNT TO WAGER: </strong><span id="wagering-amount"></span> <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text"><div><strong>From bonus: </strong><span id="bonus-wager"></span></div><div><strong>From deposit: </strong><span id="deposit-wager"></span></div><div><strong>From free spins: </strong><span id="fs-wager"></span></div> </span></span></div><div class="money-left"><strong>AFTER WAGERING: </strong><span id="money-left"></span></div><div><strong>= WINS: </strong><span id="wins"></span> <span class="calc-tooltip-box"> ? <span class="calc-tooltip-text">Wins are any money left on top of your deposit at the end.</span></span></div><div class="losses"><strong>= LOSSES: </strong><span id="losses"></span></div><div id="verdict" class="conditional match no-deposit verdict"></div><div id="recommended" class="conditional match no-deposit"></div> </span></div></div>
<div class="d-n"><?php echo get_option( 'options_tablepress', true ); ?></div>
<style>
  .calc-envelope{z-index:999;top:0;margin:auto;position:relative;width:370px;border-radius:20px;background-color:#272a2f;padding:25px 35px 35px 35px;font-size:16px;color:white!important}.author{font-size:12px;text-align:right;margin-bottom:20px;color:white!important}.pink{color:#e21284;font-size:20px}.calc-envelope input,.calc-envelope select{max-width:130px;border:none;border-radius:5px;padding:10px;background-color:#1d2024;color:white!important;box-shadow:inset 3px 3px 10px 1px #17191c,3px 2px 10px 1px #3a3f46;margin-bottom:10px}.calc-envelope input[type='number']{max-width:130px;border:none;border-radius:5px;padding:10px;background-color:#1d2024;color:#fff;box-shadow:inset 3px 3px 10px 1px #17191c,3px 2px 10px 1px #3a3f46;margin-bottom:10px}.calc-envelope td:nth-child(2){text-align:right;max-width:120px;margin:0;padding:0;border-bottom:0}.calc-envelope td:nth-child(1){line-height:17px;margin:0;padding:0;border-bottom:0}.buttons{margin:20px 0;border-bottom:3px solid #6f6f6f;padding-bottom:20px;text-align:center}.calculate-button, .reset-button{width:165px;border-width:0!important;border-radius:5px!important;padding:10px 0!important;color:white!important;font-size:15px;letter-spacing:2.5px!important;font-weight:700;background:linear-gradient(90deg,#a067dd 0%,#6b11c9 100%);box-shadow:inset 3px 3px 10px 1px #3a3f46,5px 5px 10px 1px #17191c;outline:none}.reset-button{width:120px;background:linear-gradient(90deg,#2f3238 0%,#222429 100%);box-shadow:inset 3px 3px 10px 1px #3a3f46,5px 5px 10px 1px #17191c;margin-left:5px}.conditional{display:none}.calc-tooltip-box{position:relative;display:inline-block;background-color:#6b11c9;padding:1px 6px;border-radius:10px;text-align:center;font-weight:500}.calc-tooltip-box .calc-tooltip-text {
	visibility: hidden; width:180px;background-color:#f5f5f5;border:2px solid #303030;border-radius:5px;margin:3px;padding:5px;color:#303030;font-size:14.5px;position:absolute;z-index:9999;top:15px;right:-90px;font-weight:300}.calc-tooltip-box:hover .calc-tooltip-text {
	visibility: visible;}/* how does the calculator work */
.how-does-the-calc-work {width: 35px; height: 35px;display: flex; align-items: center; justify-content: center;
	position: absolute; top:10px;right:10px;color:#e21284;font-size:20px;font-weight:700;padding:0 9px;border:4px solid #e21284;border-radius:50px}.how-does-the-calc-work div{margin-bottom:10px}.how-does-the-calc-work .how-does-the-calc-work-text {
	visibility: hidden; width:320px;background-color:#272a2f;border:4px solid #6b11c9;border-radius:5px;margin:3px;padding:15px;color:#fff;font-size:14.5px;position:absolute;z-index:9999;top:0;right:5px;line-height:18px;font-weight:300}.how-does-the-calc-work:hover .how-does-the-calc-work-text {
	visibility: visible;}.result{border-radius:5px;background:linear-gradient(90deg,#2f3238 0%,#222429 100%);box-shadow:inset 3px 3px 10px 1px #3a3f46,14px 14px 8px 8px #17191c;padding:10px;line-height:17px}.money-left,.wagering-amount{margin-top:15px}.losses{margin-bottom:15px}.warning{padding-top:15px;font-size:12px;text-align:center}#default-values{font-size:12px;padding-bottom:15px;font-style:italic;line-height:15px}.no-deposit-disclaimer{font-size:12px}.temp-result{min-height:75px;text-align:center;vertical-align:middle}#tablepress-69{display:none}.recommended-bonus{display:inline-block;width:130px;vertical-align:middle;text-align:center;margin:20px 0}.recommended-bonus.right{width:130px;margin-left:10px;text-align:left;line-height:18px}.wagering-on{font-size:12px}.play-button{margin:5px;padding:7px;border-radius:20px;background:rgb(107,17,201);background:linear-gradient(90deg,rgba(107,17,201,1) 0%,rgba(226,18,132,1) 100%);text-align:center;vertical-align:middle;color:#fff;letter-spacing:1px}.recommended-bonus a img{background:radial-gradient(#6f6f6f 0%,rgba(0,0,0,0) 80%)}.warning{line-height:15px}.wagering-on-table{width:100%}.wagering-on-table tr td{width:30%;padding-right:5px;text-align:left;border-bottom:0}
</style>
<script>var calc_envelope = document.getElementById("calc-envelope");
// SHOW OR HIDE ELEMENTS BASED ON BONUS TYPE
document.getElementById('bonus-type').addEventListener('change', function (e) {
// FOR MATCH BONUS TYPE
if (e.target.value === "match") {
var y = document.getElementsByClassName("no-deposit");
for (var j = 0; j < y.length; j++) {
y[j].style.display = 'none';
}
var z = document.getElementsByClassName("faucet");
for (var k = 0; k < z.length; k++) {
z[k].style.display = 'none';
}
var x = document.getElementsByClassName("match");
for (var i = 0; i < x.length; i++) {
x[i].style.display = 'table-row';
}
}
// FOR NO DEPOSIT BONUS TYPE
if (e.target.value === "no-deposit") {
var x = document.getElementsByClassName("match");
for (var i = 0; i < x.length; i++) {
x[i].style.display = 'none';
}
var z = document.getElementsByClassName("faucet");
for (var k = 0; k < z.length; k++) {
z[k].style.display = 'none';
}
var y = document.getElementsByClassName("no-deposit");
for (var j = 0; j < y.length; j++) {
y[j].style.display = 'table-row';
}
}
// FOR FAUCET BONUS TYPE
if (e.target.value === "faucet") {
var x = document.getElementsByClassName("match");
for (var i = 0; i < x.length; i++) {
x[i].style.display = 'none';
}
var y = document.getElementsByClassName("no-deposit");
for (var j = 0; j < y.length; j++) {
y[j].style.display = 'none';
}
var z = document.getElementsByClassName("faucet");
for (var k = 0; k < z.length; k++) {
z[k].style.display = 'table-row';
}
}
});
// show wagering for free spins and free spins rtp only if there is >0 free spins:
var fs_no = document.getElementById('fs-no');
function blr(){
var ab = fs_no.value;
var fs_w = document.getElementsByClassName("fs-wagering");
if (isNaN(ab) || ab == "" || ab <= 0){
for (var fs = 0; fs < fs_w.length; fs++) {
fs_w[fs].style.display = 'none';
}
} else {
for (var fs = 0; fs < fs_w.length; fs++) {
fs_w[fs].style.display = 'table-row';
}
}
}
fs_no.addEventListener("blur",blr);
// CALCULATE ODDS AND WINS/LOSSES
function calculateFunction() {
var loss = 0;
var type = document.getElementById('bonus-type').value;
var wins = 0;
var deposit = 0;
var money_left = 0;
var wagering_amount = [0,0,0]; //bonus, deposit, fs
var datatable = document.getElementById('tablepress-69');
var element = document.getElementById('recommended');
var default_values = "* ";
var error = "";
if (type === "none") {error = error + "<br />- bonus type";}
element.innerHTML = "";
// find out where first deposit bonuses start in datatable
var firstdeplimit = 0;
for (var j = 1; j < datatable.rows.length; j++) {
if (datatable.rows.item(j).cells.item(4).innerHTML == "First deposit") {
firstdeplimit = j;
break;
}
}
if (type === "match") {
var percent = document.getElementById('match-percent').value;
var amount = document.getElementById('amount').value;
var no_spins = document.getElementById('fs-no').value;
var wagering = document.getElementById('match-wagering').value;
var wagering_on = document.getElementById('wagering-on').value;
var fs_wagering = document.getElementById('fs-wagering').value;
deposit = document.getElementById('deposit-amount').value;
document.getElementById('deposit-result').innerHTML = deposit + " USD";
var rtp = document.getElementById('rtp').value;
var fs_rtp = document.getElementById('fs-rtp').value;
var contribution = document.getElementById('game-contribution').value/100;
var fs_value = 0.2;
var deviation = 999999999;
var result = 0;
var deviation2 = 999999999;
var result2 = 0;
var bonus = 0;
if(percent/100*deposit > amount) {
bonus = amount;
} else {
bonus = percent/100*deposit;
}
// check for errors and set default values
if (percent == "" || isNaN(Number(percent))) {error = error + "<br />- match bonus %";}
if (amount == "" || isNaN(Number(amount))) {error = error + "<br />- max. bonus amount";}
if (wagering == "" || isNaN(Number(wagering))) {error = error + "<br />- match bonus wagering";}
if (deposit == "" || isNaN(Number(deposit))) {error = error + "<br />- deposit";}
if ((fs_wagering == "" || isNaN(Number(fs_wagering))) && no_spins != "") {
fs_wagering = wagering;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "Free spins wagering was set to " + wagering + "x";
}
if (rtp == "" || isNaN(Number(rtp))) {
rtp = 97;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "RTP was set to " + rtp + "%";
}
if ((fs_rtp == "" || isNaN(Number(fs_rtp))) && no_spins != "") {
fs_rtp = 97;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "Free spins game RTP was set to " + fs_rtp + "%";
}
if (contribution == "" || isNaN(Number(contribution))) {
contribution = 1;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "Game contribution was set to " + contribution*100 + "%";
}
if (default_values != "* ") {document.getElementById('default-values').innerHTML = default_values + ".";}
// get the 2 recommended first deposit bonuses
for (var i = firstdeplimit; i < datatable.rows.length; i++) {
var fsnoT = datatable.rows.item(i).cells.item(8).innerHTML*1;
var fsnod = no_spins;
if (no_spins == 0) { fsnod = 0.001; }
var fswT = datatable.rows.item(i).cells.item(10).innerHTML*1
var fswd = fs_wagering;
if (fs_wagering == 0) { fswd = 0.001; }
var bonusperT = datatable.rows.item(i).cells.item(6).innerHTML*1;
var bonusperd = percent;
if (percent == 0) { bonusperd = 0.001; }
var bonusT = datatable.rows.item(i).cells.item(7).innerHTML*1;
var bonusd = bonus;
if (bonus == 0) { bonusd = 0.001; }
var bwT = datatable.rows.item(i).cells.item(9).innerHTML*1;
var bwd = wagering;
if (wagering == 0) { bwd = 0.001; }
var wonT = datatable.rows.item(i).cells.item(11).innerHTML;
var wonr = 1;
if (wonT == wagering_on) {wonr = 0;}
// first first deposit bonus
if ((Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd + Math.abs(percent-bonusperT)/bonusperd + Math.abs(bonus-bonusT)/bonusd + Math.abs(wagering-bwT)/bwd + wonr)/6 < deviation) {
deviation = (Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd + Math.abs(percent-bonusperT)/bonusperd + Math.abs(bonus-bonusT)/bonusd + Math.abs(wagering-bwT)/bwd + wonr)/6;
result = i;
}
// second first deposit bonus
if ((Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd + Math.abs(percent-bonusperT)/bonusperd + Math.abs(bonus-bonusT)/bonusd + Math.abs(wagering-bwT)/bwd + wonr)/6 < deviation2 && (Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd + Math.abs(percent-bonusperT)/bonusperd + Math.abs(bonus-bonusT)/bonusd + Math.abs(wagering-bwT)/bwd + wonr)/6 > deviation) {
deviation2 = (Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd + Math.abs(percent-bonusperT)/bonusperd + Math.abs(bonus-bonusT)/bonusd + Math.abs(wagering-bwT)/bwd + wonr)/6;
result2 = i;
}
}
// format first result
var bonus_text = '';
if (datatable.rows.item(result).cells.item(4).innerHTML == "No deposit") {
bonus_text = bonus_text + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x';
} else {
bonus_text = datatable.rows.item(result).cells.item(6).innerHTML + " % up to " + datatable.rows.item(result).cells.item(12).innerHTML;
if (datatable.rows.item(result).cells.item(8).innerHTML != "") {
bonus_text = bonus_text + ' + ' + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>, ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x <span class="wagering-on">(free spins)</span>';
} else {
bonus_text = bonus_text + ', wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>';
}
}
// input first result
var extra_space = "";
if(datatable.rows.item(result).cells.item(5).innerHTML != "") {extra_space = " "}
element.innerHTML = element.innerHTML + '<div class="intro"><strong>RECOMMENDED FIRST DEPOSIT BONUSES:</strong></div><div class="recommended-bonus left"><a href="' + datatable.rows.item(result).cells.item(2).innerHTML + '" target="_blank"><img loading="lazy" src="' + datatable.rows.item(result).cells.item(3).innerHTML + '" alt="' + datatable.rows.item(result).cells.item(0).innerHTML + ' casino logo" width="120" height="40" /></a><a href="' + datatable.rows.item(result).cells.item(1).innerHTML + '" rel="nofollow noopener sponsored" target="_blank"><div class="play-button"><strong>USE BONUS</strong></div></a></div><div class="recommended-bonus right"><strong>' + datatable.rows.item(result).cells.item(5).innerHTML + extra_space + datatable.rows.item(result).cells.item(4).innerHTML + ' bonus</strong>:<div>' + bonus_text + ', min. deposit: ' + datatable.rows.item(result).cells.item(14).innerHTML + '</div></div>';
// format second result
var bonus_text = '';
if (datatable.rows.item(result2).cells.item(4).innerHTML == "No deposit") {
bonus_text = bonus_text + datatable.rows.item(result2).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result2).cells.item(10).innerHTML + 'x';
} else {
bonus_text = datatable.rows.item(result2).cells.item(6).innerHTML + " % up to " + datatable.rows.item(result2).cells.item(12).innerHTML;
if (datatable.rows.item(result2).cells.item(8).innerHTML != "") {
bonus_text = bonus_text + ' + ' + datatable.rows.item(result2).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result2).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result2).cells.item(11).innerHTML + ')</span>, ' + datatable.rows.item(result2).cells.item(10).innerHTML + 'x <span class="wagering-on">(free spins)</span>';
} else {
bonus_text = bonus_text + ', wagering: ' + datatable.rows.item(result2).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result2).cells.item(11).innerHTML + ')</span>';
}
}
// input second result
var extra_space = "";
if(datatable.rows.item(result2).cells.item(5).innerHTML != "") {extra_space = " "}
element.innerHTML = element.innerHTML + '<div class="recommended-bonus left"><a href="' + datatable.rows.item(result2).cells.item(2).innerHTML + '" target="_blank"><img loading="lazy" src="' + datatable.rows.item(result2).cells.item(3).innerHTML + '" alt="' + datatable.rows.item(result2).cells.item(0).innerHTML + ' casino logo" width="120" height="40" /></a><a href="' + datatable.rows.item(result2).cells.item(1).innerHTML + '" rel="nofollow noopener sponsored" target="_blank"><div class="play-button"><strong>USE BONUS</strong></div></a></div><div class="recommended-bonus right"><strong>' + datatable.rows.item(result2).cells.item(5).innerHTML + extra_space + datatable.rows.item(result2).cells.item(4).innerHTML + ' bonus</strong>:<div>' + bonus_text + ', min. deposit: ' + datatable.rows.item(result2).cells.item(14).innerHTML + '</div></div>'+ "<div class='warning'><i><strong>Warning!</strong> This is a theoretical estimate and shouldn't be treated as a guarantee!</i></div>";
// CALCULATE MATCH BONUS
document.getElementById('bonus-result').innerHTML = Math.round((bonus*1 + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('fs-bonus-result').innerHTML = Math.round(((no_spins*fs_value*fs_rtp/100) + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('faucet-result').innerHTML = 0 + " USD";
var total_money = 0;
total_money = deposit*1 + bonus*1 + no_spins*fs_value*fs_rtp/100;
document.getElementById('all-playing-money').innerHTML = Math.round((total_money + Number.EPSILON) * 100) / 100 + " USD";
if (wagering === fs_wagering) {
if (wagering_on === "bonus") {
loss = (bonus + no_spins*fs_value*fs_rtp/100)*wagering/contribution*(1-rtp/100);
wagering_amount[0] = bonus*wagering;
wagering_amount[1] = 0;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*wagering;
}
if (wagering_on === "deposit") {
loss = (deposit + no_spins*fs_value*fs_rtp/100)*wagering/contribution*(1-rtp/100);
wagering_amount[0] = 0;
wagering_amount[1] = deposit*wagering;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*wagering;
}
if (wagering_on === "bonus-deposit") {
loss = (deposit + bonus + no_spins*fs_value*fs_rtp/100)*wagering/contribution*(1-rtp/100);
wagering_amount[0] = bonus*wagering;
wagering_amount[1] = deposit*wagering;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*wagering;
}
} else {
if (wagering_on === "bonus") {
loss = (bonus*wagering + no_spins*fs_value*fs_rtp/100*fs_wagering)*(1-rtp/100)/contribution;
wagering_amount[0] = bonus*wagering;
wagering_amount[1] = 0;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*fs_wagering;
}
if (wagering_on === "deposit") {
loss = (deposit*wagering + no_spins*fs_value*fs_rtp/100*fs_wagering)*(1-rtp/100)/contribution;
wagering_amount[0] = 0;
wagering_amount[1] = deposit*wagering;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*fs_wagering;
}
if (wagering_on === "bonus-deposit") {
loss = (bonus*wagering + deposit*wagering + no_spins*fs_value*fs_rtp/100*fs_wagering)*(1-rtp/100)/contribution;
wagering_amount[0] = bonus*wagering;
wagering_amount[1] = deposit*wagering;
wagering_amount[2] = no_spins*fs_value*fs_rtp/100*fs_wagering;
}
}
document.getElementById('money-left').innerHTML = Math.round((total_money - loss + Number.EPSILON) * 100) / 100 + " USD";
money_left = total_money - loss;
if (total_money - loss - deposit > 0) {
wins = total_money - loss - deposit;
document.getElementById('wins').innerHTML = Math.round((wins + Number.EPSILON) * 100) / 100 + " USD";
} else {
document.getElementById('wins').innerHTML = 0 + " USD";
}
document.getElementById('losses').innerHTML = Math.round((loss + Number.EPSILON) * 100) / 100 + " USD  <span class='calc-tooltip-box'> ? <span class='calc-tooltip-text'>Losses are calculated from all your playing money (= all playing money - money after wagering).</span></span>";
}
if (type === "no-deposit") {
var no_spins = document.getElementById('fs-no').value;
var fs_wagering = document.getElementById('fs-wagering').value;
var rtp = document.getElementById('rtp').value;
var fs_rtp = document.getElementById('fs-rtp').value;
var contribution = document.getElementById('game-contribution').value/100;
var fs_value = 0.2;
var bonus = 0;
var deviation = 999999999;
var result = 0;
// check for errors and set default values
if (no_spins == "" || isNaN(Number(no_spins))) {error = error + "<br />- free spins amount";}
if (fs_wagering == "" || isNaN(Number(fs_wagering))) {error = error + "<br />- wagering";}
if (rtp == "" || isNaN(Number(rtp))) {
rtp = 97;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "RTP was set to " + rtp + "%";
}
if (fs_rtp == "" || isNaN(Number(fs_rtp))) {
fs_rtp = 97;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "Free spins game RTP was set to " + fs_rtp + "%";
}
if (contribution == "" || isNaN(Number(contribution))) {
contribution = 1;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "Game contribution was set to " + contribution*100 + "%";
}
if (default_values != "* ") {document.getElementById('default-values').innerHTML = default_values + ".";}
bonus = no_spins*fs_value*fs_rtp/100;
money_left = bonus;
// get the recommended no deposit bonus
for (var i = 1; i < firstdeplimit; i++) {
var fsnoT = datatable.rows.item(i).cells.item(8).innerHTML*1;
var fsnod = no_spins;
if (no_spins == 0) { fsnod = 0.001; }
var fswT = datatable.rows.item(i).cells.item(10).innerHTML*1
var fswd = fs_wagering;
if (fs_wagering == 0) { fswd = 0.001; }
if ((Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd)/2 < deviation) {
deviation = (Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd)/2;
result = i;
}
}
// format result
var bonus_text = '';
if (datatable.rows.item(result).cells.item(4).innerHTML == "No deposit") {
bonus_text = bonus_text + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x';
} else {
bonus_text = datatable.rows.item(result).cells.item(6).innerHTML + " % up to " + datatable.rows.item(result).cells.item(7).innerHTML;
if (datatable.rows.item(result).cells.item(8).innerHTML != "") {
bonus_text = bonus_text + ' + ' + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>, ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x <span class="wagering-on">(free spins)</span>';
} else {
bonus_text = bonus_text + ', wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>';
}
}
// input result
var extra_space = "";
if(datatable.rows.item(result).cells.item(5).innerHTML != "") {extra_space = " "}
element.innerHTML = element.innerHTML + '<div class="intro"><strong>RECOMMENDED NO DEPOSIT BONUS:</strong></div><div class="recommended-bonus left"><a href="' + datatable.rows.item(result).cells.item(2).innerHTML + '" target="_blank"><img loading="lazy" src="' + datatable.rows.item(result).cells.item(3).innerHTML + '" alt="' + datatable.rows.item(result).cells.item(0).innerHTML + ' casino logo" width="120" height="40" /></a><a href="' + datatable.rows.item(result).cells.item(1).innerHTML + '" rel="nofollow noopener sponsored" target="_blank"><div class="play-button"><strong>USE BONUS</strong></div></a></div><div class="recommended-bonus right"><strong>' + datatable.rows.item(result).cells.item(5).innerHTML + extra_space + datatable.rows.item(result).cells.item(4).innerHTML + ' bonus</strong>:<div>' + bonus_text + '</div></div>';
deviation = 999999999;
result = 0;
// get the recommended first deposit bonus
for (var i = firstdeplimit; i < datatable.rows.length; i++) {
var fsnoT = datatable.rows.item(i).cells.item(8).innerHTML*1;
var fsnod = no_spins;
if (no_spins == 0) { fsnod = 0.001; }
var fswT = datatable.rows.item(i).cells.item(10).innerHTML*1
var fswd = fs_wagering;
if (fs_wagering == 0) { fswd = 0.001; }
var mindep = 60;
if (mindep < Number(datatable.rows.item(i).cells.item(13).innerHTML)) { mindep = Number(datatable.rows.item(i).cells.item(13).innerHTML); }
var bonusT = mindep*Number(datatable.rows.item(i).cells.item(6).innerHTML)/100;
if (bonusT > Number(datatable.rows.item(i).cells.item(7).innerHTML)) { bonusT = Number(datatable.rows.item(i).cells.item(7).innerHTML) }
var wageringT = [Number(datatable.rows.item(i).cells.item(9).innerHTML),Number(datatable.rows.item(i).cells.item(9).innerHTML),Number(datatable.rows.item(i).cells.item(10).innerHTML)];
if (datatable.rows.item(i).cells.item(11).innerHTML === "Bonus") {
wageringT[0] = 0;
} else if (datatable.rows.item(i).cells.item(11).innerHTML === "Deposit") {
wageringT[1] = 0;
}
if ((bonusT + Number(datatable.rows.item(i).cells.item(8).innerHTML)*fs_value*fs_rtp - mindep*wageringT[0] - bonusT*wageringT[1] - Number(datatable.rows.item(i).cells.item(8).innerHTML)*fs_value*fs_rtp*wageringT[2])*(1-rtp/100)/contribution > 0 && datatable.rows.item(i).cells.item(15).innerHTML == "x") {
if ((Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd)/2 < deviation) {
deviation = (Math.abs(no_spins-fsnoT)/fsnod + Math.abs(fs_wagering-fswT)/fswd)/2;
result = i;
}
}
}
// format result
var bonus_text = '';
if (datatable.rows.item(result).cells.item(4).innerHTML == "No deposit") {
bonus_text = bonus_text + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x';
} else {
bonus_text = datatable.rows.item(result).cells.item(6).innerHTML + " % up to " + datatable.rows.item(result).cells.item(12).innerHTML;
if (datatable.rows.item(result).cells.item(8).innerHTML != "") {
bonus_text = bonus_text + ' + ' + datatable.rows.item(result).cells.item(8).innerHTML + ' free spins, wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>, ' + datatable.rows.item(result).cells.item(10).innerHTML + 'x <span class="wagering-on">(free spins)</span>';
} else {
bonus_text = bonus_text + ', wagering: ' + datatable.rows.item(result).cells.item(9).innerHTML + 'x <span class="wagering-on">(on ' + datatable.rows.item(result).cells.item(11).innerHTML + ')</span>';
}
}
var rec_b_deposit = 60;
var cor_deposit = "60 USD";
if (rec_b_deposit < Number(datatable.rows.item(result).cells.item(13).innerHTML)) {
rec_b_deposit = Number(datatable.rows.item(result).cells.item(13).innerHTML);
cor_deposit = datatable.rows.item(result).cells.item(14).innerHTML;
}
var rec_b = Number(datatable.rows.item(result).cells.item(7).innerHTML);
if (rec_b > rec_b_deposit*Number(datatable.rows.item(result).cells.item(6).innerHTML)/100) {rec_b = rec_b_deposit*Number(datatable.rows.item(result).cells.item(6).innerHTML)/100;}
var rec_fs_b = Number(datatable.rows.item(result).cells.item(8).innerHTML)*fs_value*fs_rtp/100;
var rec_b_wagering = [Number(datatable.rows.item(result).cells.item(9).innerHTML),Number(datatable.rows.item(result).cells.item(9).innerHTML),Number(datatable.rows.item(result).cells.item(10).innerHTML)];
if (datatable.rows.item(result).cells.item(11).innerHTML === "Bonus") {
rec_b_wagering[0] = 0;
} else if (datatable.rows.item(result).cells.item(11).innerHTML === "Deposit") {
rec_b_wagering[1] = 0;
}
var rec_b_loss = (rec_b_deposit*rec_b_wagering[0] + rec_b*rec_b_wagering[1] + rec_fs_b*rec_b_wagering[2])*(1-rtp/100)/contribution;
var rec_b_wins = rec_b + rec_fs_b - rec_b_loss;
// input result
var extra_space = "";
if(datatable.rows.item(result).cells.item(5).innerHTML != "") {extra_space = " "}
element.innerHTML = element.innerHTML + '<div class="intro">However, no deposit bonuses have too low wins (if any) to be eligible for a withdrawal, so we recommend using a first deposit bonus instead:</div><div class="recommended-bonus left"><a href="' + datatable.rows.item(result).cells.item(2).innerHTML + '" target="_blank"><img loading="lazy" src="' + datatable.rows.item(result).cells.item(3).innerHTML + '" alt="' + datatable.rows.item(result).cells.item(0).innerHTML + ' casino logo" width="120" height="40" /></a><a href="' + datatable.rows.item(result).cells.item(1).innerHTML + '" rel="nofollow noopener sponsored" target="_blank"><div class="play-button"><strong>USE BONUS</strong></div></a></div><div class="recommended-bonus right"><strong>' + datatable.rows.item(result).cells.item(5).innerHTML + extra_space + datatable.rows.item(result).cells.item(4).innerHTML + ' bonus</strong>:<div>' + bonus_text + '</div></div><div>By depositing ' + cor_deposit + ' and using this bonus, estimated <strong>wins are ' +  Math.round((rec_b_wins + Number.EPSILON) * 100) / 100 + ' USD</strong> and <strong>losses ' +  Math.round((rec_b_loss + Number.EPSILON) * 100) / 100 + ' USD</strong>' + "<div class='warning'><i><strong>Warning!</strong> This is a theoretical estimate and shouldn't be treated as a guarantee!</i></div>";
// CALCULATE
document.getElementById('deposit-result').innerHTML = 0 + " USD";
document.getElementById('bonus-result').innerHTML = 0 + " USD";
document.getElementById('fs-bonus-result').innerHTML = bonus + " USD";
document.getElementById('faucet-result').innerHTML = 0 + " USD";
document.getElementById('all-playing-money').innerHTML = bonus + " USD";
wagering_amount[2] = bonus*fs_wagering;
loss = bonus*fs_wagering/contribution*(1-rtp/100);
document.getElementById('money-left').innerHTML = Math.round((bonus - loss + Number.EPSILON) * 100) / 100 + " USD";
wins = bonus - loss;
document.getElementById('wins').innerHTML = Math.round((wins + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('losses').innerHTML = Math.round((loss + Number.EPSILON) * 100) / 100 + " USD  <span class='calc-tooltip-box'> ? <span class='calc-tooltip-text'>Losses are calculated from all your playing money (= all playing money - money after wagering).</span></span> <span class='no-deposit-disclaimer'><i>(But no deposit bonuses usually require you to deposit something in order to withdraw winnings!)</i></span>";
}
if (type === "faucet") {
var amount = document.getElementById('amount').value;
money_left = amount;
var rtp = document.getElementById('rtp').value;
// check for errors and set default values
if (amount == "" || isNaN(Number(amount))) {error = error + "<br />- faucet amount";}
if (rtp == "" || isNaN(Number(rtp))) {
rtp = 97;
if (default_values != "* ") {default_values = default_values + ", ";}
default_values = default_values + "RTP was set to " + rtp + "%";
}
if (default_values != "* ") {document.getElementById('default-values').innerHTML = default_values + ".";}
// CALCULATE
document.getElementById('deposit-result').innerHTML = 0 + " USD";
document.getElementById('bonus-result').innerHTML = 0 + " USD";
document.getElementById('fs-bonus-result').innerHTML = 0 + " USD";
document.getElementById('faucet-result').innerHTML = amount + " USD";
document.getElementById('all-playing-money').innerHTML = amount + " USD";
loss = amount*(1-rtp/100);
document.getElementById('money-left').innerHTML = Math.round((amount - loss + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('wins').innerHTML = 0 + " USD";
document.getElementById('losses').innerHTML = Math.round((loss + Number.EPSILON) * 100) / 100 + " USD <span class='calc-tooltip-box'> ? <span class='calc-tooltip-text'>Losses are calculated from all your playing money (= all playing money - money after wagering).</span></span>";
}
// INPUT RESULTS
document.getElementById('wagering-amount').innerHTML = Math.round((wagering_amount[0] + wagering_amount[1] + wagering_amount[2] + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('bonus-wager').innerHTML = Math.round((wagering_amount[0] + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('deposit-wager').innerHTML = Math.round((wagering_amount[1] + Number.EPSILON) * 100) / 100 + " USD";
document.getElementById('fs-wager').innerHTML = Math.round((wagering_amount[2] + Number.EPSILON) * 100) / 100 + " USD";
if (wins > 0) {
document.getElementById('verdict').innerHTML = "By using this bonus, you can walk away with <strong>" + Math.round((wins + Number.EPSILON) * 100) / 100 + " USD more</strong> than what you started with.<br /><br />";
} else {
if (money_left <= 0) {money_left = 0;}
document.getElementById('verdict').innerHTML = "By using a bonus with such input quantities, you can <strong>lose " + Math.round((Math.abs(money_left - deposit) + Number.EPSILON) * 100) / 100 + " USD</strong>. Think carefully before using a bonus like that.<br /><br />";
}
document.getElementById('verdict').style.marginTop = "10px";
if (error === "") {
document.getElementById('temp-result').style.display = 'none';
document.getElementById('actual-result').style.display = 'inline-block';
} else {
document.getElementById('temp-result').style.display = 'inline-block';
document.getElementById('temp-result').style.textAlign = "left";
document.getElementById('temp-result').style.lineHeight = "normal";
document.getElementById('actual-result').style.display = 'none';
error = "The following fields are mandatory for the calculator to display any relevant results. Please fill out:" + error + "<br /> and try again!";
document.getElementById('temp-result').innerHTML = error;
}
}</script>
