<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 15:16
 */

namespace Certifications\Model;


class Certification
{
    private $id;
    private $text;
    private $title;

    public function __construct($title, $text, $id = null)
    {
        $this->title = $title;
        $this->text = $text;
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}