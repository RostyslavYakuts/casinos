<?php
/**
 * @var $args;
 * Template part: Terms Items
 */
$id = $args['id'];

echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Software','software');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Deposits','deposits');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Withdrawal','withdrawal');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Language','language');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Licence','licence');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Currencies','currencies');
echo \Classes\Casino\Helper::generate_row_table_casino_data($id,'Crypto','crypto');