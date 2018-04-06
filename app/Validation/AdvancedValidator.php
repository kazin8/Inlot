<?php

namespace App\Validation;

use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

use Mockery\CountValidator\Exception;

class AdvancedValidator extends Validator
{

    /**
     * Checks whether inn is valid.
     * Valid inn has 10 or 12 int simbols and defined algorythms for checksum.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateInn($attribute, $value, $parameters)
    {
        $result = false;

        if (!is_null($value) && strlen($value) == 10) {
            $weightFactor = array(2, 4, 10, 3, 5, 9, 4, 6, 8, 0);
            $i = 0;
            $checkSum = 0;
            while ($i <= 9)
            {
                $checkSum = $checkSum + ((int)substr($value, $i, 1) * $weightFactor[$i]);
                $i++;
            }
            $refValue = $checkSum % 11;
            $result = (substr($value, 9, 1) == ($refValue % 10));
        } elseif (!is_null($value) && strlen($value) == 12) {
            $weightFactor = array(3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0);
            $i = 0;
            $checkSum1 = 0;
            while ($i <= 10)
            {
                $checkSum1 = $checkSum1 + ((int)substr($value, $i, 1) * $weightFactor[$i + 1]);
                $i++;
            }
            $refValue1 = $checkSum1 % 11;
            if ($refValue1 > 9) {
                $refValue1 = $refValue1 % 10;
            }
            $i = 0;
            $checkSum2 = 0;
            while ($i <= 11)
            {
                $checkSum2 = $checkSum2 + ((int)substr($value, $i, 1) * $weightFactor[$i]);
                $i++;
            }
            $refValue2 = $checkSum2 % 11;
            if ($refValue2 > 9) {
                $refValue2 = $refValue2 % 10;
            }
            $result = ((substr($value, 10, 1) == $refValue1) && (substr($value, 11, 1) == $refValue2));
        }

        return $result;
    }

    /**
     * Check whether two instances are linked.
     * $parameters[0] - considered table;
     * $parameters[1] - name of referenced column;
     * $parameters[2] - value of referenced column;
     * $parameters[3] - name of foreign column;
     * $parameters[4] - value of foreign column;
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     * @throws \Mockery\CountValidator\Exception
     */
    public function validateBelongsWith($attribute, $value, $parameters)
    {
        $fullTableName = $parameters[0];
        $referecedColumn = $parameters[1];
        $valueOfReferencedColumn = explode(';', $parameters[2]);
        $foreignColumn = $parameters[3];
        $valueOfForeignColumn = $parameters[4];

        if ($fullTableName and $referecedColumn and $valueOfReferencedColumn and $foreignColumn and $valueOfForeignColumn) {
            $tableData = explode('.', $fullTableName);

            switch (count($tableData)) {
                case 1 :
                    $tableName = $tableData[0];
                    $table = DB::table($tableName);
                    break;

                case 2 :
                    $connectionName = $tableData[0];
                    $tableName = $tableData[1];
                    $table = DB::connection($connectionName)->table($tableName);
                    break;

                default :
                    throw new Exception("Full table's name is not valid!");
            }

            $result = $table->whereIn($referecedColumn, $valueOfReferencedColumn)
                ->where($foreignColumn, $valueOfForeignColumn)
                ->first();

            return (null == $result) ? false : true;
        }

        return true;
    }

    /**
     * Checks whether postcode contains 6 ciphers and nothing characters.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateRusZip($attribute, $value, $parameters)
    {
        if (strlen($value) == 6 and strlen((int) $value) == 6) {
            return true;
        }

        return false;
    }

    /**
     * Checks whether user entered his password correctly.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateCurPassword($attribute, $value, $parameters)
    {
        return (Hash::check($value, Auth::user()->password)) ? true : false;
    }

}