<?php

namespace Shureban\LaravelSumsubSdk\Tests\Unit\Dto;

use DateTime;
use Shureban\LaravelObjectMapper\ObjectMapper;
use Shureban\LaravelSumsubSdk\Attributes\Level;
use Shureban\LaravelSumsubSdk\Dto\Address;
use Shureban\LaravelSumsubSdk\Dto\Agreement;
use Shureban\LaravelSumsubSdk\Dto\Beneficiary;
use Shureban\LaravelSumsubSdk\Dto\CompanyInfo;
use Shureban\LaravelSumsubSdk\Dto\DocSet;
use Shureban\LaravelSumsubSdk\Dto\DocSetField;
use Shureban\LaravelSumsubSdk\Dto\FixedInfo;
use Shureban\LaravelSumsubSdk\Dto\IdDoc;
use Shureban\LaravelSumsubSdk\Dto\Info;
use Shureban\LaravelSumsubSdk\Dto\MetaData;
use Shureban\LaravelSumsubSdk\Dto\Questionnaire;
use Shureban\LaravelSumsubSdk\Dto\RequiredIdDoc;
use Shureban\LaravelSumsubSdk\Dto\Responses\ApplicantData;
use Shureban\LaravelSumsubSdk\Dto\Review;
use Shureban\LaravelSumsubSdk\Dto\ReviewResult;
use Shureban\LaravelSumsubSdk\Enums\ApplicantType;
use Shureban\LaravelSumsubSdk\Enums\BeneficiaryType;
use Shureban\LaravelSumsubSdk\Enums\Country;
use Shureban\LaravelSumsubSdk\Enums\DocSubType;
use Shureban\LaravelSumsubSdk\Enums\Gender;
use Shureban\LaravelSumsubSdk\Enums\ReviewAnswer;
use Shureban\LaravelSumsubSdk\Enums\ReviewRejectType;
use Shureban\LaravelSumsubSdk\Enums\ReviewStatus;
use Shureban\LaravelSumsubSdk\Tests\TestCase;
use stdClass;
use Throwable;

class ApplicantDataMappingTest extends TestCase
{
    public function testTopLevelScalarFields(): void
    {
        $applicant = $this->mapIndividual();

        $this->assertSame('5f0b6f2b1b7b3f0001a1b2c3', $applicant->id);
        $this->assertSame('service-account', $applicant->createdBy);
        $this->assertSame('TESTKEY', $applicant->key);
        $this->assertSame('acme_corp', $applicant->clientId);
        $this->assertSame('5f0b6f2b1b7b3f0001a1b2c4', $applicant->inspectionId);
        $this->assertSame('user-42', $applicant->externalUserId);
        $this->assertSame('API', $applicant->applicantPlatform);
        $this->assertSame(ApplicantType::Individual, $applicant->type);
        $this->assertSame(Country::UKR, $applicant->ipCountry);
        $this->assertSame('web', $applicant->sourceKey);
        $this->assertSame('auth-123', $applicant->authCode);
        $this->assertSame('john@example.com', $applicant->email);
        $this->assertSame('+380501234567', $applicant->phone);
        $this->assertSame('en', $applicant->lang);
        $this->assertInstanceOf(DateTime::class, $applicant->createdAt);
        $this->assertSame('2024-05-10 12:34:56', $applicant->createdAt->format('Y-m-d H:i:s'));
        $this->assertSame('UTC', $applicant->createdAt->getTimezone()->getName());
    }

    public function testInfoBlock(): void
    {
        $info = $this->mapIndividual()->info;

        $this->assertInstanceOf(Info::class, $info);
        $this->assertSame('John', $info->firstName);
        $this->assertSame('John', $info->firstNameEn);
        $this->assertSame('Doe', $info->lastName);
        $this->assertSame('Doe', $info->lastNameEn);
        $this->assertSame('1990-01-15', $info->dob->format('Y-m-d'));
        $this->assertSame(Country::UKR, $info->country);
        $this->assertNull($info->companyInfo);
    }

