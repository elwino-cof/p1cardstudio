<?php
	session_start();
	if ($_SESSION["login"] != "yes") {
	        header("Location: http://designedbypirates.com/login/"); /* Redirect browser */
	        exit;
	}
	if (isset($_SESSION['email'])) $prefill_email = $_SESSION['email'];
	else $prefill_email = "Capital One Email";
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<meta name="generator" content=
			"HTML Tidy for Mac OS X (vers 31 October 2006 - Apple Inc. build 15.15), see www.w3.org" />
		<title>Change Pilot Card Studio</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href=
			"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" type=
			"text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href=
			"https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" type=
			"text/css" />

		<script src="scripts/jSignature/jSignature.min.noconflict.js" type="text/javascript"></script>
		<script src="scripts/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
		<script src="scripts/process_submit.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/fonts.css" />
	</head>
	<body>
		<div data-role="page">
			<div role="main" class="ui-content">
				<div id="welcomeBg">
					<h1>Project Change</h1>
					<div id="bgBottomWrapper">
						<p>Tell us your name:</p>
						<form>
							<input id="name_val" type="text" class="text" value="First MI Last" onfocus=
								"this.value = '';" onblur="if (this.value == '') {this.value = 'First MI Last';}" />
							<input id="email_val" type="hidden" class="text" value=
								"<?php echo $prefill_email; ?>" />
						</form>
					</div>
				</div>
				<div class="sectionTitle" id="selectDeviceDiv">
					<h2>choose your iPhone</h2>
					<p class="h2_sub">Sorry! Android will be coming soon...</p>
				</div>
			
					<div class="ui-field-contain" name="phoneSel">
					  <select id="selectPhone" data-native-menu="false" > 
					    <option selected="selected" disabled="disabled">Pick one
					    </option>
					    <option value="6+">
					      iPhone 6/6+
					    </option>
					    <option value="5s">
					      iPhone 5s
					    </option>
					<option value="5">
					      iPhone 5
					    </option>
					    <option value="4s">
					      iPhone 4s or below
					    </option>
					    <option value="No iphone">
					      I don't have an iPhone
					    </option>
					  </select>
					</div>
				
			
				<div id="signature_text" class="sectionTitle">
					<h2>choose your material</h2>
					<p class="h2_sub"><b>Drag and drop</b> in order of preference.<br />
						We'll do our best to get your favorite.
					</p>
				</div>
				<div data-role="content" data-theme="c" class="touch_container">
					<div class="touch">
						<ul data-role="listview" data-inset="true" data-theme="d" id="sortable">
							<li id="sort-2">
								<div class="li_img">
									<img src="swatches/Bamboo%20W300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Bamboo</h3>
									<p>Renewable FSC certified bamboo</p>
								</div>
							</li>
							<li id="sort-3">
								<div class="li_img">
									<img src="swatches/Tortoise%20W300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Tortoise Shell</h3>
									<p>Eco-friendly mottled resin
									</p>
								</div>
							</li>
							<li id="sort-4">
								<div class="li_img">
									<img src="swatches/Hammered%20Rose%20Gold%20W300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Hammered Metal</h3>
									<p>Hammered-effect in tinted stainless steel
									</p>
								</div>
							</li>
							<li id="sort-5">
								<div class="li_img">
									<img src="swatches/Black%20Marble%20W300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Marble</h3>
									<p>Classic marble pattern
									</p>
								</div>
							</li>
							<li id="sort-6">
								<div class="li_img">
									<img src="swatches/ResinBurl%20W300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Walnut Burl</h3>
									<p>Natural walnut infused with pearlescent resin
									</p>
								</div>
							</li>
							<li id="sort-1">
								<div class="li_img">
									<img src="swatches/allPlasticBlackW300px.png" />
								</div>
								<div class="li_img_des card_type">
									<h3>Soft-touch Plastic</h3>
									<p>Resin coated with a satin soft-touch feel</p>
								</div>
							</li>
						</ul>
					</div>
					<div class="touch_mask"></div>
				</div>
				
				<div id = "ifPayWrapper">
			<div id="signature_text" class="sectionTitle">
			<p>The soft-touch plastic card is free; the other cards are premium upgrades. 
			Would you be willing to participate in a 30-minute research session to 
			upgrade your card?</p>
 			</div>
					<label>
						<input type="radio" name="pay" value="yes" >
						<p>Of course!</p>
					</label>
					
					<label>
						<input type="radio" name="pay" value="no">
						<p>No thanks. I'd prefer a free soft-touch plastic card.</p>
					</label>
				</div>

				<div id="cardback" class="sectionTitle">
					<h2>choose your pattern</h2>
					<p class="h2_sub">Card backs can be customized with a pattern.<br />
						Drag and drop in order of preference.
					</p>
				</div>
				<div data-role="content" data-theme="c" class="touch_container">
					<div class="touch">
						<ul data-role="listview" data-inset="true" data-theme="d" id="sortable-back">
							<li id="sort-back-1">
								<div class="li_img">
									<img src="swatches/Black resin TATTOO Blank W300px.png" />
								</div>
								<div class="li_img_des pattern_type">
									<h3>Blank</h3>
									<p></p>
								</div>
							</li>
							<li id="sort-back-2">
								<div class="li_img">
									<img src="swatches/Black resin TATTOO zen1 W300px.png" />
								</div>
								<div class="li_img_des pattern_type">
									<h3>Zen</h3>
									<p></p>
								</div>
							</li>
							<li id="sort-back-3">
								<div class="li_img">
									<img src="swatches/Allresin blackC rear PARALLEL W300px.png" />
								</div>
								<div class="li_img_des pattern_type">
									<h3>Parallel</h3>
									<p></p>
								</div>
							</li> 
							<li id="sort-back-4">
								<div class="li_img">
									<img src="swatches/Allresin blackC rear DOTS W300px.png" />
								</div>
								<div class="li_img_des pattern_type">
									<h3>Dots</h3>
									<p></p>
								</div>
							</li>
							<!-- 
