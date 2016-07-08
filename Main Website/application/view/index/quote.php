    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <ul class="nav navbar-nav">
                    	<li class="step-box-selected">
                           	<p><strong>step 1</strong> enter your details below.</p>
			             </li>
			             <li class="step-box">
			                 <p><strong>step 2</strong> view your online quote.</p>
			             </li>
			             <li class="step-box">
			                 <p><strong>step 3</strong> select date and time and submit.</p>
			             </li>
                    </ul>
                    <hr>
                </div>
                <div class="col-lg-6 quote-form">
                    <div class="quote-head col-lg-12">
                        <p>Enter your details below for a quote.</p>
                    </div>
                    <div class="col-lg-6">
                        <form action="<?php echo Config::get('URL'); ?>index/quotestep1" method="post">
                            <label>Name * </label><br />
                            <input name="quote_address_name" placeholder="Name" type="text" required /><br />
                            <label>Postcode * </label><br />
                            <input name="quote_address_postcodes"  placeholder="Postcode" type="text" required /><br />
                            <label>Appliance Type</label><br />
                            <select name="quote_address_type">
                                <option value="Electric Cooker">Electric Cooker</option>
                                <option value="Dishwasher">Dishwasher</option>
                                <option value="Extractor Hood">Extractor Hood</option>
                                <option value="Freezer">Freezer</option>
                                <option value="Fridge Freezer">Fridge/Freezer</option>
                                <option value="Glass Washer">Glass Washer</option>
                                <option value="Electric Hob">Hob (electric)</option>
                                <option value="Microwave">Microwave</option>
                                <option value="Built In Oven">Oven (built-in)</option>
                                <option value="Fridge">Refrigerator</option>
                                <option value="Tumble Dryer">Tumble Dryer</option>
                                <option value="Washer Dryer">Washer Dryer</option>
                                <option value="Washing Machine">Washing Machine</option>
                            </select><br />
                            <label>Appliance Age(Years)</label><br />
                            <select name="quote_address_age">
                                <option selected="selected" class="selected" value="">Please select</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9 or more</option>    
                            </select>
                    </div>
                    <div class="col-lg-6">
                            <label>Telephone *</label><br />
                            <input name="quote_address_phone" type="tel" required /><br />
                            <label>Email *</label><br />
                            <input name="quote_address_email" type="email" required /><br />
                            <label>Appliance Make</label><br />
                            <select name="quote_address_make">
                                <option value="Admiral">Admiral</option>
                                <option value="AEG">Aeg</option>
                                <option value="AGA">Aga</option>
                                <option value="Algor">Algor</option>
                                <option value="Amana">Amana</option>
                                <option value="Amica">Amica</option>
                                <option value="AWT">Antony Worrall Thomson</option>
                                <option value="Argos">Argos</option>
                                <option value="Ariston">Ariston</option>
                                <option value="Arrow">Arrow</option>
                                <option value="Asko/Asea">Asko/Asea</option>
                                <option value="Atag">Atag</option>
                                <option value="Atlant">Atlant</option>
                                <option value="Bauknecht">Bauknecht</option>
                                <option value="Baumatic">Baumatic</option>
                                <option value="Beko">Beko</option>
                                <option value="Belling">Belling</option>
                                <option value="Bendix">Bendix</option>
                                <option value="Bernstein">Bernstein</option>
                                <option value="Blomberg">Blomberg</option>
                                <option value="Bosch">Bosch</option>
                                <option value="Brandt">Brandt</option>
                                <option value="Britannia">Britannia</option>
                                <option value="Bush">Bush</option>
                                <option value="Candy">Candy</option>
                                <option value="Cannon">Cannon</option>
                                <option value="Caple">Caple</option>
                                <option value="Carlton">Carlton</option>
                                <option value="Cata">Cata</option>
                                <option value="CDA">CDA</option>
                                <option value="Celcus">Celcus</option>
                                <option value="Centurion">Centurion</option>
                                <option value="Cookworks">Cookworks</option>
                                <option value="Coolzone">Coolzone</option>
                                <option value="Creda">Creda</option>
                                <option value="Crusader">Crusader</option>
                                <option value="Currys">Currys Essentials</option>
                                <option value="Daewoo">Daewoo</option>
                                <option value="De Dietrich">De Dietrich</option>
                                <option value="DeLonghi">DeLonghi</option>
                                <option value="Diplomat">Diplomat</option>
                                <option value="Dyson">Dyson</option>
                                <option value="Elba">Elba</option>
                                <option value="Electra">Electra</option>
                                <option value="Electrolux">Electrolux</option>
                                <option value="Elica">Elica</option>
                                <option value="Eurotech">Eurotech</option>
                                <option value="Fagor">Fagor</option>
                                <option value="Falcon">Falcon</option>
                                <option value="Firenzi">Firenzi</option>
                                <option value="Fisher&Paykel">Fisher&Paykel</option>
                                <option value="Flavel">Flavel</option>
                                <option value="Fridgemaster">Fridgemaster</option>
                                <option value="Frigidaire">Frigidaire</option>
                                <option value="Gaggenau">Gaggenau</option>
                                <option value="General Electric">General Electric</option>
                                <option value="Gorenje">Gorenje</option>
                                <option value="Haier">Haier</option>
                                <option value="Haus">Haus</option>
                                <option value="Hitachi">Hitachi</option>
                                <option value="Homark">Homark</option>
                                <option value="Homeking">Homeking</option>
                                <option value="Hoover">Hoover</option>
                                <option value="Hotpoint">Hotpoint</option>
                                <option value="Howden">Howden</option>
                                <option value="Hygena">Hygena</option>
                                <option value="Ice King">Ice King</option>
                                <option value="Ignis">Ignis</option>
                                <option value="IKEA">IKEA</option>
                                <option value="Indesit">Indesit</option>
                                <option value="John Lewis">John Lewis</option>
                                <option value="Karcher">Karcher</option>
                                <option value="Kelvinator">Kelvinator</option>
                                <option value="Kenwood">Kenwood</option>
                                <option value="Kuppersbusch">Kuppersbusch</option>
                                <option value="Lamona">Lamona</option>
                                <option value="Lec">Lec</option>
                                <option value="Leisure">Leisure</option>
                                <option value="LG">LG</option>
                                <option value="Liebherr">Liebherr</option>
                                <option value="Lofra">Lofra</option>
                                <option value="Logik">Logik</option>
                                <option value="Luxair">LUXAIR</option>
                                <option value="Luxor">Luxor</option>
                                <option value="Matsui">Matsui</option>
                                <option value="Maytag">Maytag</option>
                                <option value="Mercury">Mercury</option>
                                <option value="Micromark">Micromark</option>
                                <option value="Midea">Midea</option>
                                <option value="Miele">Miele</option>
                                <option value="Moffat">Moffat</option>
                                <option value="Nardi">Nardi</option>
                                <option value="Neff">Neff</option>
                                <option value="New Home">New Home</option>
                                <option value="New World">New World</option>
                                <option value="Next">Next</option>
                                <option value="Norfrost">Norfrost</option>
                                <option selected="selected" class="selected" value="Unknown">Not Known</option>
                                <option value="Novascotia">Novascotia</option>
                                <option value="Ocean">Ocean</option>
                                <option value="Panasonic">Panasonic</option>
                                <option value="Parkinson Cowan">Parkinson Cowan</option>
                                <option value="Philco">Philco</option>
                                <option value="Philips">Philips</option>
                                <option value="Premium Appliance Brands">Premium Appliance Brands</option>
                                <option value="Prestige">Prestige</option>
                                <option value="Prima">Prima</option>
                                <option value="Prochef">Prochef</option>
                                <option value="Proline">Proline</option>
                                <option value="Rangemaster">Rangemaster</option>
                                <option value="Renlig">Renlig</option>
                                <option value="Rosiers">Rosiers</option>
                                <option value="Russell Hobbs">Russell Hobbs</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Sanyo">Sanyo</option>
                                <option value="Sarena">Sarena</option>
                                <option value="Scandinova">Scandinova</option>
                                <option value="Scholtes">Scholtes</option>
                                <option value="Schreiber">Schreiber</option>
                                <option value="Servis">Servis</option>
                                <option value="Sharp">Sharp</option>
                                <option value="Siemens">Siemens</option>
                                <option value="Smeg">Smeg</option>
                                <option value="Sovereign">Sovereign</option>
                                <option value="Statesman">Statesman</option>
                                <option value="Stoves">Stoves</option>
                                <option value="Swan">Swan</option>
                                <option value="Teba">Teba</option>
                                <option value="Technik">Technik</option>
                                <option value="Teka">Teka</option>
                                <option value="Tempo">Tempo</option>
                                <option value="Tricity Bendix">Tricity Bendix</option>
                                <option value="Vestel">Vestel</option>
                                <option value="Vestfrost">Vestfrost </option>
                                <option value="Westin">Westin</option>
                                <option value="Whirlpool">Whirlpool</option>
                                <option value="White Knight">White Knight</option>
                                <option value="White Westinghouse">White Westinghouse</option>
                                <option value="Zanussi">Zanussi</option>   
                            </select><br /><br />
                            <input type="submit" value="Get Quote" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
