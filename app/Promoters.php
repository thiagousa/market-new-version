<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promoters extends Model
{
    use SoftDeletes;

    protected $table = 'promoters';

    protected $primaryKey = 'promotersId';

    /**
     * Function to verify if the fields value are unique on database
     *
     * @param $column
     * @param $value
     * @param null $currentId
     */
    public static function consultExists($column, $value, $currentId = null)
    {
        // Creating the query
        $consult = self::where($column, '=', $value);

        // Verifying if currentId was informed
        // It will be informed in case of edit method
        if($currentId){
            $consult = $consult->where('promotersId', '!=', $currentId);
        }

        // Finishing the query
        $consult = $consult->count();

        // Verifying if the the query result if bigger than zero
        if($consult > 0){

            // Setting an error message
            $error = "The ".$column." already has been taken by another promoter";

            // Redirect to promoters' page passing error message
            echo redirect(route('promoters'))->withErrors(compact('error'));
        }
    }
}
