# BeanstalkApp & PivotalTracker Integration - PHP

Now you can associate a GIT based commit from Beanstalk to a specific Pivotal Tracker story. Their commit messages will show up as comments on the Pivotal Tracker story and can even change the story state (see 'Use' below on how to format your commit messages).

This PHP script takes Beanstalk's web hooks integration data and formats it for Pivotal Tracker's SCM post-commit hook integration. It parses the Beanstalk JSON payload and sends the request to the Pivotal Tracker SCM API endpoint in the correctly formatted XML it requires.

## Requirements

-This script only works for GIT commits to Beanstalk (not SVN)

## Installation

Place this script somewhere accessible on a server running PHP

## Setup

It's recommended to put this script behind HTTP authentication. Once protected, add a Beanstalk post-commit hook pointing to the following url:

    http://username:password@SCRIPT URL/commit.php

Replace SCRIPT URL with the url of where the script is located. 

Open the commits.php and place your Pivotal Tracker API Token where it says:

	$pivotalAPIToken = 'PLACE API TOKEN HERE';

And you should be good to go!

## Use

Once setup, you can format commit messages as specified
[here](https://www.pivotaltracker.com/help/api?version=v3#scm\_post\_commit\_message\_syntax)