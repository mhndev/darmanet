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
     *
     *
     * curl request :
     *
     * curl -X POST \
     *       http://185.208.175.77/Babimam_Test/api/v1/planCovers%E2%80%AC \
     *       -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
     *       -H 'Content-Type: application/json' \
     *       -H 'cache-control: no-cache' \
     *       -d '{"planExIds": ["4634b989-25a9-4e78-934b-b7ceaa6763dc","a13b43ce-f660-4778-83f8-7ddc15074268"]}'
     *
     *
     * @example response
     *
     * [
            {
                "planTitle": "مهر سامان",
                "planExId": "4634b989-25a9-4e78-934b-b7ceaa6763dc",
                "covers": [
                        {
                            "coverId": "4003b0a6-4d50-415d-95fd-169968360f78",
                            "description": "بیمارستانی",
                            "price": 30000000
                        },
                        {
                            "coverId": "fbe743e5-2ac1-4fdc-abef-65cdc5f25133",
                            "description": "اعمال جراحی مهم با احتساب بند 1",
                            "price": 60000000
                        },
                        {
                            "coverId": "8ed7d47d-fb36-42e2-bde3-2dd5fadc1737",
                            "description": "پاراکلینیکی گروه اول",
                            "price": 3000000
                        },
                        {
                            "coverId": "465cde7e-ac9d-4a07-a3e7-d752f363c353",
                            "description": "پاراکلینیکی گروه دوم",
                            "price": 1500000
                        },
                        {
                            "coverId": "4af8ebc2-6eeb-4ce6-891b-0d682cfb7cd2",
                            "description": "جراحی های مجاز سرپایی",
                            "price": 1500000
                        },
                        {
                            "coverId": "afb6daf7-5f05-4b42-9f43-3169d4d5a037",
                            "description": "خدمات آزمایشگاهی",
                            "price": 1000000
                        },
                        {
                            "coverId": "4ef88381-c81b-4b18-9a95-d84ee8d1ca13",
                            "description": "جبران هزینه های آمبولانس شهری و بین شهری",
                            "price": 2000000
                        },
                        {
                            "coverId": "39f3a3a3-7986-417a-9a5b-8142e8b17cee",
                            "description": "زایمان",
                            "price": 15000000
                        },
                        {
                            "coverId": "f4cc0360-bf7f-444f-a0e2-b1e30f0586b6",
                            "description": "ویزیت و دارو",
                            "price": 1000000
                        },
                        {
                            "coverId": "c246ed7e-7cf0-4838-bac0-bffd9c6500b2",
                            "description": "دندانپزشکی",
                            "price": 1000000
                        },
                        {
                            "coverId": "6772baa7-9bd4-48a3-8226-bef162803ef5",
                            "description": "نازایی",
                            "price": 15000000
                        },
                        {
                            "coverId": "c1dac4cc-09d5-442e-a357-a98f2b96679e",
                            "description": "رفع عیوب انکساری دو چشم",
                            "price": 6000000
                        },
                        {
                            "coverId": "27e0c441-f831-457c-a365-2acb559e999f",
                            "description": "سمعک",
                            "price": 1500000
                        }
                ]
            },
            {
                "planTitle": "وصال سامان",
                "planExId": "a13b43ce-f660-4778-83f8-7ddc15074268",
                "covers": [
                        {
                            "coverId": "4003b0a6-4d50-415d-95fd-169968360f78",
                            "description": "بیمارستانی",
                            "price": 150000000
                        },
                        {
                            "coverId": "fbe743e5-2ac1-4fdc-abef-65cdc5f25133",
                            "description": "اعمال جراحی مهم با احتساب بند 1",
                            "price": 300000000
                        },
                        {
                            "coverId": "8ed7d47d-fb36-42e2-bde3-2dd5fadc1737",
                            "description": "پاراکلینیکی گروه اول",
                            "price": 15000000
                        },
                        {
                            "coverId": "465cde7e-ac9d-4a07-a3e7-d752f363c353",
                            "description": "پاراکلینیکی گروه دوم",
                            "price": 7500000
                        },
                        {
                            "coverId": "4af8ebc2-6eeb-4ce6-891b-0d682cfb7cd2",
                            "description": "جراحی های مجاز سرپایی",
                            "price": 10000000
                        },
                        {
                            "coverId": "afb6daf7-5f05-4b42-9f43-3169d4d5a037",
                            "description": "خدمات آزمایشگاهی",
                            "price": 7500000
                        },
                        {
                            "coverId": "4ef88381-c81b-4b18-9a95-d84ee8d1ca13",
                            "description": "جبران هزینه های آمبولانس شهری و بین شهری",
                            "price": 5000000
                        },
                        {
                            "coverId": "39f3a3a3-7986-417a-9a5b-8142e8b17cee",
                            "description": "زایمان",
                            "price": 50000000
                        },
                        {
                            "coverId": "f4cc0360-bf7f-444f-a0e2-b1e30f0586b6",
                            "description": "ویزیت و دارو",
                            "price": 8000000
                        },
                        {
                            "coverId": "c246ed7e-7cf0-4838-bac0-bffd9c6500b2",
                            "description": "دندانپزشکی",
                            "price": 10000000
                        },
                        {
                            "coverId": "6772baa7-9bd4-48a3-8226-bef162803ef5",
                            "description": "نازایی",
                            "price": 50000000
                        },
                        {
                            "coverId": "c1dac4cc-09d5-442e-a357-a98f2b96679e",
                            "description": "رفع عیوب انکساری دو چشم",
                            "price": 20000000
                        },
                        {
                            "coverId": "27e0c441-f831-457c-a365-2acb559e999f",
                            "description": "سمعک",
                            "price": 6000000
                        }
                ]
            }
    ]
     *
     * @param array $plan_ids => @example : ["a13b43ce-f660-4778-83f8-7ddc15074268", "4634b989-25a9-4e78-934b-b7ceaa6763dc" ]
     *
     * @return array
     */
    function getPlanCovers(array $plan_ids);


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
     *       -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
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
     *   -H 'Authorization: Basic QHpLaUAxMjM6QFpLaT85ODAxITk4MDI+' \
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
