<?php
    require_once("../model/client.php");
	require_once("../model/skill.php");
	require_once("../database/connectionManager.php");
	
	class SkillController{

        function getClient($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

		function getAll($clientID) {
			$skill = new Skill();
			return $skill->getAllSkill($clientID);	
		}

		function addNewSkill($clientID, $skillName) {
			$skill = new Skill();
			$skill->insert($clientID, $skillName);
			return "Skill Successfully Added";	
		}

		function removeAllSkill($skillID) {
			$skill = new Skill();
			$skill->deleteAllSkill($skillID);
			return "Skill Successfully Removed";
		}
	}
?>