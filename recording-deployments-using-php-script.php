#!/usr/bin/php
<?php

#Deployment
# Assumes the availability of libcurl in the PHP environment.

#Make your changes here:

$apikey = "{INSERT YOUR API KEY HERE}";

#Specify an existing New Relic app name OR app ID
#$app_name = "{INSERT YOUR APPLICATION NAME HERE}";
$app_id = "{INSERT YOUR APPLICATION ID HERE}";

$dep_description = "This is your app id deployment";
#$dep_change = "This is a change log entry";
#$dep_user = "This is the user entry";
#$dep_rev = "This is a version number";

#compose the data string for curl

#$dep_dat = "deployment[app_name]=".$app_name;
$dep_dat = "deployment[app_id]=".$app_id;
$dep_dat = $dep_dat."&deployment[description]=".$dep_description;
#$dep_dat = $dep_dat."&deployment[changelog]=".$dep_change;
#$dep_dat = $dep_dat."&deployment[user]=".$dep_user;
#$dep_dat = $dep_dat."&deployment[revision]=".$dep_rev;

#There should be no changes necessary beyond this point

#deployment url at New Relic
$url = "https://api.newrelic.com/deployments.xml";

#Create header info
$header = array("x-api-key:".$apikey);

#initialize curl 
$ch = curl_init();

curl_setopt ($ch, CURLOPT_VERBOSE, 1);
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER, $header );
curl_setopt ($ch, CURLOPT_POSTFIELDS, $dep_dat );

# Make the curl call for deployment
$http_result = curl_exec ($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

#close curl 
curl_close ($ch);

#output status 
vprintf ("Code  %s\n", $http_code);
vprintf ("Results %s\n", $http_result);
if ($error) {
   vprintf ("Error %s\n",$error);
}
