<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Psr\Cache\CacheItemPoolInterface;

abstract class AbstractCachingImpressFactory extends AbstractImpressFactory
{
    const CACHE_KEY = 'maltehuebner_impress_cache';

    protected CacheItemPoolInterface $adapter;

    protected int $ttl = 3600;

    public function __construct(CacheItemPoolInterface $adapter)
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
            ->expiresAt(new \DateTime(sprintf('@%d', time() + $this->ttl)))
        ;

        $this->adapter->save($cacheItem);
    }
}