<li id="sort-back-4">
								<div class="li_img">
									<img src="swatches/Black resin TATTOO Custom W300px.png" />
								</div>
								<div class="li_img_des pattern_type">
									<h3>Custom</h3>
									<p>I will draw my own pattern</p>
								</div>
							</li>
 -->
						</ul>
					</div>
					<div class="touch_mask"></div>
				</div>
				<div class="sectionTitle">
					<h2>sign your card</h2>
					<p class="h2_sub">We will print your signature on the front of your card. Make sure you use a touchscreen device in landscape mode for best results. 
					</p>
				</div>
				<div id = "signatureWrapper">
					<div id="signature"><!-- jSignature fills this with stuff --></div>
				</div>
				
				<div class="smallspacer"></div>
				
				<div align="center">
					<label>
						<input type="checkbox"  id="ifSignByHand" /> 
						<p>I prefer to sign the back of my card the old-fashioned way. Please do not print my signature on the front of the card.</p>
					</label>
				</div>
				<p id= "signByHandDisclaimer"></p>
				
				<div class="sectionTitle" id="selectOfficeDiv">
					<h2>office location</h2>
					<p class="h2_sub">Your card will be shipped to your work location.</p>
				</div>
			
				<div class="ui-field-contain" name="officeSel">
				  <select id="selectOffice" data-native-menu="false" > 
					<option selected="selected" disabled="disabled">Pick one
					</option>
					<option value="McLean">
					  McLean
					</option>
					<option value="Towers Crescent">
					  Towers Crescent
					</option>
					<option value="Knolls">
					  Knolls
					</option>
					<option value="Clarendon">
					  Clarendon
					</option>
					<option value="West Creek">
					  West Creek
					</option>
				<option value="Tampa">
					  Tampa
					</option>
					<option value="San Francisco">
					  San Francisco
					</option>
					<option value="Not Listed">
					  Not Listed
					</option>
				  </select>
				</div>
					
				<div class="ui-field-contain">
					<input id="workspace" type="text" class="text" value="Workspace or internal zip" onfocus=
								"this.value = '';" onblur="if (this.value == '') {this.value = 'Workspace or internal zip';}" />
				</div>
					
				<div class="sectionTitle" id="last4Div">
					<h2>capital one credit card</h2>
					<p class="h2_sub">Please enter the last 4 digits you wish to use in the Change pilot. Your Change Card will be programmed with data from your existing card. No corporate cards or partnership cards please.</p>
				</div>
				
				<div class="ui-field-contain">
					<input id="last4" type="text" pattern="\d*" maxlength="4" class="text" value="Last 4 Digits" onfocus=
								"this.value = '';" onblur="if (this.value == '') {this.value = 'Last 4 Digits';}" />
				</div>
				
				<div class="spacer"></div>
				
				<div class="click_submit">
					<input type="submit" value="I'm done!" id="submitButton">
				</div>
				<!-- <div id="someelement"></div> -->
			</div><!-- <div role="main" class="ui-content"> -->
			<div data-role="footer">
				<h4>Designed by Pirates</h4>
			</div>
			<!-- /footer -->
		</div><!-- <div data-role="page"> -->
		<!-- /page -->
	</body>
</html>

