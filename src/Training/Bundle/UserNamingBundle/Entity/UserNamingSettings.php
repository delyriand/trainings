<?php

namespace Training\Bundle\UserNamingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @ORM\Entity
 */
class UserNamingSettings extends Transport
{
    /** @var ParameterBag */
    private $settings;

    /**
     * @var string
     *
     * @ORM\Column(name="training_usernaming_url", type="string", length=255)
     */
    private $url;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getSettingsBag()
    {
        if (null === $this->settings) {
            $this->settings = new ParameterBag([
                'url' => $this->getUrl(),
            ]);
        }

        return $this->settings;
    }
}