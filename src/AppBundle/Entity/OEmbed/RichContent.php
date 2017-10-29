<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 29.10.17
 * Time: 16:37
 */

namespace AppBundle\Entity\OEmbed;


class RichContent extends BaseOembed {


    private $html;
    private $width;
    private $height;

    /**
     * RichContent constructor.
     *
     * @param $html
     * @param $width
     * @param $height
     */
    public function __construct( $html, $width, $height ) {
        parent::__construct("rich");
        $this->html   = $html;
        $this->width  = $width;
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getHtml() {
        return $this->html;
    }

    /**
     * @param mixed $html
     *
     * @return RichContent
     */
    public function setHtml( $html ) {
        $this->html = $html;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param mixed $width
     *
     * @return RichContent
     */
    public function setWidth( $width ) {
        $this->width = $width;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param mixed $height
     *
     * @return RichContent
     */
    public function setHeight( $height ) {
        $this->height = $height;

        return $this;
    }


}
