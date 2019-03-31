<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

abstract class AbstractCachingImpressFactory extends AbstractImpressFactory
{
    const CACHE_KEY = 'maltehuebner_impress_cache';

    /** @var AdapterInterface $adapter */
    protected $adapter;

    /** @var int $ttl */
    protected $ttl;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;

        parent::__construct();
    }

    public function setTtl(int $ttl): void
    {
        $this->ttl = $ttl;
    }

    final public function getImpress(): ImpressModel
    {
        $cacheItem = $this->adapter->getItem(self::CACHE_KEY);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $this->impressModel = $this->generateImpress();

        $this->saveImpressToCache($this->impressModel);

        return $this->impressModel;
    }

    abstract protected function generateImpress(): ImpressModel;

    protected function getImpressFromCache(): ?ImpressModel
    {
        $cacheItem = $this->adapter->getItem(self::CACHE_KEY);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        return null;
    }

    protected function saveImpressToCache(ImpressModel $impressModel): void
    {
        $cacheItem = $this->adapter->getItem(self::CACHE_KEY);

        $cacheItem
            ->set($impressModel)
            ->expiresAfter($this->ttl);

        $this->adapter->save($cacheItem);
    }
}