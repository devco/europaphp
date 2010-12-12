<?php

/**
 * A view class for rendering JSON data from bound parameters.
 * 
 * @category Views
 * @package  Europa
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2010 Trey Shugart http://europaphp.org/license
 */
class Europa_View_Json extends Europa_View
{
    /**
     * Constructs the view and sets parameters.
     * 
     * @param mixed $params The parameters to set.
     * 
     * @return Europa_View_Jsons
     */
    public function __construct($params = null)
    {
        $this->setParams($params);
    }
    
    /**
     * JSON encodes the parameters on the view and returns them.
     * 
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->getParams());
    }
}