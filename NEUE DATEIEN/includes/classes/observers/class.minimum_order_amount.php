<?php
/**
 * @copyright Copyright 2005-2007 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: class.minimum_order_amount.php 2022-02-28 17:49:54Z webchills $
 */ 

/**
 * Observer class used to check minimum order amount
 *
 */
class minimum_order_amount extends base {
  /**
   * constructor method
   *
   * Attaches our class to the ... and watches for 4 notifier events.
   */
  public function __construct() {
    global $zco_notifier;
    $zco_notifier->attach($this, array('NOTIFY_HEADER_END_SHOPPING_CART', 'NOTIFY_HEADER_START_CHECKOUT_SHIPPING', 'NOTIFY_HEADER_START_CHECKOUT_PAYMENT', 'NOTIFY_HEADER_START_CHECKOUT_CONFIRMATION'));
  }
  /**
   * Update Method
   *
   * Called by observed class when any of our notifiable events occur
   *
   * @param object $class
   * @param string $eventID
   */
  public function update(&$class, $eventID) {
    global $messageStack;
    global $currencies;
	  global $db;
    switch ($eventID) {
      case 'NOTIFIER_CART_GET_PRODUCTS_END':
      case 'NOTIFY_HEADER_END_SHOPPING_CART':
      if (zen_is_logged_in()){
	    $prevOrders = $db->Execute('SELECT count(orders_id) total_orders FROM ' .TABLE_ORDERS. ' WHERE customers_id = ' .(int)$_SESSION['customer_id']);
			if ((int)$prevOrders->fields['total_orders'] == 0) {
				if ($_SESSION['cart']->count_contents() > 0 && MIN_FIRST_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_FIRST_ORDER_AMOUNT) {
                  $_SESSION['valid_to_checkout'] = false;
                  $messageStack->add('shopping_cart', sprintf(TEXT_FIRST_ORDER_UNDER_MIN_AMOUNT, $currencies->format(MIN_FIRST_ORDER_AMOUNT)) . '<br />', 'caution');
                }
			} else {
				if ($_SESSION['cart']->count_contents() > 0 && MIN_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_ORDER_AMOUNT) {
                  $_SESSION['valid_to_checkout'] = false;
                  $messageStack->add('shopping_cart', sprintf(TEXT_ORDER_UNDER_MIN_AMOUNT, $currencies->format(MIN_ORDER_AMOUNT)) . '<br />', 'caution');
                }
			}
		} else {
			if ($_SESSION['cart']->count_contents() > 0 && MIN_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_ORDER_AMOUNT) {
              $_SESSION['valid_to_checkout'] = false;
              $messageStack->add('shopping_cart', sprintf(TEXT_ORDER_UNDER_MIN_AMOUNT, $currencies->format(MIN_ORDER_AMOUNT)) . '<br />', 'caution');
            }
		}
        break;
      case 'NOTIFY_HEADER_START_CHECKOUT_SHIPPING':
      case 'NOTIFY_HEADER_START_CHECKOUT_PAYMENT':
      case 'NOTIFY_HEADER_START_CHECKOUT_CONFIRMATION':
	    if (zen_is_logged_in()){
			$prevOrders = $db->Execute('SELECT count(orders_id) total_orders FROM ' .TABLE_ORDERS. ' WHERE customers_id = ' .(int)$_SESSION['customer_id']);
			if ((int)$prevOrders->fields['total_orders'] == 0) {
				if ($_SESSION['cart']->count_contents() > 0 && MIN_FIRST_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_FIRST_ORDER_AMOUNT) {
                  zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
                }
			} else {
				if ($_SESSION['cart']->count_contents() > 0 && MIN_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_ORDER_AMOUNT) {
                  zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
                }
			}
		} else {
			if ($_SESSION['cart']->count_contents() > 0 && MIN_ORDER_AMOUNT > 0 && $_SESSION['cart']->show_total() < MIN_ORDER_AMOUNT) {
              zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
            }
		}
        break;
        default:
        break;
    }
  }
}