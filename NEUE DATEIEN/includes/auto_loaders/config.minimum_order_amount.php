<?php
/**
 * @copyright Copyright 2005-2007 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: config.minimum_order_amount.php 2022-02-28 17:49:54Z webchills $
 */ 
 
$autoLoadConfig[190][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.minimum_order_amount.php');
$autoLoadConfig[190][] = array('autoType'=>'classInstantiate',
                              'className'=>'minimum_order_amount',
                              'objectName'=>'minimum_order_amount');