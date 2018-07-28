<!DOCTYPE html>
<html>
<head>
<title>Labyrinth Lord Thief Character Generator</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="Labyrinth Lord Thief Character Generator. Goblinoid Games.">
	<meta name="keywords" content="Labyrinth Lord, Goblinoid Games,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2018">
		

	<link rel="stylesheet" type="text/css" href="css/ll_thief.css">
	<link rel="stylesheet" type="text/css" href="css/ll_thief_post.css">
    
    
    <script type="text/javascript" src="./js/dieRoll.js"></script>
    <script type="text/javascript" src="./js/modifiers.js"></script>
    <script type="text/javascript" src="./js/hitPoinst.js"></script>
    <script type="text/javascript" src="./js/primeReq.js"></script>
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/armour.php';
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/coins.php';
    include 'php/encumbrance.php';
    include 'php/thiefAbilities.php';
    
    
        if(isset($_POST["theCharacterName"]))
        {
            $characterName = $_POST["theCharacterName"];
    
        }
    
        if(isset($_POST["thePlayerName"]))
        {
            $playerName = $_POST["thePlayerName"];
        
        }    
    
        if(isset($_POST["theAlignment"]))
        {
            $alignment = $_POST["theAlignment"];
        }
    
        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        $armourDefense = getArmour($armour)[1];
        $armourWeight = getArmour($armour)[2];
    /*
        if(isset($_POST["theShield"]))
        {
            $shield = $_POST["theShield"];
        }
    
        $shieldName = getShield($shield)[0];
        $shieldDefense = getShield($shield)[1];
        $shieldWeight = getShield($shield)[2];
    */
        $totalAcDefense = $armourDefense;
        $totalArmourWeight = $armourWeight;
    
        $armourDefense = removeZero($armourDefense);
        $armourWeight = removeZero($armourWeight);
    
    /*
        $shieldDefense = removeZero($shieldDefense);
        $shieldWeight = removeZero($shieldWeight);
        */
    
        if(isset($_POST["theGold"]))
        {
            $coins = $_POST["theGold"];
        }
    
        $coinQuantity = getCoins($coins)[0];
        $coinType = getCoins($coins)[1];
    
    
         
        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
        $weaponWeight = array();
    
    
        if(isset($_POST["theWeapons"]))
        {
            foreach($_POST["theWeapons"] as $weapon)
            {
                array_push($weaponArray, $weapon);
            }
        }
    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
    $totalWeaponWeight = 0;
    
    foreach($weaponArray as $select)
    {
        array_push($weaponWeight, getWeapon($select)[2]);
        $totalWeaponWeight += getWeapon($select)[2];
    }
    
    

        $gearArray = array();
        $gearNames = array();
        $gearWeight = array();
    
    
        if(isset($_POST["theGear"]))
        {
            foreach($_POST["theGear"] as $weapon)
            {
                array_push($gearArray, $weapon);
            }
        }
    
        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
        
        $totalGearWeight = 0;
    
        foreach($gearArray as $select)
        {
            array_push($gearWeight, getGear($select)[1]);
            $totalGearWeight += getGear($select)[1];
        }
    
    $totalWeightCarried = $totalArmourWeight + $totalWeaponWeight + $totalGearWeight + $coinQuantity;
    
    $movementTurn = turnMovement($totalWeightCarried);
    
    $movementEncounter = encounterMovement($totalWeightCarried);
    
    $movementRunning = runningMovement($totalWeightCarried);
    
            
    if(isset($_POST["theLevel"]))
    {
        $levelString = $_POST["theLevel"];
    }
    
    $thiefLevelMessage = thiefAbility ($levelString)
    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>
           
		<span id="strength"></span>
		<span id="dexterity"></span> 
		<span id="constitution"></span> 
		<span id="intelligence"></span>
		<span id="wisdom"></span>
       <span id="charisma"></span>
		  
       
		<span id="strengthModDesc"></span>
		<span id="dexterityModDesc"></span> 
		<span id="constitutionModDesc"></span> 
		<span id="intelligenceModDesc"></span>
		<span id="wisdomModDesc"></span>
       <span id="charismaModDesc"></span>
       
       <span id="saveBreathAttack"></span>
       <span id="savePoisonDeath"></span>
       <span id="savePetrify"></span>
       <span id="saveWands"></span>
       <span id="saveSpell"></span>
       
       <span id="dieRollMethod"></span>
       
       <span id="level"></span>
       <span id="class">Thief</span>
       <span id="exNextLevel"></span>
       
       <span id="meleeAc0"></span>
       <span id="meleeAc1"></span>
       <span id="meleeAc2"></span>
       <span id="meleeAc3"></span>
       <span id="meleeAc4"></span>
       <span id="meleeAc5"></span>
       <span id="meleeAc6"></span>
       <span id="meleeAc7"></span>
       <span id="meleeAc8"></span>
       <span id="meleeAc9"></span>
       
       <span id="missileAc0"></span>
       <span id="missileAc1"></span>
       <span id="missileAc2"></span>
       <span id="missileAc3"></span>
       <span id="missileAc4"></span>
       <span id="missileAc5"></span>
       <span id="missileAc6"></span>
       <span id="missileAc7"></span>
       <span id="missileAc8"></span>
       <span id="missileAc9"></span>
       
       <span id="baseAc"></span>
       <span id="hitPoints"></span>
       <span id="primeReq"></span>
       <span id="modifiedAc"></span>
       
       
       <span id="skillLocks"></span>
       <span id="skillTraps"></span>
       <span id="skillPockets"></span>
       <span id="skillSilently"></span>
       <span id="skillWalls"></span>
       <span id="skillHide"></span>
       <span id="skillHear"></span>
       
       <span id="backStab">Backstab: +4 attack bonus; x2 damage.</span>
       
       <span id="characterName">
           <?php
                echo $characterName;
           ?>
        </span>
       
              
       <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
	                 
       <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
              
       <span id="armourName">
           <?php
                echo $armourName;
           ?>
        </span>
              
       <span id="armourAc">
           <?php
                echo $armourDefense;
           ?>
        </span>
              
       <span id="armourWeight">
           <?php
                echo $armourWeight;
           ?>
        </span>
       
              
       <span id="totalArmourWeight">
            <?php
                echo $totalArmourWeight;
            ?>
       </span>
              
       <span id="totalArmourClassMod">
            <?php
                echo $totalAcDefense;
            ?>
       </span>
       
       <span id="weaponsList">
           <?php
           $val1 = 0;
           $val2 = 0;
           $val3 = 0;
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
               $val1 = isWeaponTwoHanded($theWeapon, $val1);
               $val2 = isWeaponBastardSword($theWeapon, $val2);
           }
           
           $val3 = $val1 + $val2;
           
           $weaponNotes = weaponNotes($val3);
           
           ?>  
        </span>
       
       <span id="weaponNotes">
           <?php
                echo $weaponNotes;
           ?>
        </span>
            
       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

            
       <span id="weaponsList3">
           <?php
           foreach($weaponWeight as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
           }
           ?>        
        </span>
       
       <span id="totalWeaponWeight">
           <?php
           echo $totalWeaponWeight;
           ?>
       </span>

              
       <span id="gearList">
           <?php
           
           foreach($gearNames as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>
       </span>
           
              
       <span id="gearList2">
           <?php
           
           foreach($gearWeight as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>  
        </span>
	   	   
       
       <span id="totalGearWeight">
           <?php
           echo $totalGearWeight;
           ?>
       </span>
       
       
       
       <span id="totalWeightCarried">
           <?php
           echo $totalWeightCarried . " lbs";
           ?>
       </span>
              
       
       <span id="wealth">
           <?php
           echo ($coinQuantity * 10) . $coinType;
           ?>
       </span>
       
       <span id="coinWeight">
           <?php
           echo $coinQuantity . " lbs";
           ?>
       </span>
       
              
       <span id="turnMove">
           <?php
           echo $movementTurn;
           ?>
       </span>
       
       
       <span id="encounterMove">
           <?php
           echo $movementEncounter;
           ?>
       </span>
       
       <span id="runningMove">
           <?php
           echo $movementRunning;
           ?>
       </span>
       
      <span id="thiefAbilities">
           <?php
           echo $thiefLevelMessage;
            ?>
      </span>
       
       
	</section>
	

		
  <script>
      

	  
	/*
	 Character() - Thief Character Constructor
	*/
	function Character() {

        let strength = rollDice(6, 3, 0, 0);
        let dexterity = rollDice(6, 3, 0, 0);
        let constitution = rollDice(6, 3, 0, 0);
        let	intelligence = rollDice(6, 3, 0, 0);
        let	wisdom = rollDice(6, 3, 0, 0);
        let	charisma = rollDice(6, 3, 0, 0);
        let wisdomMod = abilityScoreModifier(wisdom);
        let strengthMod = abilityScoreModifier(strength);
        let dexterityMod = abilityScoreModifier(dexterity);
        let constitutionMod = abilityScoreModifier(constitution);
        let thief = getThief();
		
		let thiefCharacter = {
			"strength": strength,
			"dexterity": dexterity,
			"constitution": constitution,
			"intelligence": intelligence,
			"wisdom": wisdom,
			"charisma": charisma,
            "strengthMod": abilityScoreModifier(strength),
            "strengthModifyDes": strengthModifierDescription(strength),
            "dexterityMod": abilityScoreModifier(dexterity),
            "dexterityModifyDes": dexterityModifierDescription(dexterity),
            "constitutionMod": abilityScoreModifier(constitution),
            "constitutionModifyDes": constitutionModifierDescription(constitution),
            "intelligenceMod": abilityScoreModifier(intelligence),
            "intelligenceModifyDes": intelligenceModifierDescription(intelligence),
            "wisdomModifyDes": wisdomModifierDescription(wisdom),
            "charismaMod": abilityScoreModifier(charisma),
            "charismaModifyDes": charismaModifierDescription(charisma),
            "breathAttack": thief.breathAttack,
            "poisonDeath": thief.poisonDeath,
            "petrify": thief.petrify,
            "wandsSave": thief.wand - wisdomMod,
            "spellSave": thief.spell - wisdomMod,
            "level": thief.level,
            "nextLevelExp": thief.exNext,
            "meleeHitAC0": thief.thaco - (strengthMod),
            "meleeHitAC1": thief.thaco - (strengthMod) - 1,
            "meleeHitAC2": thief.thaco - (strengthMod) - 2,
            "meleeHitAC3": thief.thaco - (strengthMod) - 3,
            "meleeHitAC4": thief.thaco - (strengthMod) - 4,
            "meleeHitAC5": thief.thaco - (strengthMod) - 5,
            "meleeHitAC6": thief.thaco - (strengthMod) - 6,
            "meleeHitAC7": thief.thaco - (strengthMod) - 7,
            "meleeHitAC8": thief.thaco - (strengthMod) - 8,
            "meleeHitAC9": thief.thaco - (strengthMod) - 9,
            "missileHitAC0": thief.thaco - (dexterityMod),
            "missileHitAC1": thief.thaco - (dexterityMod) - 1,
            "missileHitAC2": thief.thaco - (dexterityMod) - 2,
            "missileHitAC3": thief.thaco - (dexterityMod) - 3,
            "missileHitAC4": thief.thaco - (dexterityMod) - 4,
            "missileHitAC5": thief.thaco - (dexterityMod) - 5,
            "missileHitAC6": thief.thaco - (dexterityMod) - 6,
            "missileHitAC7": thief.thaco - (dexterityMod) - 7,
            "missileHitAC8": thief.thaco - (dexterityMod) - 8,
            "missileHitAC9": thief.thaco - (dexterityMod) - 9,
            "acBase": 9 - dexterityMod,
            "acModified": <?php echo $totalAcDefense ?> + 9 - dexterityMod,
            "hp": hitPoints(thief.hd, constitutionMod) + addHighLevelHp(thief.level),
            "primeReqBonus": primeReq(dexterity),
            "pickLocks": thief.pickLocks + "%",
            "findTraps": thief.traps + "%",
            "pickPockets": thief.pickPockets + "%",
            "moveSilent": thief.moveSilently + "%",
            "climbWalls": thief.climbWalls + "%",
            "hideInShadows": thief.hideShadows + "%",
            "hearNoise": thief.hearNoise,
			"dieRollMethod": "Ability Score Generation: 3d6 (Old School)"
			
		
			

		};
	    if(thiefCharacter.hitPoints <= 0 ){
			thiefCharacter.hitPoints = 1;
		}
		return thiefCharacter;
	  
	  }
	  

      
    /*getThief() return the statistics for the Thief per level*/  
    function getThief() {
	let thief = [
        
		{"level": 1,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 14,
		 "petrify": 13,
		 "wand": 15,
		 "spell": 14,
         "exNext": "1,251",
         "pickLocks": 17,
         "traps": 14,
         "pickPockets": 23,
         "moveSilently": 23,
         "climbWalls": 87,
         "hideShadows": 13,
         "hearNoise": "1-2",
         "hd": 1
        },
        
		{"level": 2,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 14,
		 "petrify": 13,
		 "wand": 15,
		 "spell": 14,
         "exNext": "2,501",
         "pickLocks": 23,
         "traps": 17,
         "pickPockets": 27,
         "moveSilently": 27,
         "climbWalls": 88,
         "hideShadows": 17,
         "hearNoise": "1-2",
         "hd": 2
        },
        
		{"level": 3,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 14,
		 "petrify": 13,
		 "wand": 15,
		 "spell": 14,
         "exNext": "5,001",
         "pickLocks": 27,
         "traps": 20,
         "pickPockets": 30,
         "moveSilently": 30,
         "climbWalls": 89,
         "hideShadows": 20,
         "hearNoise": "1-3",
         "hd": 3
        },
        
		{"level": 4,
		 "thaco": 18,
		 "breathAttack": 16,
		 "poisonDeath": 14,
		 "petrify": 13,
		 "wand": 15,
		 "spell": 14,
         "exNext": "10,001",
         "pickLocks": 31,
         "traps": 23,
         "pickPockets": 37,
         "moveSilently": 37,
         "climbWalls": 90,
         "hideShadows": 27,
         "hearNoise": "1-3",
         "hd": 4
        },
        
		{"level": 5,
		 "thaco": 18,
		 "breathAttack": 14,
		 "poisonDeath": 12,
		 "petrify": 11,
		 "wand": 13,
		 "spell": 12,
         "exNext": "20,001",
         "pickLocks": 35,
         "traps": 33,
         "pickPockets": 40,
         "moveSilently": 40,
         "climbWalls": 91,
         "hideShadows": 30,
         "hearNoise": "1-3",
         "hd": 5
        },
        
		{"level": 6,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 12,
		 "petrify": 11,
		 "wand": 13,
		 "spell": 12,
         "exNext": "40,001",
         "pickLocks": 45,
         "traps": 43,
         "pickPockets": 43,
         "moveSilently": 43,
         "climbWalls": 92,
         "hideShadows": 37,
         "hearNoise": "1-4",
         "hd": 6
        },
        
		{"level": 7,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 12,
		 "petrify": 11,
		 "wand": 13,
		 "spell": 12,
         "exNext": "80,001",
         "pickLocks": 55,
         "traps": 53,
         "pickPockets": 53,
         "moveSilently": 53,
         "climbWalls": 93,
         "hideShadows": 47,
         "hearNoise": "1-4",
         "hd": 7
        },
        
		{"level": 8,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 12,
		 "petrify": 11,
		 "wand": 13,
		 "spell": 12,
         "exNext": "160,001",
         "pickLocks": 65,
         "traps": 63,
         "pickPockets": 63,
         "moveSilently": 63,
         "climbWalls": 94,
         "hideShadows": 57,
         "hearNoise": "1-4",
         "hd": 8
        },
        
		{"level": 9,
		 "thaco": 16,
		 "breathAttack": 12,
		 "poisonDeath": 10,
		 "petrify": 9,
		 "wand": 11,
		 "spell": 10,
         "exNext": "280,001",
         "pickLocks": 75,
         "traps": 73,
         "pickPockets": 73,
         "moveSilently": 73,
         "climbWalls": 95,
         "hideShadows": 67,
         "hearNoise": "1-4",
         "hd": 9
        },
        
		{"level": 10,
		 "thaco": 16,
		 "breathAttack": 12,
		 "poisonDeath": 10,
		 "petrify": 9,
		 "wand": 11,
		 "spell": 10,
         "exNext": "400,001",
         "pickLocks": 85,
         "traps": 83,
         "pickPockets": 83,
         "moveSilently": 83,
         "climbWalls": 96,
         "hideShadows": 77,
         "hearNoise": "1-5",
         "hd": 9
        },
        
		{"level": 11,
		 "thaco": 15,
		 "breathAttack": 12,
		 "poisonDeath": 10,
		 "petrify": 9,
		 "wand": 11,
		 "spell": 10,
         "exNext": "520,001",
         "pickLocks": 95,
         "traps": 93,
         "pickPockets": 93,
         "moveSilently": 93,
         "climbWalls": 97,
         "hideShadows": 87,
         "hearNoise": "1-5",
         "hd": 9
        },
        
		{"level": 12,
		 "thaco": 14,
		 "breathAttack": 12,
		 "poisonDeath": 10,
		 "petrify": 9,
		 "wand": 11,
		 "spell": 10,
         "exNext": "640,001",
         "pickLocks": 97,
         "traps": 95,
         "pickPockets": 105,
         "moveSilently": 95,
         "climbWalls": 98,
         "hideShadows": 90,
         "hearNoise": "1-5",
         "hd": 9
        },
        
		{"level": 13,
		 "thaco": 13,
		 "breathAttack": 10,
		 "poisonDeath": 8,
		 "petrify": 7,
		 "wand": 9,
		 "spell": 8,
         "exNext": "760,001",
         "pickLocks": 99,
         "traps": 97,
         "pickPockets": 115,
         "moveSilently": 97,
         "climbWalls": 99,
         "hideShadows": 97,
         "hearNoise": "1-5",
         "hd": 9
        },
        
		{"level": 14,
		 "thaco": 13,
		 "breathAttack": 10,
		 "poisonDeath": 8,
		 "petrify": 7,
		 "wand": 9,
		 "spell": 8,
         "exNext": "880,001",
         "pickLocks": 99,
         "traps": 99,
         "pickPockets": 125,
         "moveSilently": 99,
         "climbWalls": 99,
         "hideShadows": 97,
         "hearNoise": "1-5",
         "hd": 9
        },
        
		{"level": 15,
		 "thaco": 12,
		 "breathAttack": 10,
		 "poisonDeath": 8,
		 "petrify": 7,
		 "wand": 9,
		 "spell": 8,
         "exNext": "1,000,001",
         "pickLocks": 99,
         "traps": 99,
         "pickPockets": 125,
         "moveSilently": 99,
         "climbWalls": 99,
         "hideShadows": 97,
         "hearNoise": "1-5",
         "hd": 9
        }
        

		
	];
	
	
	return thief[0]; 
}

  
       let imgData = "images/thief_character_sheet.png";
      
        $("#character_sheet").attr("src", imgData);
      

	  let data = Character();
		 
      $("#strength").html(data.strength);
      
      $("#dexterity").html(data.dexterity);
      
      $("#constitution").html(data.constitution);
      
      $("#intelligence").html(data.intelligence);
      
      $("#wisdom").html(data.wisdom);
      
      $("#charisma").html(data.charisma);
      
      $("#strengthModDesc").html(data.strengthModifyDes);
      $("#dexterityModDesc").html(data.dexterityModifyDes);
      $("#constitutionModDesc").html(data.constitutionModifyDes);
      $("#intelligenceModDesc").html(data.intelligenceModifyDes);
      $("#wisdomModDesc").html(data.wisdomModifyDes);
      $("#charismaModDesc").html(data.charismaModifyDes);
      
      $("#saveBreathAttack").html(data.breathAttack);
      $("#savePoisonDeath").html(data.poisonDeath);
      $("#savePetrify").html(data.petrify);
      $("#saveWands").html(data.wandsSave);
      $("#saveSpell").html(data.spellSave);
      
      $("#dieRollMethod").html(data.dieRollMethod);
      
      $("#level").html(data.level);
      $("#exNextLevel").html(data.nextLevelExp);
      
      $("#meleeAc0").html(data.meleeHitAC0);
      $("#meleeAc1").html(data.meleeHitAC1);
      $("#meleeAc2").html(data.meleeHitAC2);
      $("#meleeAc3").html(data.meleeHitAC3);
      $("#meleeAc4").html(data.meleeHitAC4);
      $("#meleeAc5").html(data.meleeHitAC5);
      $("#meleeAc6").html(data.meleeHitAC6);
      $("#meleeAc7").html(data.meleeHitAC7);
      $("#meleeAc8").html(data.meleeHitAC8);
      $("#meleeAc9").html(data.meleeHitAC9);
      
      $("#missileAc0").html(data.missileHitAC0);
      $("#missileAc1").html(data.missileHitAC1);
      $("#missileAc2").html(data.missileHitAC2);
      $("#missileAc3").html(data.missileHitAC3);
      $("#missileAc4").html(data.missileHitAC4);
      $("#missileAc5").html(data.missileHitAC5);
      $("#missileAc6").html(data.missileHitAC6);
      $("#missileAc7").html(data.missileHitAC7);
      $("#missileAc8").html(data.missileHitAC8);
      $("#missileAc9").html(data.missileHitAC9);
      
      $("#baseAc").html(data.acBase);
      $("#hitPoints").html(data.hp);
      $("#primeReq").html(data.primeReqBonus);
      $("#modifiedAc").html(data.acModified);

      
      $("#skillLocks").html(data.pickLocks);
      $("#skillTraps").html(data.findTraps);
      $("#skillPockets").html(data.pickPockets);
      $("#skillSilently").html(data.moveSilent);
      $("#skillWalls").html(data.climbWalls);
      $("#skillHide").html(data.hideInShadows);
      $("#skillHear").html(data.hearNoise);
	 
  </script>
		
	
    
</body>
</html>