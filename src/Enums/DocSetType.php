<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum DocSetType: string
{
    case PhoneVerification = 'PHONE_VERIFICATION';
    case EmailVerification = 'EMAIL_VERIFICATION';
    case Questionnaire     = 'QUESTIONNAIRE';
    case ApplicantData     = 'APPLICANT_DATA';
    case Identity          = 'IDENTITY';
    case Identity2         = 'IDENTITY2';
    case Identity3         = 'IDENTITY3';
    case Identity4         = 'IDENTITY4';
    case ProofOfResidence  = 'PROOF_OF_RESIDENCE';
    case ProofOfResidence2 = 'PROOF_OF_RESIDENCE2';
    case Selfie            = 'SELFIE';
    case Selfie2           = 'SELFIE2';
}
