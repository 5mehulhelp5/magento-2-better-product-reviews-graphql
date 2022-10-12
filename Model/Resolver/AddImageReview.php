<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_BetterProductReviewsGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\BetterProductReviewsGraphQl\Model\Resolver;

use Exception;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Review\Model\Review;

/**
 * Class AddImageReview
 * @package Mageplaza\BetterProductReviewsGraphQl\Model\Resolver
 */
class AddImageReview extends AbstractImageReview implements ResolverInterface
{
    /**
     * @param array $args
     *
     * @return Review | string
     * @throws GraphQlInputException
     */
    protected function processImage($args)
    {
        $data     = $args['input'];
        $image    = $data['base_64_encoded_data'];
        $fileName = $data['name'];
        $typeFile = $data['type_file'];
        $label    = $data['label'] ?? '';
        $reviewId = $args['reviewId'];
        try {
            $review = $this->_imageHelper->addMoreImage($reviewId, $image, $fileName, $typeFile, $label);
        } catch (Exception $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }

        return $review;
    }

}