    public function testInfoAddresses(): void
    {
        $addresses = $this->mapIndividual()->info->addresses;

        $this->assertCount(1, $addresses);
        $this->assertContainsOnlyInstancesOf(Address::class, $addresses);

        $address = $addresses[0];
        $this->assertSame(Country::UKR, $address->country);
        $this->assertSame('01001', $address->postCode);
        $this->assertSame('Київ', $address->town);
        $this->assertSame('Kyiv', $address->townEn);
        $this->assertSame('Хрещатик 1', $address->street);
        $this->assertSame('Khreshchatyk 1', $address->streetEn);
        $this->assertSame('корп. 2', $address->subStreet);
        $this->assertSame('bldg. 2', $address->subStreetEn);
        $this->assertSame('Київська', $address->state);
        $this->assertSame('Kyiv', $address->stateEn);
        $this->assertSame('Khreshchatyk 1, Kyiv, 01001, Ukraine', $address->formattedAddress);
        $this->assertSame('Tower', $address->buildingName);
        $this->assertSame('7', $address->flatNumber);
        $this->assertSame('1', $address->buildingNumber);
    }

    public function testInfoIdDocsIgnoreUnknownKeys(): void
    {
        $idDocs = $this->mapIndividual()->info->idDocs;

        $this->assertCount(2, $idDocs);
        $this->assertContainsOnlyInstancesOf(IdDoc::class, $idDocs);
        $this->assertSame('PASSPORT', $idDocs[0]->idDocType);
        $this->assertSame(Country::UKR, $idDocs[0]->country);
        $this->assertSame('UTILITY_BILL', $idDocs[1]->idDocType);
        $this->assertSame(Country::POL, $idDocs[1]->country);
    }

    public function testFixedInfoBlock(): void
    {
        $fixedInfo = $this->mapIndividual()->fixedInfo;

        $this->assertInstanceOf(FixedInfo::class, $fixedInfo);
        $this->assertSame('John', $fixedInfo->firstName);
        $this->assertSame('Doe', $fixedInfo->lastName);
        $this->assertSame('Michael', $fixedInfo->middleName);
        $this->assertSame('John', $fixedInfo->firstNameEn);
        $this->assertSame('Doe', $fixedInfo->lastNameEn);
        $this->assertSame('Michael', $fixedInfo->middleNameEn);
        $this->assertSame('John M. Doe', $fixedInfo->legalName);
        $this->assertSame(Gender::Male, $fixedInfo->gender);
        $this->assertSame('1990-01-15', $fixedInfo->dob->format('Y-m-d'));
        $this->assertSame('Kyiv', $fixedInfo->placeOfBirth);
        $this->assertSame('UKR', $fixedInfo->countryOfBirth);
        $this->assertSame('Kyiv', $fixedInfo->stateOfBirth);
        $this->assertSame(Country::UKR, $fixedInfo->country);
        $this->assertSame(Country::POL, $fixedInfo->nationality);
        $this->assertSame('1234567890', $fixedInfo->tin);
        $this->assertNull($fixedInfo->companyInfo);

        $this->assertCount(1, $fixedInfo->addresses);
        $this->assertSame(Country::POL, $fixedInfo->addresses[0]->country);
        $this->assertSame('Warsaw', $fixedInfo->addresses[0]->town);
        $this->assertSame('Marszałkowska 1', $fixedInfo->addresses[0]->street);
        $this->assertNull($fixedInfo->addresses[0]->postCode);
    }

    public function testAgreementBlock(): void
    {
        $agreement = $this->mapIndividual()->agreement;

        $this->assertInstanceOf(Agreement::class, $agreement);
        $this->assertSame('WebSDK', $agreement->source);
        $this->assertSame('https://sumsub.com/consent', $agreement->link);
        $this->assertSame(['version' => 9], $agreement->content);
        $this->assertSame(['constConsentEn_v9'], $agreement->targets);
        $this->assertSame(['rec-1', 'rec-2'], $agreement->recordIds);
        $this->assertSame('2024-05-10 12:35:00', $agreement->createdAt->format('Y-m-d H:i:s'));
        $this->assertSame('2024-05-10 12:35:10', $agreement->acceptedAt->format('Y-m-d H:i:s'));
    }

