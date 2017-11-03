<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 03.11.17
 * Time: 16:59
 */

namespace AppBundle\FormData;

use AppBundle\Validator\Constraints\AppRoute;
use Symfony\Component\Validator\Constraints as Assert;

class OembedResolverFormData {
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Url()
     * @AppRoute(routes = {"embed_map_slug", "embed_point_id"})
     */
    public $url;

    /**
     * @var string
     *
     * @Assert\Choice({ "xml", "json"})
     */
    public $format;

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl( string $url ) {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat( $format ) {
        $this->format = $format;
    }


}
