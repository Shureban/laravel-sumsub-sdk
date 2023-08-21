<?php

namespace Shureban\LaravelSumsubSdk\Enums;

enum WebhookType: string
{
    case ApplicantReviewed                = 'applicantReviewed';
    case ApplicantPending                 = 'applicantPending';
    case ApplicantCreated                 = 'applicantCreated';
    case ApplicantOnHold                  = 'applicantOnHold';
    case ApplicantPersonalInfoChanged     = 'applicantPersonalInfoChanged';
    case ApplicantPrechecked              = 'applicantPrechecked';
    case ApplicantDeleted                 = 'applicantDeleted';
    case ApplicantLevelChanged            = 'applicantLevelChanged';
    case VideoIdentStatusChanged          = 'videoIdentStatusChanged';
    case ApplicantReset                   = 'applicantReset';
    case ApplicantActionPending           = 'applicantActionPending';
    case ApplicantActionReviewed          = 'applicantActionReviewed';
    case ApplicantActionOnHold            = 'applicantActionOnHold';
    case ApplicantTravelRuleStatusChanged = 'applicantTravelRuleStatusChanged';
    case ApplicantWorkflowCompleted       = 'applicantWorkflowCompleted';
}
