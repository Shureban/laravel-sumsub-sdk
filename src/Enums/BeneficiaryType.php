<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum BeneficiaryType: string
{
    case Director            = 'director';
    case Shareholder         = 'shareholder';
    case UBO                 = 'ubo';
    case Representative      = 'representative';
    case CompanyOfficer      = 'companyOfficer';
    case Investor            = 'investor';
    case Secretary           = 'secretary';
    case Founder             = 'founder';
    case LegalAdvisor        = 'legalAdvisor';
    case AuthorizedSignatory = 'authorizedSignatory';
    case Trustee             = 'trustee';
    case TrustBeneficiary    = 'trustBeneficiary';
    case TrustSettlor        = 'trustSettlor';
    case TrustProtector      = 'trustProtector';
}
