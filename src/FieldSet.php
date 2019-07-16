<?php

namespace IContextTest;

class FieldSet
{
    protected $maxNumberDisregardChipCount;
    protected $chipCount;
    protected $currentNumber;

    public function __construct($fieldsCount, $chipCount)
    {
        $binFieldsCount = '';
        for ($i = 0; $i < $fieldsCount; $i++) {
            $binFieldsCount = '1' . $binFieldsCount;
        }
        $this->maxNumberDisregardChipCount = \bindec($binFieldsCount);
        $this->chipCount = $chipCount;
        $this->currentNumber = 0;
    }

    public function increaseCurrentNumberToOne()
    {
        if ($this->currentNumber >= $this->maxNumberDisregardChipCount) {
            return false;
        }
        $this->currentNumber += 1;
        return $this->currentNumber;
    }

    public function checkCurrentNumber()
    {
        $binFormatCurrent = \decbin($this->currentNumber);
        $oneBinDigitCount = substr_count($binFormatCurrent, '1');
        return $this->chipCount == $oneBinDigitCount;
    }

    /**
     * Get the value of maxNumberDisregardChipCount
     */
    public function getmaxNumberDisregardChipCount()
    {
        return $this->maxNumberDisregardChipCount;
    }

    /**
     * Get the value of currentNumber
     */
    public function getCurrentNumber()
    {
        return $this->currentNumber;
    }
}
