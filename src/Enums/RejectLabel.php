<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum RejectLabel: string
{
    case FORGERY                               = 'FORGERY';
    case DOCUMENT_TEMPLATE                     = 'DOCUMENT_TEMPLATE';
    case LOW_QUALITY                           = 'LOW_QUALITY';
    case SPAM                                  = 'SPAM';
    case NOT_DOCUMENT                          = 'NOT_DOCUMENT';
    case SELFIE_MISMATCH                       = 'SELFIE_MISMATCH';
    case ID_INVALID                            = 'ID_INVALID';
    case FOREIGNER                             = 'FOREIGNER';
    case DUPLICATE                             = 'DUPLICATE';
    case BAD_AVATAR                            = 'BAD_AVATAR';
    case WRONG_USER_REGION                     = 'WRONG_USER_REGION';
    case INCOMPLETE_DOCUMENT                   = 'INCOMPLETE_DOCUMENT';
    case BLACKLIST                             = 'BLACKLIST';
    case BLOCKLIST                             = 'BLOCKLIST';
    case UNSATISFACTORY_PHOTOS                 = 'UNSATISFACTORY_PHOTOS';
    case DOCUMENT_PAGE_MISSING                 = 'DOCUMENT_PAGE_MISSING';
    case DOCUMENT_DAMAGED                      = 'DOCUMENT_DAMAGED';
    case REGULATIONS_VIOLATIONS                = 'REGULATIONS_VIOLATIONS';
    case INCONSISTENT_PROFILE                  = 'INCONSISTENT_PROFILE';
    case PROBLEMATIC_APPLICANT_DATA            = 'PROBLEMATIC_APPLICANT_DATA';
    case ADDITIONAL_DOCUMENT_REQUIRED          = 'ADDITIONAL_DOCUMENT_REQUIRED';
    case AGE_REQUIREMENT_MISMATCH              = 'AGE_REQUIREMENT_MISMATCH';
    case EXPERIENCE_REQUIREMENT_MISMATCH       = 'EXPERIENCE_REQUIREMENT_MISMATCH';
    case CRIMINAL                              = 'CRIMINAL';
    case WRONG_ADDRESS                         = 'WRONG_ADDRESS';
    case GRAPHIC_EDITOR                        = 'GRAPHIC_EDITOR';
    case DOCUMENT_DEPRIVED                     = 'DOCUMENT_DEPRIVED';
    case COMPROMISED_PERSONS                   = 'COMPROMISED_PERSONS';
    case PEP                                   = 'PEP';
    case ADVERSE_MEDIA                         = 'ADVERSE_MEDIA';
    case FRAUDULENT_PATTERNS                   = 'FRAUDULENT_PATTERNS';
    case SANCTIONS                             = 'SANCTIONS';
    case NOT_ALL_CHECKS_COMPLETED              = 'NOT_ALL_CHECKS_COMPLETED';
    case FRONT_SIDE_MISSING                    = 'FRONT_SIDE_MISSING';
    case BACK_SIDE_MISSING                     = 'BACK_SIDE_MISSING';
    case SCREENSHOTS                           = 'SCREENSHOTS';
    case BLACK_AND_WHITE                       = 'BLACK_AND_WHITE';
    case INCOMPATIBLE_LANGUAGE                 = 'INCOMPATIBLE_LANGUAGE';
    case EXPIRATION_DATE                       = 'EXPIRATION_DATE';
    case UNFILLED_ID                           = 'UNFILLED_ID';
    case BAD_SELFIE                            = 'BAD_SELFIE';
    case BAD_VIDEO_SELFIE                      = 'BAD_VIDEO_SELFIE';
    case BAD_FACE_MATCHING                     = 'BAD_FACE_MATCHING';
    case BAD_PROOF_OF_IDENTITY                 = 'BAD_PROOF_OF_IDENTITY';
    case BAD_PROOF_OF_ADDRESS                  = 'BAD_PROOF_OF_ADDRESS';
    case BAD_PROOF_OF_PAYMENT                  = 'BAD_PROOF_OF_PAYMENT';
    case SELFIE_WITH_PAPER                     = 'SELFIE_WITH_PAPER';
    case FRAUDULENT_LIVENESS                   = 'FRAUDULENT_LIVENESS';
    case OTHER                                 = 'OTHER';
    case REQUESTED_DATA_MISMATCH               = 'REQUESTED_DATA_MISMATCH';
    case OK                                    = 'OK';
    case COMPANY_NOT_DEFINED_STRUCTURE         = 'COMPANY_NOT_DEFINED_STRUCTURE';
    case COMPANY_NOT_DEFINED_BENEFICIARIES     = 'COMPANY_NOT_DEFINED_BENEFICIARIES';
    case COMPANY_NOT_VALIDATED_BENEFICIARIES   = 'COMPANY_NOT_VALIDATED_BENEFICIARIES';
    case COMPANY_NOT_DEFINED_REPRESENTATIVES   = 'COMPANY_NOT_DEFINED_REPRESENTATIVES';
    case COMPANY_NOT_VALIDATED_REPRESENTATIVES = 'COMPANY_NOT_VALIDATED_REPRESENTATIVES';
    case APPLICANT_INTERRUPTED_INTERVIEW       = 'APPLICANT_INTERRUPTED_INTERVIEW';
    case DOCUMENT_MISSING                      = 'DOCUMENT_MISSING';
    case UNSUITABLE_ENV                        = 'UNSUITABLE_ENV';
    case CONNECTION_INTERRUPTED                = 'CONNECTION_INTERRUPTED';
}
