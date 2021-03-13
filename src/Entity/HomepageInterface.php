<?php

namespace App\Entity;

use App\Repository\HomepageInterfaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomepageInterfaceRepository::class)
 */
class HomepageInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $buttonText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rightImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $privacyPolicy;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $privacyPolicyFirst;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $privacyPolicyTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem1Image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem1Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem1Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem2Image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem2Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem2Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem3Image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem3Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuresItem3Description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getButtonText(): ?string
    {
        return $this->buttonText;
    }

    public function setButtonText(string $buttonText): self
    {
        $this->buttonText = $buttonText;

        return $this;
    }

    public function getRightImage(): ?string
    {
        return $this->rightImage;
    }

    public function setRightImage(string $rightImage): self
    {
        $this->rightImage = $rightImage;

        return $this;
    }

    public function getPrivacyPolicy(): ?string
    {
        return $this->privacyPolicy;
    }

    public function setPrivacyPolicy(string $privacyPolicy): self
    {
        $this->privacyPolicy = $privacyPolicy;

        return $this;
    }

    public function getPrivacyPolicyFirst(): ?string
    {
        return $this->privacyPolicyFirst;
    }

    public function setPrivacyPolicyFirst(string $privacyPolicyFirst): self
    {
        $this->privacyPolicyFirst = $privacyPolicyFirst;

        return $this;
    }

    public function getPrivacyPolicyTwo(): ?string
    {
        return $this->privacyPolicyTwo;
    }

    public function setPrivacyPolicyTwo(string $privacyPolicyTwo): self
    {
        $this->privacyPolicyTwo = $privacyPolicyTwo;

        return $this;
    }

    public function getFeaturesTitle(): ?string
    {
        return $this->featuresTitle;
    }

    public function setFeaturesTitle(string $featuresTitle): self
    {
        $this->featuresTitle = $featuresTitle;

        return $this;
    }

    public function getFeaturesDescription(): ?string
    {
        return $this->featuresDescription;
    }

    public function setFeaturesDescription(string $featuresDescription): self
    {
        $this->featuresDescription = $featuresDescription;

        return $this;
    }

    public function getFeaturesItem1Image(): ?string
    {
        return $this->featuresItem1Image;
    }

    public function setFeaturesItem1Image(string $featuresItem1Image): self
    {
        $this->featuresItem1Image = $featuresItem1Image;

        return $this;
    }

    public function getFeaturesItem1Title(): ?string
    {
        return $this->featuresItem1Title;
    }

    public function setFeaturesItem1Title(string $featuresItem1Title): self
    {
        $this->featuresItem1Title = $featuresItem1Title;

        return $this;
    }

    public function getFeaturesItem1Description(): ?string
    {
        return $this->featuresItem1Description;
    }

    public function setFeaturesItem1Description(string $featuresItem1Description): self
    {
        $this->featuresItem1Description = $featuresItem1Description;

        return $this;
    }

    public function getFeaturesItem2Image(): ?string
    {
        return $this->featuresItem2Image;
    }

    public function setFeaturesItem2Image(string $featuresItem2Image): self
    {
        $this->featuresItem2Image = $featuresItem2Image;

        return $this;
    }

    public function getFeaturesItem2Title(): ?string
    {
        return $this->featuresItem2Title;
    }

    public function setFeaturesItem2Title(string $featuresItem2Title): self
    {
        $this->featuresItem2Title = $featuresItem2Title;

        return $this;
    }

    public function getFeaturesItem2Description(): ?string
    {
        return $this->featuresItem2Description;
    }

    public function setFeaturesItem2Description(string $featuresItem2Description): self
    {
        $this->featuresItem2Description = $featuresItem2Description;

        return $this;
    }

    public function getFeaturesItem3Image(): ?string
    {
        return $this->featuresItem3Image;
    }

    public function setFeaturesItem3Image(string $featuresItem3Image): self
    {
        $this->featuresItem3Image = $featuresItem3Image;

        return $this;
    }

    public function getFeaturesItem3Title(): ?string
    {
        return $this->featuresItem3Title;
    }

    public function setFeaturesItem3Title(string $featuresItem3Title): self
    {
        $this->featuresItem3Title = $featuresItem3Title;

        return $this;
    }

    public function getFeaturesItem3Description(): ?string
    {
        return $this->featuresItem3Description;
    }

    public function setFeaturesItem3Description(string $featuresItem3Description): self
    {
        $this->featuresItem3Description = $featuresItem3Description;

        return $this;
    }
}
