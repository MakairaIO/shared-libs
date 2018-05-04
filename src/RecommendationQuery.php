<?php
/**
 * This file is part of a marmalade GmbH project
 * It is not Open Source and may not be redistributed.
 * For contact information please visit http://www.marmalade.de
 *
 * @version 0.1
 * @author  Stefan Krenz <krenz@marmalade.de>
 * @link    http://www.marmalade.de
 */

namespace Makaira;

class RecommendationQuery extends AbstractQuery
{
    /**
     * @return string[]
     */
    public function getMandatoryConstraints()
    {
        return [
            Constraints::LANGUAGE => 'language',
            Constraints::SHOP => 'shop identifier',
            Constraints::RECOMMENDATION => 'recommendation identifier',
            Constraints::RECOMMENDATION_REQUEST => 'request identifier',
        ];
    }

    public function verify()
    {
        parent::verify();

        if (null === $this->count) {
            throw new \DomainException('Count must be set!');
        }

        if (1 > $this->count) {
            throw new \DomainException('Count must be greater than 0!');
        }
    }
}
