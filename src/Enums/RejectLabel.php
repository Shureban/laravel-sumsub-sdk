<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum RejectLabel: string
{
    case Forgery                            = 'FORGERY';
    case DocumentTemplate                   = 'DOCUMENT_TEMPLATE';
    case LowQuality                         = 'LOW_QUALITY';
    case Spam                               = 'SPAM';
    case NotDocument                        = 'NOT_DOCUMENT';
    case SelfieMismatch                     = 'SELFIE_MISMATCH';
    case IdInvalid                          = 'ID_INVALID';
    case Foreigner                          = 'FOREIGNER';
    case Duplicate                          = 'DUPLICATE';
    case BadAvatar                          = 'BAD_AVATAR';
    case WrongUserRegion                    = 'WRONG_USER_REGION';
    case IncompleteDocument                 = 'INCOMPLETE_DOCUMENT';
    case Blacklist                          = 'BLACKLIST';
    case Blocklist                          = 'BLOCKLIST';
    case UnsatisfactoryPhotos               = 'UNSATISFACTORY_PHOTOS';
    case DocumentPageMissing                = 'DOCUMENT_PAGE_MISSING';
    case DocumentDamaged                    = 'DOCUMENT_DAMAGED';
    case RegulationsViolations              = 'REGULATIONS_VIOLATIONS';
    case InconsistentProfile                = 'INCONSISTENT_PROFILE';
    case ProblematicApplicantData           = 'PROBLEMATIC_APPLICANT_DATA';
    case AdditionalDocumentRequired         = 'ADDITIONAL_DOCUMENT_REQUIRED';
    case AgeRequirementMismatch             = 'AGE_REQUIREMENT_MISMATCH';
    case ExperienceRequirementMismatch      = 'EXPERIENCE_REQUIREMENT_MISMATCH';
    case Criminal                           = 'CRIMINAL';
    case WrongAddress                       = 'WRONG_ADDRESS';
    case GraphicEditor                      = 'GRAPHIC_EDITOR';
    case DocumentDeprived                   = 'DOCUMENT_DEPRIVED';
    case CompromisedPersons                 = 'COMPROMISED_PERSONS';
    case Pep                                = 'PEP';
    case AdverseMedia                       = 'ADVERSE_MEDIA';
    case FraudulentPatterns                 = 'FRAUDULENT_PATTERNS';
    case Sanctions                          = 'SANCTIONS';
    case NotAllChecksCompleted              = 'NOT_ALL_CHECKS_COMPLETED';
    case FrontSideMissing                   = 'FRONT_SIDE_MISSING';
    case BackSideMissing                    = 'BACK_SIDE_MISSING';
    case Screenshots                        = 'SCREENSHOTS';
    case BlackAndWhite                      = 'BLACK_AND_WHITE';
    case IncompatibleLanguage               = 'INCOMPATIBLE_LANGUAGE';
    case ExpirationDate                     = 'EXPIRATION_DATE';
    case UnfilledId                         = 'UNFILLED_ID';
    case BadSelfie                          = 'BAD_SELFIE';
    case BadVideoSelfie                     = 'BAD_VIDEO_SELFIE';
    case BadFaceMatching                    = 'BAD_FACE_MATCHING';
    case BadProofOfIdentity                 = 'BAD_PROOF_OF_IDENTITY';
    case BadProofOfAddress                  = 'BAD_PROOF_OF_ADDRESS';
    case BadProofOfPayment                  = 'BAD_PROOF_OF_PAYMENT';
    case SelfieWithPaper                    = 'SELFIE_WITH_PAPER';
    case FraudulentLiveness                 = 'FRAUDULENT_LIVENESS';
    case Other                              = 'OTHER';
    case RequestedDataMismatch              = 'REQUESTED_DATA_MISMATCH';
    case Ok                                 = 'OK';
    case CompanyNotDefinedStructure         = 'COMPANY_NOT_DEFINED_STRUCTURE';
    case CompanyNotDefinedBeneficiaries     = 'COMPANY_NOT_DEFINED_BENEFICIARIES';
    case CompanyNotValidatedBeneficiaries   = 'COMPANY_NOT_VALIDATED_BENEFICIARIES';
    case CompanyNotDefinedRepresentatives   = 'COMPANY_NOT_DEFINED_REPRESENTATIVES';
    case CompanyNotValidatedRepresentatives = 'COMPANY_NOT_VALIDATED_REPRESENTATIVES';
    case ApplicantInterruptedInterview      = 'APPLICANT_INTERRUPTED_INTERVIEW';
    case DocumentMissing                    = 'DOCUMENT_MISSING';
    case UnsuitableEnv                      = 'UNSUITABLE_ENV';
    case ConnectionInterrupted              = 'CONNECTION_INTERRUPTED';
}