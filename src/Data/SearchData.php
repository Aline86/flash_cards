<?php
namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';
    /**
     * @var Theme[]
     */
    public $theme=[];
    /**
     * @var null/integer
     */
    public $max;
    /**
     * @var null/integer
     */
    public $min;
    /**
     * @var boolean
     */
    public $t = FALSE;

}