    public function testRequiredIdDocsBlock(): void
    {
        $required = $this->mapIndividual()->requiredIdDocs;

        $this->assertInstanceOf(RequiredIdDoc::class, $required);
        $this->assertSame([Country::RUS, Country::BLR], $required->excludedCountries);
        $this->assertCount(2, $required->docSets);
        $this->assertContainsOnlyInstancesOf(DocSet::class, $required->docSets);

        $identity = $required->docSets[0];
        $this->assertSame('IDENTITY', $identity->idDocSetType);
        $this->assertSame(['PASSPORT', 'ID_CARD'], $identity->types);
        $this->assertSame([DocSubType::FrontSide, DocSubType::BackSide], $identity->subTypes);
        $this->assertSame('disabled', $identity->videoRequired);

        $this->assertCount(2, $identity->fields);
        $this->assertContainsOnlyInstancesOf(DocSetField::class, $identity->fields);
        $this->assertSame('firstName', $identity->fields[0]->name);
        $this->assertTrue($identity->fields[0]->required);
        $this->assertTrue($identity->fields[0]->prefill);
        $this->assertNull($identity->fields[0]->immutableIfPresent);
        $this->assertSame('lastName', $identity->fields[1]->name);
        $this->assertNull($identity->fields[1]->prefill);

        $this->assertCount(1, $identity->customFields);
        $this->assertSame('customField1', $identity->customFields[0]->name);
        $this->assertFalse($identity->customFields[0]->required);
        $this->assertTrue($identity->customFields[0]->immutableIfPresent);

        $company = $required->docSets[1];
        $this->assertSame('COMPANY', $company->idDocSetType);
        $this->assertSame([DocSubType::ShareholderRegistry], $company->subTypes);
        $this->assertSame([], $company->fields);
        $this->assertSame([], $company->customFields);
        $this->assertNull($company->videoRequired);
    }

    public function testMetadataBlock(): void
    {
        $metadata = $this->mapIndividual()->metadata;

        $this->assertCount(2, $metadata);
        $this->assertContainsOnlyInstancesOf(MetaData::class, $metadata);
        $this->assertSame('plan', $metadata[0]->key);
        $this->assertSame('premium', $metadata[0]->value);
        $this->assertSame('source', $metadata[1]->key);
        $this->assertSame('landing', $metadata[1]->value);
    }

    public function testReviewBlock(): void
    {
        $review = $this->mapIndividual()->review;

        $this->assertInstanceOf(Review::class, $review);
        $this->assertSame(ReviewStatus::Completed, $review->reviewStatus);
        $this->assertInstanceOf(Level::class, $review->levelName);
        $this->assertSame('basic-kyc-level', (string)$review->levelName);
        $this->assertSame(0, $review->priority);
        $this->assertSame('rev-1', $review->reviewId);
        $this->assertSame('att-1', $review->attemptId);
        $this->assertSame(2, $review->attemptCnt);
        $this->assertSame(1200, $review->elapsedSincePendingMs);
        $this->assertSame(1300, $review->elapsedSinceQueuedMs);
        $this->assertFalse($review->reprocessing);
        $this->assertSame('2024-05-10 12:36:00', $review->createDate->format('Y-m-d H:i:s'));
        $this->assertSame('2024-05-10 12:40:00', $review->reviewDate->format('Y-m-d H:i:s'));

        $result = $review->reviewResult;
        $this->assertInstanceOf(ReviewResult::class, $result);
        $this->assertSame(ReviewAnswer::Red, $result->reviewAnswer);
        $this->assertSame(ReviewRejectType::Retry, $result->reviewRejectType);
        $this->assertSame(['UNSATISFACTORY_PHOTOS', 'BAD_SELFIE'], $result->rejectLabels);
        $this->assertSame('Please retake the photo.', $result->moderationComment);
        $this->assertSame('Photo is blurry.', $result->clientComment);
    }

    public function testQuestionnairesBlock(): void
    {
        $questionnaires = $this->mapIndividual()->questionnaires;

        $this->assertCount(1, $questionnaires);
        $this->assertContainsOnlyInstancesOf(Questionnaire::class, $questionnaires);
        $this->assertSame('kyc_questionnaire', $questionnaires[0]->id);
        $this->assertSame(0.5, $questionnaires[0]->score);
        $this->assertIsArray($questionnaires[0]->sections);
        $this->assertSame(['personal', 'employment'], array_keys($questionnaires[0]->sections));
        $this->assertContainsOnlyInstancesOf(stdClass::class, $questionnaires[0]->sections);
    }

