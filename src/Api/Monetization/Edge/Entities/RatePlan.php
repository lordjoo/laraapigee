<?php

namespace Lordjoo\LaraApigee\Api\Monetization\Edge\Entities;

class RatePlan extends AbstractEdgeMonetizationEntity
{
    protected ?bool $advance = null;

    protected ?int $contractDuration = null;

    protected ?string $contractDurationType = null;

    protected ?SimpleReference $currency = null;

    protected ?string $description = null;

    protected ?DeveloperInfo $developer = null;

    protected ?DeveloperCategory $developerCategory = null;

    protected ?string $displayName = null;

    protected ?int $earlyTerminationFee = null;

    protected ?string $endDate = null;

    protected ?int $freemiumDuration = null;

    protected ?string $freemiumDurationType = null;

    protected ?string $freemiumUnit = null;

    protected ?int $frequencyDuration = null;

    protected ?string $frequencyDurationType = null;

    protected ?string $id = null;

    protected ?bool $isPrivate = null;

    protected ?bool $keepOriginalStartDate = null;

    protected ?SimpleReference $monetizationPackage = null;

    protected ?string $name = null;

    protected ?Organization $organization = null;

    protected ?array $parentRatePlan = null;

    protected ?int $paymentDueDays = null;

    protected ?bool $prorate = null;

    protected ?bool $published = null;

    /** @var array<int, RatePlanDetails> */
    protected array $ratePlanDetails = [];

    protected ?int $recurringFee = null;

    protected int|float|null $recurringStartUnit = null;

    protected ?string $recurringType = null;

    protected ?int $setUpFee = null;

    protected ?string $startDate = null;

    protected ?string $type = null;

    public function getAdvance(): ?bool
    {
        return $this->advance;
    }

    public function setAdvance(?bool $advance): self
    {
        $this->advance = $advance;

        return $this;
    }

    public function getContractDuration(): ?int
    {
        return $this->contractDuration;
    }

    public function setContractDuration(?int $contractDuration): self
    {
        $this->contractDuration = $contractDuration;

        return $this;
    }

    public function getContractDurationType(): ?string
    {
        return $this->contractDurationType;
    }

    public function setContractDurationType(?string $contractDurationType): self
    {
        $this->contractDurationType = $contractDurationType;

        return $this;
    }

    public function getCurrency(): ?SimpleReference
    {
        return $this->currency;
    }

    public function setCurrency(null|array|SimpleReference $currency): self
    {
        $this->currency = $this->castNestedEntity($currency, SimpleReference::class);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeveloper(): ?DeveloperInfo
    {
        return $this->developer;
    }

    public function setDeveloper(null|array|DeveloperInfo $developer): self
    {
        $this->developer = $this->castNestedEntity($developer, DeveloperInfo::class);

        return $this;
    }

    public function getDeveloperCategory(): ?DeveloperCategory
    {
        return $this->developerCategory;
    }

    public function setDeveloperCategory(null|array|DeveloperCategory $developerCategory): self
    {
        $this->developerCategory = $this->castNestedEntity($developerCategory, DeveloperCategory::class);

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getEarlyTerminationFee(): ?int
    {
        return $this->earlyTerminationFee;
    }

    public function setEarlyTerminationFee(?int $earlyTerminationFee): self
    {
        $this->earlyTerminationFee = $earlyTerminationFee;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getFreemiumDuration(): ?int
    {
        return $this->freemiumDuration;
    }

    public function setFreemiumDuration(?int $freemiumDuration): self
    {
        $this->freemiumDuration = $freemiumDuration;

        return $this;
    }

    public function getFreemiumDurationType(): ?string
    {
        return $this->freemiumDurationType;
    }

    public function setFreemiumDurationType(?string $freemiumDurationType): self
    {
        $this->freemiumDurationType = $freemiumDurationType;

        return $this;
    }

    public function getFreemiumUnit(): ?string
    {
        return $this->freemiumUnit;
    }

    public function setFreemiumUnit(?string $freemiumUnit): self
    {
        $this->freemiumUnit = $freemiumUnit;

        return $this;
    }

    public function getFrequencyDuration(): ?int
    {
        return $this->frequencyDuration;
    }

    public function setFrequencyDuration(?int $frequencyDuration): self
    {
        $this->frequencyDuration = $frequencyDuration;

        return $this;
    }

    public function getFrequencyDurationType(): ?string
    {
        return $this->frequencyDurationType;
    }

    public function setFrequencyDurationType(?string $frequencyDurationType): self
    {
        $this->frequencyDurationType = $frequencyDurationType;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(?bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getKeepOriginalStartDate(): ?bool
    {
        return $this->keepOriginalStartDate;
    }

    public function setKeepOriginalStartDate(?bool $keepOriginalStartDate): self
    {
        $this->keepOriginalStartDate = $keepOriginalStartDate;

        return $this;
    }

    public function getMonetizationPackage(): ?SimpleReference
    {
        return $this->monetizationPackage;
    }

    public function setMonetizationPackage(null|array|SimpleReference $monetizationPackage): self
    {
        $this->monetizationPackage = $this->castNestedEntity($monetizationPackage, SimpleReference::class);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(null|array|Organization $organization): self
    {
        $this->organization = $this->castNestedEntity($organization, Organization::class);

        return $this;
    }

    public function getParentRatePlan(): ?array
    {
        return $this->parentRatePlan;
    }

    public function setParentRatePlan(?array $parentRatePlan): self
    {
        $this->parentRatePlan = $parentRatePlan;

        return $this;
    }

    public function getPaymentDueDays(): ?int
    {
        return $this->paymentDueDays;
    }

    public function setPaymentDueDays(?int $paymentDueDays): self
    {
        $this->paymentDueDays = $paymentDueDays;

        return $this;
    }

    public function getProrate(): ?bool
    {
        return $this->prorate;
    }

    public function setProrate(?bool $prorate): self
    {
        $this->prorate = $prorate;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getRatePlanDetails(): array
    {
        return $this->ratePlanDetails;
    }

    public function setRatePlanDetails(array $ratePlanDetails): self
    {
        $this->ratePlanDetails = $this->castNestedEntityArray($ratePlanDetails, RatePlanDetails::class);

        return $this;
    }

    public function getRecurringFee(): ?int
    {
        return $this->recurringFee;
    }

    public function setRecurringFee(?int $recurringFee): self
    {
        $this->recurringFee = $recurringFee;

        return $this;
    }

    public function getRecurringStartUnit(): int|float|null
    {
        return $this->recurringStartUnit;
    }

    public function setRecurringStartUnit(int|float|null $recurringStartUnit): self
    {
        $this->recurringStartUnit = $recurringStartUnit;

        return $this;
    }

    public function getRecurringType(): ?string
    {
        return $this->recurringType;
    }

    public function setRecurringType(?string $recurringType): self
    {
        $this->recurringType = $recurringType;

        return $this;
    }

    public function getSetUpFee(): ?int
    {
        return $this->setUpFee;
    }

    public function setSetUpFee(?int $setUpFee): self
    {
        $this->setUpFee = $setUpFee;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
