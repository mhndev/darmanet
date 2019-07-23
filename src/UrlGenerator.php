<?php
namespace mhndev\darmanet;

use mhndev\darmanet\Exception\InvalidFunctionException;

/**
 * Class UrlGenerator
 * @package mhndev\darmanet
 */
class UrlGenerator
{

    /**
     * @var array
     */
    protected $default_config;

    /**
     * @var array
     */
    private $config;

    /**
     * UrlGenerator constructor.
     * @param array $default_config
     * @param array $config
     */
    function __construct(array $default_config, array $config)
    {
        $this->default_config = $default_config;
        $this->config = $config;
    }




    /**
     * @param string $function_name
     * @return string
     * @throws InvalidFunctionException
     */
    public function getUrl(string $function_name)
    {
        switch ($function_name) {
            case 'currentIssuance':

                return $this->config['current_issuance_uri'] ?? $this->default_config['current_issuance_uri'];
                break;

            case 'diseaseList':
                return $this->config['disease_list_uri'] ?? $this->default_config['disease_list_uri'];
                break;

            case 'planList':
                return $this->config['plan_list_uri'] ?? $this->default_config['plan_list_uri'];
                break;

            case 'bodyPartList':
                return $this->config['body_part_list_uri'] ?? $this->default_config['body_part_list_uri'];
                break;

            case 'provinceList':
                return $this->config['province_list_uri'] ?? $this->default_config['province_list_uri'];
                break;

            case 'cityList':
                return $this->config['city_list_uri'] ?? $this->default_config['city_list_uri'];
                break;

            case 'doEnquiryForAllPlans':
                return $this->config['enquiry_for_all_plans_uri'] ?? $this->default_config['enquiry_for_all_plans_uri'];
                break;

            case 'doEnquiryForSinglePlan':
                return $this->config['enquiry_for_single_plan_uri'] ?? $this->default_config['enquiry_for_single_plan_uri'];
                break;


            default:
                throw new InvalidFunctionException;
        }
    }


}
