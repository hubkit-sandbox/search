<?php

declare(strict_types=1);

/*
 * This file is part of the RollerworksSearch package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\Search\ApiPlatform;

use Rollerworks\Component\Search\SearchCondition;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * The SearchConditionEvent allows to set a pre-condition.
 *
 * Call getSearchCondition()->setPreCondition() to set a pre-condition.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
final class SearchConditionEvent extends Event
{
    /**
     * @Event
     */
    public const SEARCH_CONDITION_EVENT = 'rollerworks_search.process.pre_condition';

    private $searchCondition;
    private $resourceClass;
    private $request;

    public function __construct(?SearchCondition $searchCondition, string $resourceClass, Request $request)
    {
        $this->searchCondition = $searchCondition;
        $this->resourceClass = $resourceClass;
        $this->request = $request;
    }

    public function getSearchCondition(): ?SearchCondition
    {
        return $this->searchCondition;
    }

    public function getResourceClass(): string
    {
        return $this->resourceClass;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
