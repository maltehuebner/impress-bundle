<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

class RemoteJsonFactory extends AbstractImpressFactory
{
    /** @var string $remoteUrl */
    protected $remoteUrl;

    public function setRemoteUrl(string $remoteUrl): void
    {
        $json = file_get_contents($remoteUrl);
        $this->remoteUrl = $remoteUrl;
    }
}