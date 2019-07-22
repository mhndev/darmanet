<?php
namespace mhndev\darmanet\Exception;

use Exception;
use Throwable;

/**
 * Class ValidationException
 * @package mhndev\darmanet\Exception
 */
class ValidationException extends Exception
{

    /**
     * @example :
     *
     * [
     *      'BirthDate' => ['required'],
     *      'Sex'       => ['required']
     * ]
     *
     * @var array of strings
     */
    protected $errors;

    /**
     * ValidationException constructor.
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    function __construct(array $errors = [], $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;

        parent::__construct(json_encode($errors), $code, $previous);
    }

}