    public function testInspectionMetadataBlock(): void
    {
        $applicant = $this->mapIndividual();

        $this->assertCount(1, $applicant->inspectionMetadata);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $applicant->inspectionMetadata);
    }

    public function testCompanyApplicant(): void
    {
        $applicant = $this->mapCompany();

        $this->assertSame('6a1b2c3d4e5f60718293a4b5', $applicant->id);
        $this->assertSame(ApplicantType::Company, $applicant->type);
        $this->assertSame('company-7', $applicant->externalUserId);
        $this->assertNull($applicant->info);
        $this->assertNull($applicant->agreement);
        $this->assertNull($applicant->ipCountry);
        $this->assertSame([], $applicant->metadata);
        $this->assertSame([], $applicant->questionnaires);
        $this->assertSame([], $applicant->inspectionMetadata);
    }

    public function testCompanyInfoAndBeneficiaries(): void
    {
        $companyInfo = $this->mapCompany()->fixedInfo->companyInfo;

        $this->assertInstanceOf(CompanyInfo::class, $companyInfo);
        $this->assertSame('ACME LTD', $companyInfo->companyName);
        $this->assertSame('12345678', $companyInfo->registrationNumber);
        $this->assertSame(Country::GBR, $companyInfo->country);
        $this->assertSame('1 Main St, London', $companyInfo->legalAddress);
        $this->assertSame('+441234567890', $companyInfo->phone);
        $this->assertSame('https://acme.example', $companyInfo->website);
        $this->assertSame('PO Box 1, London', $companyInfo->postalAddress);

        $this->assertCount(2, $companyInfo->beneficiaries);
        $this->assertContainsOnlyInstancesOf(Beneficiary::class, $companyInfo->beneficiaries);

        $director = $companyInfo->beneficiaries[0];
        $this->assertSame('ben-1', $director->applicantId);
        $this->assertSame(['director', 'shareholder'], $director->positions);
        $this->assertSame(BeneficiaryType::Director, $director->type);
        $this->assertTrue($director->inRegistry);
        $this->assertSame(['img-1', 'img-2'], $director->imageIds);
        $this->assertSame(51.5, $director->shareSize);
        $this->assertSame(['id' => 'ben-1', 'externalUserId' => 'person-1'], $director->applicant);

        $ubo = $companyInfo->beneficiaries[1];
        $this->assertSame('ben-2', $ubo->applicantId);
        $this->assertSame(BeneficiaryType::UBO, $ubo->type);
        $this->assertNull($ubo->positions);
        $this->assertFalse($ubo->inRegistry);
        $this->assertNull($ubo->imageIds);
        $this->assertNull($ubo->applicant);
        $this->assertNull($ubo->shareSize);
    }

    public function testCompanyReviewWithoutResult(): void
    {
        $review = $this->mapCompany()->review;

        $this->assertSame(ReviewStatus::AwaitingUser, $review->reviewStatus);
        $this->assertSame('basic-kyb-level', (string)$review->levelName);
        $this->assertSame(1, $review->attemptCnt);
        $this->assertNull($review->reviewResult);
        $this->assertNull($review->reviewDate);
        $this->assertNull($review->priority);
        $this->assertNull($review->reprocessing);
    }

    public function testExplicitNullsKeepDefaults(): void
    {
        $applicant = $this->mapCompany();

        $this->assertNull($applicant->email);
        $this->assertNull($applicant->phone);
        $this->assertNull($applicant->lang);
        $this->assertNull($applicant->sourceKey);
    }

    public function testMissingRequiredFieldsStayUninitialized(): void
    {
        $applicant = (new ObjectMapper(new ApplicantData()))->mapFromJson('{"id":"only-id"}');

        $this->assertSame('only-id', $applicant->id);
        $this->assertFalse(isset($applicant->review));
        $this->assertFalse(isset($applicant->createdAt));
        $this->assertNull($applicant->info);
        $this->assertSame([], $applicant->metadata);
    }

    public function testUnknownEnumValueThrows(): void
    {
        $this->expectException(Throwable::class);

        (new ObjectMapper(new ApplicantData()))->mapFromJson('{"id":"x","ipCountry":"XXX"}');
    }

    public function testUnknownReviewStatusThrows(): void
    {
        $this->expectException(Throwable::class);

        (new ObjectMapper(new ApplicantData()))->mapFromJson('{"id":"x","review":{"reviewStatus":"unknownStatus"}}');
    }

    public function testMapFromArrayProducesSameResultAsJson(): void
    {
        $fromJson  = $this->mapIndividual();
        $fromArray = (new ObjectMapper(new ApplicantData()))->mapFromArray(json_decode($this->fixture('applicant_individual.json'), true));

        $this->assertEquals($fromJson, $fromArray);
    }

    /**
     * @return ApplicantData
     */
    private function mapIndividual(): ApplicantData
    {
        return (new ObjectMapper(new ApplicantData()))->mapFromJson($this->fixture('applicant_individual.json'));
    }

    /**
     * @return ApplicantData
     */
    private function mapCompany(): ApplicantData
    {
        return (new ObjectMapper(new ApplicantData()))->mapFromJson($this->fixture('applicant_company.json'));
    }
}
