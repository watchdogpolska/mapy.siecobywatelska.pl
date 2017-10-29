<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 29.10.17
 * Time: 16:30
 */

namespace AppBundle\Entity\OEmbed;


use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class BaseOembed
 * @package AppBundle\Entity\OEmbed
 *
 * @ExclusionPolicy("none")
 */
abstract class BaseOembed {
    private $type;
    private $version = "1.0";
    private $title;
    private $author_name;
    private $author_url;
    private $provider_name;
    private $provider_url;
    private $cache_age;
    private $thumbnail_url;
    private $thumbnail_width;
    private $thumbnail_height;

    /**
     * BaseOembed constructor.
     *
     * @param $type
     */
    public function __construct( $type ) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return BaseOembed
     */
    public function setType( $type ) {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return BaseOembed
     */
    public function setVersion( string $version ): BaseOembed {
        $this->version = $version;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return BaseOembed
     */
    public function setTitle( $title ) {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorName() {
        return $this->author_name;
    }

    /**
     * @param mixed $author_name
     *
     * @return BaseOembed
     */
    public function setAuthorName( $author_name ) {
        $this->author_name = $author_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorUrl() {
        return $this->author_url;
    }

    /**
     * @param mixed $author_url
     *
     * @return BaseOembed
     */
    public function setAuthorUrl( $author_url ) {
        $this->author_url = $author_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderName() {
        return $this->provider_name;
    }

    /**
     * @param mixed $provider_name
     *
     * @return BaseOembed
     */
    public function setProviderName( $provider_name ) {
        $this->provider_name = $provider_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderUrl() {
        return $this->provider_url;
    }

    /**
     * @param mixed $provider_url
     *
     * @return BaseOembed
     */
    public function setProviderUrl( $provider_url ) {
        $this->provider_url = $provider_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCacheAge() {
        return $this->cache_age;
    }

    /**
     * @param mixed $cache_age
     *
     * @return BaseOembed
     */
    public function setCacheAge( $cache_age ) {
        $this->cache_age = $cache_age;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailUrl() {
        return $this->thumbnail_url;
    }

    /**
     * @param mixed $thumbnail_url
     *
     * @return BaseOembed
     */
    public function setThumbnailUrl( $thumbnail_url ) {
        $this->thumbnail_url = $thumbnail_url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailWidth() {
        return $this->thumbnail_width;
    }

    /**
     * @param mixed $thumbnail_width
     *
     * @return BaseOembed
     */
    public function setThumbnailWidth( $thumbnail_width ) {
        $this->thumbnail_width = $thumbnail_width;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailHeight() {
        return $this->thumbnail_height;
    }

    /**
     * @param mixed $thumbnail_height
     *
     * @return BaseOembed
     */
    public function setThumbnailHeight( $thumbnail_height ) {
        $this->thumbnail_height = $thumbnail_height;

        return $this;
    }



}
