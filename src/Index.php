<?php

namespace IContextTest\Index;

require_once __DIR__ . '/../vendor/autoload.php';

function openFile($innerFilePath, $mode)
{
    $filePath = $innerFilePath[0] === DIRECTORY_SEPARATOR ? $innerFilePath : '.' . DIRECTORY_SEPARATOR . $innerFilePath;
    return fopen($filePath, $mode);
}

function makeTitleForFileRecord($fieldsCount)
{
    $result = '1';
    for ($i = 2; $i <= $fieldsCount; $i++) {
        $result = $result . ' ' . $i;
    }
    return $result;
}

function makeContentForFileRecord($number, $fieldsCount)
{
    $binNumber = \decbin($number);
    for ($i = \strlen($binNumber); $i < $fieldsCount; $i++) {
        $binNumber = '0' . $binNumber;
    }

    $result = '';

    for ($i = 0; $i < $fieldsCount; $i++) {
        $prefix = '';
        $numLength = strlen((string)$i);
        for ($j = 0; $j < $numLength; $j++) {
            $prefix = ' ' . $prefix;
        }
        if ($i === 0) {
            $prefix = '';
        }
        $element = $binNumber[$i] === '1' ? '$' : ' ';
        $result = $result . $prefix . $element;
    }
    
    return $result;
}

function getPhrase($rightCount)
{
    if ($rightCount < 10) {
        return "Менее 10 вариантов\n\n";
    }
    
    if (\in_array($rightCount, [11, 12, 13, 14])) {
        return "{$rightCount} вариантов\n\n";
    }
    
    $tail = $rightCount % 10;

    if ($tail === 1) {
        return "{$rightCount} вариант\n\n";
    }

    if (\in_array($tail, [2, 3, 4])) {
        return "{$rightCount} варианта\n\n";
    }

    return "{$rightCount} вариантов\n\n";
}

function run($fieldsCount, $chipCount, $innerFilePath)
{
    $tempFileName = \uniqid();
    $tempFile = openFile($tempFileName, 'w');
    $fieldSet = new \IContextTest\FieldSet($fieldsCount, $chipCount);
    $maxNumberDisregardChipCount = $fieldSet->getmaxNumberDisregardChipCount();
    $rightCount = 0;
    $titleForFileRecord = makeTitleForFileRecord($fieldsCount);

    for ($i = 1; $i <= $maxNumberDisregardChipCount; $i++) {
        if ($fieldSet->checkCurrentNumber()) {
            $rightCount += 1;
            $recordContent = makeContentForFileRecord($fieldSet->getCurrentNumber(), $fieldsCount);
            \fwrite($tempFile, $titleForFileRecord . "\n" . $recordContent . "\n\n");
        }
        $fieldSet->increaseCurrentNumberToOne();
    }
    \ftruncate($tempFile, \filesize($tempFileName) - 2);
    \fclose($tempFile);
    
    $file = openFile($innerFilePath, 'w');
    $phrase = getPhrase($rightCount);
    \fwrite($file, $phrase);

    $tempFile = openFile($tempFileName, 'r');

    while (!\feof($tempFile)) {
        $buffer = \fread($tempFile, 256);
        \fwrite($file, $buffer);
    }

    \fclose($tempFile);
    \unlink($tempFileName);
    \fclose($file);
}
