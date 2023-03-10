<?php

namespace Shureban\LaravelSumsubSdk\Dto\Responses;

use DateTime;

class CreateApplicantResponse
{
    public string   $id;
    public string   $key;
    public string   $type;
    public string   $clientId;
    public string   $inspectionId;
    public string   $externalUserId;
    public string   $applicantPlatform;
    public DateTime $createdAt;
}

/*
 {
  "info" : { },
  "requiredIdDocs" : {
    "excludedCountries" : [ "AFG", "BHS", "BRB", "GHA", "IRN", "IRQ", "JAM", "PRK", "MRT", "MMR", "NIC", "PAK", "PAN", "SYR", "TTO", "UGA", "VUT", "YEM", "ZWE" ], ◀    "excludedCountries" : [ "AFG", "BHS", "BRB", "GHA", "IRN", "IRQ", "JAM", "PRK", "MRT", "MMR", "NIC", "PAK", "PAN", "SYR", "TTO", "UGA", "VUT", "YEM", "ZWE"  ▶
    "docSets" : [ {
      "idDocSetType" : "EMAIL_VERIFICATION"
    }, {
      "idDocSetType" : "APPLICANT_DATA",
      "fields" : [ {
        "name" : "firstName",
        "required" : true
      }, {
        "name" : "lastName",
        "required" : true
      }, {
        "name" : "dob",
        "required" : true
      }, {
        "name" : "gender",
        "required" : true
      }, {
        "name" : "nationality",
        "required" : true
      }, {
        "name" : "country",
        "required" : true
      }, {
        "name" : "town",
        "required" : true
      }, {
        "name" : "street",
        "required" : true
      }, {
        "name" : "subStreet",
        "required" : false
      }, {
        "name" : "buildingNumber",
        "required" : true
      }, {
        "name" : "flatNumber",
        "required" : false
      } ]
    }, {
      "idDocSetType" : "IDENTITY",
      "types" : [ "ID_CARD", "PASSPORT", "RESIDENCE_PERMIT", "DRIVERS" ],
      "subTypes" : [ "FRONT_SIDE", "BACK_SIDE" ],
      "videoRequired" : "disabled"
    }, {
      "idDocSetType" : "SELFIE",
      "types" : [ "SELFIE" ],
      "videoRequired" : "disabled"
    } ]
  },
  "review" : {
    "reviewId" : "DnozQ",
    "attemptId" : "IVker",
    "attemptCnt" : 0,
    "levelName" : "basic-kyc-level",
    "createDate" : "2023-03-08 16:31:13+0000",
    "reviewStatus" : "init",
    "priority" : 0
  },
  "inspectionMetadata" : [ ]
}
*/