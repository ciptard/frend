<?php 
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    header('HTTP/1.1 404 Not Found');
    exit();
}

require_once('includes/class.auth.php');
$auth = new Frend_Authentication();
if ($auth): ?>
<div id="frend-bar">
	<button id="frend-bar-save">Save</button>
	<button id="frend-bar-bold">b</button>
	<button id="frend-bar-italic">i</button>
	<button id="frend-bar-underline">u</button>
	<button id="frend-bar-link">Link</button>
	<button id="frend-bar-insert">Insert</button>
	<button id="frend-bar-linebreak">Line Break</button>
	

	<span id="frend-bar-status"></span>
	
	<button id="frend-bar-logout" class="right">Logout</button>
	<button id="frend-bar-switch" class="right">&#x25BC;</button>
	<button id="frend-bar-enable" class="right">Disable Editor</button>
</div>

<style type="text/css" id="frend-bar-style">
    @charset "UTF-8";
    
	#frend-bar {
		position: fixed;
		top: 0;
		left: 0;
		padding: 10px 20px;
		background: rgba(0, 0, 0, 0.9);
		color: #fff;
		min-width: 768px;
		width: 100%;
   		-moz-box-sizing: border-box;
   		-webkit-box-sizing: border-box;
    	box-sizing: border-box;
    	font-size: 16px;
    	font-family: Helvetica, sans-serif;
    	overflow: hidden;
	}

	#frend-bar.bottom {
		bottom: 0;
		top: auto;
	}
    #frend-new-element input,
	#frend-bar button {
		background-image: -webkit-linear-gradient(#EDEDED, #EDEDED 38%, #DEDEDE);
		background-image: -moz-linear-gradient(#EDEDED, #EDEDED 38%, #DEDEDE);
		border: 1px solid  rgba(0, 0, 0, 0.25);
		border-radius: 2px;
		box-shadow: 0 1px 0 rgba(0, 0, 0, 0.08), inset 0 1px 2px rgba(255, 255, 255, 0.9);
		color: #444;
		min-width: 32px;
		margin: 0 10px 0 0;
		padding: 1px 10px;
		text-shadow: 0 1px 0 #F0F0F0;
		font-weight: 900;
		font-size: 16px;
		line-height: 24px;
		float: left;
		display: block;
		text-align: center;   
    	font-family: Helvetica, sans-serif;		  
	}

	#frend-bar #frend-bar-italic {
	   font-style: italic;
	}
	
	#frend-bar #frend-bar-underline {
	   text-decoration: underline;
	}	

	#frend-bar button:disabled {
		opacity: 0.8;
		cursor: default;
	}

	#frend-bar button.right {
		float: right;
		margin: 0 0 0 10px;
	}

	#frend-bar-status {
		line-height: 26px;
		padding-left: 10px;
		font-weight: 900;
	}
	
	#frend-new-element input:active,
	#frend-bar button:active,
	.frend-new-element-mode #frend-bar #frend-bar-insert,
	#frend-bar #frend-bar-enable.active {
	   background: #019AD2;
	   border-color: #057ED0;
	   color: #fff;
	   text-shadow: 0 -1px 0 rgba(0, 0, 0, .25);
	   box-shadow: none;
	   max-width: 1000px;
	}

	[contentEditable=true]:hover {
    	background: #f8f8f8;
  	}

	[contentEditable=true]:focus {
    	background: #f3f3f3;
  	}
  	
  	#frend-new-element {
        background: #f8f8f8;
    	border: 1px dashed #aaa;
    	display: block;
    	font-size: 16px;
    	line-height: 24px;
    	margin: 10px 0;
    	padding: 10px;  	     
    	font-family: Helvetica, serif;
    	clear: both;
    	cursor: pointer;
  	}
  	
  	#frend-new-element input,
  	#frend-new-element select {
        display: inline-block;
  	}
  	
  	#frend-new-element input {
        float: none;
  	}
  	
  	#frend-new-element select {
        font-size: 16px;
        min-width: 140px;
        margin: 0 10px 0 0;
        padding: 1px 10px;
        line-height: 24px;
        background: #fff url("data:image/png,%89PNG%0D%0A%1A%0A%00%00%00%0DIHDR%00%00%0C%80%00%00%00%40%08%02%00%00%00W%AEz%EF%00%00%00%19tEXtSoftware%00Adobe%20ImageReadyq%C9e%3C%00%00%04%E5IDATx%DA%EC%DD%3DN%E3Z%18%06%E0%B1oD%82%A8%E8(%A8%D2Q%D2%D0%40%83%C4%12%D8%01%3Db%09P%81%A0%40%A2%60%05%D9%05%BB%A0%04%09!B%3A%9A%10%07%F2g%E7%22%90f(%98%E09%23Y7%E7%3EOi%1F%1FK_%FD%EA%FD%92%E9t%FA%03%00%00%00%00%00%00%00%00%80%3F%97%1A%01%00%00%00%00%00%00%00%00%40%98%9A%06%2C%00%00%00%00%00%00%00%00%20%0E%D5%A7%A14%60%01%00%00%00%00%00%00%00%00%04%D2%80%05%00%00%00%00%00%00%00%00DB%03%16%00%00%00%00%00%00%00%00%C0%DC%D0%80%05%00%00%00%00%00%00%00%00D%A2(%8A%8A%FF(%80%05%00%00%00%00%00%00%00%00D%C2%0AB%00%00%00%00%00%00%00%00%80%B9%A1%01%0B%00%00%00%00%00%00%00%00%88%84%15%84%00%00%00%00%00%00%00%00%00%81%AC%20%04%00%00%00%00%00%00%00%00%98%1B%1A%B0%00%00%00%00%00%00%00%00%80HXA%08%00%00%00%00%00%00%00%00%10%A8%FA4%94%00%16%00%00%00%00%00%00%00%00%10%09%0DX%00%00%00%00%00%00%00%00%00%81%AAOC%A5%86%0E%00%00%00%00%00%00%00%00%10F%03%16%00%00%00%00%00%00%00%00%10%09%2B%08%01%00%00%00%00%00%00%00%00%02U%9F%86%12%C0%02%00%00%00%00%00%00%00%00%22!%80%05%00%00%00%00%00%00%00%00%10%C8%0AB%00%00%00%00%00%00%00%00%80%40%1A%B0%00%00%00%00%00%00%00%00%00%02i%C0%02%00%00%00%00%00%00%00%00%08%A4%01%0B%00%00%00%00%00%00%00%00%20%90%06%2C%00%00%00%00%00%00%00%00%80%40%02X%00%00%00%00%00%00%00%00%00%81%AC%20%04%00%00%00%00%00%00%00%00%08%24%80%05%00%00%00%00%00%00%00%00%10%C8%0AB%00%00%00%00%00%00%00%00%80%40%1A%B0%00%00%00%00%00%00%00%00%00%02i%C0%02%00%00%00%00%00%00%00%00%084%3B%0Du%7B%7B%7Bzz%3A%18%0C%CA_%D8h4%F6%F6%F6677%F3%3C%FF%F2%40%D2%E9t%CC%1D%00%00%00%00%00%00%00%00%88%40%96e3%DE%26I2%18%0C%8E%8F%8F%EF%EE%EE%CA%DC%B6%BC%BC%7Cxx%D8l6_%5E%5EF%A3%D1%97%E9%AE%D4%D0%01%00%00%00%00%00%00%00%80%FF%83%E9t%BA%B8%B8xvv%B6%B3%B3%F3%ED%E1%F5%F5%F5V%AB%B5%B6%B66%99L~W%7F%F5%26y%7C%7C4Y%00%00%00%00%00%00%00%00%20%02%BD%5E%EF%DB3i%9A%D6%EB%F5%AB%AB%ABV%AB%F5%BBu%84%BB%BB%BB%FB%FB%FB%FD~%3F%CB%B2%B73%B3%02X%EDv%DB%DC%01%00%00%00%00%00%00%00%80%08%94%09%60%FDx%DFE%B8%B0%B0%D0n%B7%2F..%3A%9D%CE%E7W%8DF%E3%E8%E8hcc%23%7B7%1C%0E%BF%DC%3C%F8%EB%AA%87%87%07s%07%00%00%00%00%00%00%00%00%22%F0%FC%FC%5C%F2d%9A%A6%B5Zm2%99%9C%9F%9F___%7F%3C%5C%5D%5D%3D99YYY%E9%F5z%FD~%7F%3C%1E%17E1%FB%9E%7F%0E%0E%0E%CC%1D%00%00%00%00%00%00%00%00%88%C0p8%2Cyr%3A%9D%E6y%9E%A6%E9%F6%F6%F6h4%BA%B9%B9%D9%DA%DA%BA%BC%BC%AC%D5j%DDn7%CB%B2%B7%87%B3%BB%AF%3E%24%F7%F7%F7%E6%0E%00%00%00%00%00%00%00%00D%A0%7C%03%D6Oi%9A%D6%EB%F5n%B7%DBl6%C7%E3q%96e%AF%AF%AF%DF%16_%FDT%2B%93%D2%02%00%00%00%00%00%00%00%00%F8%EF%2B%1F%9C%FA%FC%C9%9B%A5%A5%A5%A7%A7%A7%3C%CF%CB%AC%1D%FCL%00%0B%00%00%00%00%00%00%00%00%88DX%1A*%7F%97%24I%C0%E7%02X%00%00%00%00%00%00%00%00%40%24%FE%26%0D%15%F6%AD%00%16%00%00%00%00%00%00%00%00%10%89%80%15%84%7FI%00%0B%00%00%00%00%00%00%00%00%88D%F5i(%01%2C%00%00%00%00%00%00%00%00%20%12%1A%B0%00%00%00%00%00%00%00%00%00%02i%C0%02%00%00%00%00%00%00%00%00%08%24%80%05%00%00%00%00%00%00%00%00%10%C8%0AB%00%00%00%00%00%00%00%00%80%40%D5%A7%A1RC%07%00%00%00%00%00%00%00%00%08%A3%01%0B%00%00%00%00%00%00%00%00%88%84%15%84%00%00%00%00%00%00%00%00%00%81%AAOC%09%60%01%00%00%00%00%00%00%00%00%91%10%C0%02%00%00%00%00%00%00%00%00%08T%FD%0A%C2%D4%D0%01%00%00%00%00%00%00%00%00%C2h%C0%02%00%00%00%00%00%00%00%00%22a%05!%00%00%00%00%00%00%00%00%40%A0%EA%D3PV%10%02%00%00%00%00%00%00%00%00%04%D2%80%05%00%00%00%00%00%00%00%00D%A2(%8A%8A%FF(%80%05%00%00%00%00%00%00%00%00D%C2%0AB%00%00%00%00%00%00%00%00%80%B9%A1%01%0B%00%00%00%00%00%00%00%00%88%84%06%2C%00%00%00%00%00%00%00%00%80%B9%A1%01%0B%00%00%00%00%00%00%00%00%88DQ%14%15%FF%F1_%01%06%00md%E2%BF%C9%C3%19%DA%00%00%00%00IEND%AEB%60%82") no-repeat right center;
        -webkit-background-size: 1600px 32px;
        -moz-background-size: 1600px 32px;
        background-size: 1600px 32px;
        -webkit-appearance: none;
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.08), inset 0 1px 2px rgba(255, 255, 255, 0.9);
        -webkit-border-radius: 2px;
		text-shadow: 0 1px 0 #F0F0F0;
		font-weight: 900; 
		border: 1px solid #c0c0c0;
		color: #444;   
            
  	}
  	
  	#frend-new-element select:focus {
        outline: none;  	
  	}
  	
  	
  	#frend-bar button {
        -webkit-transition: margin 1s;
        -moz-transition: margin 1s;
  	}
  	
  	#frend-bar button:not(.right) {
        margin-left: -15%;
  	}
  	
  	#frend-bar button.right:not(#frend-bar-enable) {
        margin-right: -15%;
  	}
  	
  	.frend-content-edit-mode #frend-bar button:not(.right) {
        margin-left: 0;
  	}
  	
  	.frend-content-edit-mode #frend-bar button.right:not(#frend-bar-enable) {
  	    margin-right: 0;
  	}
  	
</style>
<?php endif; ?>