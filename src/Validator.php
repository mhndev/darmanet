<?php
namespace mhndev\darmanet;

/**
 * Class Validator
 * @package mhndev\darmanet
 */
class Validator
{


    /**
     * @param array $parameters
     * @return array
     */
    public function validateDoEnquiryParameters(array $parameters)
    {
        $errors = [];

        if( empty($parameters['BirthDate']) ) {
            $errors['BirthDate'][] = ['required'];
        }
        elseif ($this->isValidPersianDate($parameters['BirthDate']) ) {
            $errors['BirthDate'][] = 'invalid_format';
        }

        if ( empty($parameters['Sex']) ) {
            $errors['Sex'][] = 'required';
        }

        elseif ($parameters['Sex'] != 0 && $parameters['Sex'] != 1 ) {
            $errors['Sex'][] = 'sex parameter can be 0: male or 1: woman';
        }

        if ( empty($parameters['CurrentInsuranceId'])) {
            $errors['CurrentInsuranceId'][] = 'required';
        }

        if ( empty($parameters['Height']) ) {
            $errors['Height'][] = 'required';
        }
        elseif (! is_int($parameters['Height'])) {
            $errors['Height'][] = 'invalid format (Height parameter should be integer) ';
        }
        elseif ($parameters['Height'] < 30 || $parameters['Height'] > 300 ) {
            $errors['Height'][] = 'invalid format (Height parameter should be integer) ';
        }

        if ( empty($parameters['Weight']) ) {
            $errors['Weight'][] = 'required';
        }
        elseif ( !is_int($parameters['Weight'])) {
            $errors['Weight'][] = 'invalid format (Weight parameter should be integer) ';
        }
        elseif ( $parameters['Weight'] < 2 || $parameters['Weight'] > 300 ) {
            $errors['Weight'][] = 'invalid format (Weight parameter should be between 2, 300) ';
        }

        if ( !empty($parameters['SmokesCigar']) && ! is_bool($parameters['SmokesCigar'])) {
            $errors['SmokesCigar'][] = 'invalid format, should be just boolean';
        }

        if ( !empty($parameters['SmokesCigar']) && empty($parameters['SmokesPerDay'])) {
            $errors['SmokesPerDay'][] = 'if SmokesCigar parameter does exist, SmokesPerDay parameter should also exist';
        }

        if ( !empty($parameters['SmokesCigar']) && empty($parameters['SmokesYears'])) {
            $errors['SmokesPerDay'][] = 'if SmokesCigar parameter does exist, SmokesYears parameter should also exist';
        }

        if( !empty($parameters['DiseaseIds']) && !is_array($parameters['DiseaseIds']) ) {
            $errors['DiseaseIds'][] = 'invalid format, should be array of DiseaseIds';
        }

        if( !empty($parameters['HasSurgery']) && !is_bool($parameters['HasSurgery']) ) {
            $errors['HasSurgery'][] = 'invalid format, should be bool';
        }

        if( !empty($parameters['HasSurgery']) && empty($parameters['SurgeryBodyPartIds']) ) {
            $errors['SurgeryBodyPartIds'][] = 'required while HasSurgery exists';
        }

        if( !empty($parameters['SurgeryBodyPartIds']) && !is_array($parameters['SurgeryBodyPartIds']) ) {
            $errors['SurgeryBodyPartIds'][] = 'invalid format, should be array';
        }

        if( !empty($parameters['RelativeDisease']) && !is_bool($parameters['RelativeDisease']) ) {
            $errors['RelativeDisease'][] = 'should be boolean';
        }

        if(
            !empty($parameters['RelativeDisease']) &&
            empty($parameters['RelativeDiseaseFather']) &&
            empty($parameters['RelativeDiseaseMother'])
        ) {
            $errors['RelativeDiseaseFather'][] =
                'when RelativeDisease field exists,
                 one of RelativeDiseaseFather or RelativeDiseaseMother should exist and be boolean';

            $errors['RelativeDiseaseMother'][] =
                'when RelativeDisease field exists,
                 one of RelativeDiseaseFather or RelativeDiseaseMother should exist and be boolean';
        }

        if(!empty($parameters['RelativeDiseaseFather'])) {
            $errors['RelativeDiseaseFather'][] = ['invalid format, should be boolean'];
        }

        if(!empty($parameters['RelativeDiseaseMother'])) {
            $errors['RelativeDiseaseMother'][] = ['invalid format, should be boolean'];
        }


        return $errors;
    }



    /**
     * @param string $persian_date
     * @return bool
     */
    private function isValidPersianDate(string $persian_date)
    {
        $parts = explode('-', $persian_date);

        if(count($parts) !== 3) {
            return false;
        }

        $year = (int) $parts[0];
        $month = (int) $parts[1];
        $day = (int) $parts[2];

        ## todo fix 1400 and make it dynamic

        if($month > 12  || $month < 0 || $day < 0 || $day > 31 || $year < 1300 || $year > 1400) {
            return false;
        }

        return true;
    }

}
