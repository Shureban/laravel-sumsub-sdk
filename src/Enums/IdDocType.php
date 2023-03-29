<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum IdDocType: string
{
    case IdCard                         = 'ID_CARD';
    case CompanyDoc                     = 'COMPANY_DOC';
    case Passport                       = 'PASSPORT';
    case Drivers                        = 'DRIVERS';
    case ResidencePermit                = 'RESIDENCE_PERMIT';
    case UtilityBill                    = 'UTILITY_BILL';
    case Selfie                         = 'SELFIE';
    case VideoSelfie                    = 'VIDEO_SELFIE';
    case ProfileImage                   = 'PROFILE_IMAGE';
    case IdDocPhoto                     = 'ID_DOC_PHOTO';
    case Agreement                      = 'AGREEMENT';
    case Contract                       = 'CONTRACT';
    case DriversTranslation             = 'DRIVERS_TRANSLATION';
    case InvestorDoc                    = 'INVESTOR_DOC';
    case VehicleRegistrationCertificate = 'VEHICLE_REGISTRATION_CERTIFICATE';
    case IncomeSource                   = 'INCOME_SOURCE';
    case PaymentMethod                  = 'PAYMENT_METHOD';
    case BankCard                       = 'BANK_CARD';
    case CovidVaccinationForm           = 'COVID_VACCINATION_FORM';
    case Other                          = 'OTHER';
}
