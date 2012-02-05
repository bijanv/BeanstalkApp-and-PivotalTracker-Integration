<?php

	if($_REQUEST['payload']){

		$pivotalAPIToken = 'PLACE API TOKEN HERE'; // Place Your Pivotal Tracker API Token Here

		//Set up the Curl request to the correct location and correct headers
		$curlRequest = curl_init("http://www.pivotaltracker.com/services/v3/source_commits");
		$curlHeader = array("X-TrackerToken: ".$pivotalAPIToken, "Content-type: application/xml");
		curl_setopt($curlRequest, CURLOPT_POST, TRUE);
		curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curlRequest, CURLOPT_HTTPHEADER, $curlHeader);

		//Grab the post-commit hook Beanstalkapp data
		$json = str_replace('\"', '"', $_REQUEST['payload']); //Remove all the 'clean' formatting
		$json = json_decode($json, true); //Turn JSON into associative array

		//Send seperate SCM commits for each commit made to beanstalk
		foreach($json['commits'] as $commits){
			//Format XML response needed for PivotalTracker
			$dataToPOST = '<source_commit>';
			$dataToPOST .= '<message>'.$commits['message'].'</message>';
			$dataToPOST .= '<author>'.$commits['author']['name'].'</author>';
			$dataToPOST .= '<commit_id>'.$commits['id'].'</commit_id>';
			$dataToPOST .= '<url>'.$commits['url'].'</url>';
			$dataToPOST .= '</source_commit>';

			//Send Request to Pivotal Tracker
			curl_setopt($curlRequest, CURLOPT_POSTFIELDS, $dataToPOST);

			//If you care about recording the response back use $retVal below and print it to a log file
			$retVal = curl_exec($curlRequest);

		}

		curl_close($curlRequest);

	}

?>