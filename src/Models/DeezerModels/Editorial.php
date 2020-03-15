<?php

/**
 * PHP library for using Deezzer API
 *
 * (c) Arnaud Costes <arnaud.costes@gmail.com>
 *
 * MIT License
 */

namespace app\Models\DeezerModels;

/**
 * Editorial class for Deezer API
 *
 * @author Arnaud COSTES <arnaud.costes@gmail.com>
 */
class Editorial extends Base
{

    /**
     * The editorial's name
     *
     * @var string
     */
    public $name;

    /**
     * Editorial connections type
     *
     * @var array
     */
    protected $connectionsType = array(
        'selection',
        'charts',
    );
}
