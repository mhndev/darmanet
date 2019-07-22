<?php
namespace mhndev\darmanet;

/**
 * Interface iDarmanetAPIClient
 * @package mhndev\darmanet
 */
interface iDarmanetAPIClient
{

    /**
     *
     * @example return data
     *
     * [
     *       {
     *           "id": "91d9773e-98df-4657-8b49-8e622551d75b",
     *           "title": "بدون بیمه پایه"
     *       },
     *       {
     *           "id": "14844931-05d1-44bf-ac7a-fe6f7a30ec59",
     *           "title": "بیمه تامین اجتماعی"
     *       }
     * ]
     *
     * @return array
     */
    function currentIssuance();



    /**
     * [
     *       {
     *           "id": "d67bf765-8f3f-4bef-8c09-6ab9635cdefb",
     *           "text": "آب سیاه، Glaucoma"
     *       },
     *       {
     *           "id": "82be6c09-2b77-4bc2-b5cc-6b2ee5cfc952",
     *           "text": "آب مروارید، Cataract"
     *       },
     *       {
     *           "id": "14b75b1f-95f1-4131-b35d-5d63dc49fc8f",
     *           "text": "آبسه"
     *       }
     * ]
     *
     * @return array
     */
    function diseaseList();


    /**
     *
     * [
     *       {
     *           "id": "4634b989-25a9-4e78-934b-b7ceaa6763dc",
     *           "title": "مهر سامان"
     *       },
     *       {
     *           "id": "12324ba6-f010-4e56-bfaf-ae38780f3ce9",
     *           "title": "سروش سامان"
     *       },
     *       {
     *           "id": "f5883667-e5ec-40e0-9d3b-e3f2d4a9eec5",
     *           "title": "شمیم سامان"
     *       },
     *       {
     *           "id": "a13b43ce-f660-4778-83f8-7ddc15074268",
     *           "title": "وصال سامان"
     *       },
     *       {
     *           "id": "67462a94-56bf-46e6-8ce2-9a849d9c0faa",
     *           "title": "عقیق سامان"
     *       }
     *  ]
     *
     *
     * @return array
     */
    function planList();


    /**
     * [
     *       {
     *           "id": "2a295df3-3cd8-41d0-a9d8-df806400d537",
     *           "text": "دهان"
     *       },
     *       {
     *           "id": "f250060b-2b5d-4774-821c-59a3ca0f2998",
     *           "text": "دندان"
     *       },
     *       {
     *           "id": "616f429d-9318-4c55-8fc3-1105eae5c793",
     *           "text": "زبان"
     *       }
     * ]
     *
     * @return array
     */
    function bodyPartList();


    /**
     *
     * @param array $parameters
     * @return array
     * @example :
     * post request sample curl :
     *
     * curl -X POST \
     *       'http://{{base_url}}/inquery%E2%80%AC%E2%80%AC' \
     *       -H 'Authorization: basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *       -H 'Content-Type: application/json' \
     *       -H 'cache-control: no-cache' \
     *       -d '{
     *               "BirthDate": "1370-11-12",
     *               "Sex": 0,
     *               "CurrentInsuranceId": "91d9773e-98df-4657-8b49-8e622551d75b",
     *               "Height": 187,
     *               "Weight": 88,
     *               "SmokesCigar": true,
     *               "SmokesPerDay": 3,
     *               "SmokesYears": 18,
     *               "DiseaseIds": [],
     *               "HasSurgery": true,
     *               "SurgeyBodyPartIds": [],
     *               "RelativeDisease": true,
     *               "RelativeDiseaseFather": false,
     *               "RelativeDiseaseMother": true,
     *               "PlanId": "4634b989-25a9-4e78-934b-b7ceaa6763dc"
     *           }'
     *
     *
     * @example
     *
     * return data example :
     *
     * {
     *     "price": "7,877,523",
     *     "status": 0,
     *     "message": null
     * }
     *
     */
    function doEnquiryForSinglePlan(array $parameters);


    /**
     *
     * curl -X POST \
     *   'http://{{base_url}}/Inquery/plans' \
     *   -H 'Authorization: basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *   -H 'Content-Type: application/json' \
     *   -H 'cache-control: no-cache' \
     *   -d '{
     *           "BirthDate" : "1368-11-08",
     *           "CurrentInsuranceid": "91d9773e-98df-4657-8b49-8e622551d75b",
     *           "Diseaseids":[],
     *           "HasSurgery" :true,
     *           "Height" :"185",
     *           "RelativeDisease" : true,
     *           "RelativeDiseaseFather" :false,
     *           "RelativeDiseaseMother" : true,
     *           "Sex" : 0,
     *           "SmokesCigar" : true,
     *           "SmokesPerDay" : 3,
     *           "SmokesYears" :18,
     *           "SurgeryBodyPartids" : ["f250060b-2b5d-4774-821c-59a3ca0f2998"],
     *           "Weight" : "85"
     *       }'
     *
     *
     * @param array $parameters
     * @return array
     * @example return data 404- Bad request :
     *
     * {
     *     "priceList": null,
     *     "status": -1,
     *     "message": "BMI '30/4779662232421' برای سن '27' سال قابل قبول نیست."
     * }
     *
     */
    function doEnquiryForAllPlans(array $parameters);


}
