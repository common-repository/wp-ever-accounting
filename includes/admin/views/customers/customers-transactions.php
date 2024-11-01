<?php
/**
 * Page: Sales
 * Tab: Customers
 * Section: Transactions
 *
 * @package EverAccounting
 */

defined( 'ABSPATH' ) || exit();

require_once EACCOUNTING_ABSPATH . '/includes/admin/list-tables/class-revenue-list-table.php';
$args       = array(
	'display_args' => array(
		'columns_to_hide'      => array( 'actions', 'cb', 'contact_id' ),
		'hide_extra_table_nav' => true,
		'hide_bulk_options'    => true,
	),
);
$list_table = new EverAccounting_Revenue_List_Table( $args );
$list_table->prepare_items();
$list_table->views();
$list_table->display();
