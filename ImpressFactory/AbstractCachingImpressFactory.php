<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use Psr\Cache\CacheItemPoolInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

abstract class AbstractCachingImpressFactory extends AbstractImpressFactory
{
    protected const string CACHE_KEY = 'maltehuebner_impress_cache';
    protected const int CACHE_TTL = 3600;

    public function __construct(protected readonly CacheItemPoolInterface $adapter)
    {
        parent::__construct();
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
            ->expiresAt(new \DateTime(sprintf('@%d', time() + self::CACHE_TTL)))
        ;

        $this->adapter->save($cacheItem);
    }
}
