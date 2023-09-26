<?php

$sEnvPath = realpath(ROOT."/.env");

//Check .envenvironment file exists
if(!is_file($sEnvPath)){
    throw new ErrorException("Environment File is Missing.");
}
//Check .envenvironment file is readable
if(!is_readable($sEnvPath)){
    throw new ErrorException("Permission Denied for reading the ".($sEnvPath).".");
}
//Check .envenvironment file is writable
if(!is_writable($sEnvPath)){
    throw new ErrorException("Permission Denied for writing on the ".($sEnvPath).".");
}

$aVariables = readEnvFile($sEnvPath);
insertEnvVariables($aVariables);

/**
 * returns an array of env variables
 * 
 */
function readEnvFile(string $sEnvPath): array
{
    $aVariables = array();
    // Open the .en file using the reading mode
    $fopen = fopen($sEnvPath, 'r');
    if($fopen){
        //Loop the lines of the file
        while (($line = fgets($fopen)) !== false){
            // Check if line is a comment
            $line_is_comment = (substr(trim($line),0 , 1) == '#') ? true: false;
            // If line is a comment or empty, then skip
            if($line_is_comment || empty(trim($line)))
                continue;
    
            // Split the line variable and succeeding comment on line if exists
            $line_no_comment = explode("#", $line, 2)[0];
            // Split the variable name and value
            $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
            $env_name = trim($env_ex[0]);
            $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
            $aVariables[$env_name] = $env_value;
        }
        // Close the file
        fclose($fopen);
    }
    return $aVariables;
}

function insertEnvVariables(array $aVariables): void
{
    foreach ($aVariables as $name => $value) {
        //Using putenv()
        putenv($name."=".$value);
    }
}


?>