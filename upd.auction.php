<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package     ExpressionEngine
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2003 - 2019, EllisLab, Inc.
 * @license     http://expressionengine.com/user_guide/license.html
 * @link        http://expressionengine.com
 * @since       Version 2.0
 * @filesource
 */

/**
 * Auction Module Install/Update File
 *
 * @package    ExpressionEngine
 * @subpackage Addons
 * @category   Module
 * @author     EE Recipes
 * @link       
 */
class Auction_upd
{
    public $version = '1.0.0';

    /**
     * Installation Method
     *
     * @return  boolean
     */
    public function install()
    {
        ee()->db->insert('modules', array(
            'module_name'        => 'Auction',
            'module_version'     => $this->version,
            'has_cp_backend'     => 'y',
            'has_publish_fields' => 'n',
        ));

        ee()->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT', 
                'unsigned' => TRUE, 
                'auto_increment' => TRUE
            ),
            'site_id' => array(
                'type' => 'INT', 
                'unsigned' => TRUE, 
                'default' => 0
            ),
            'entry_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'member_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE
            ),
            'bid_amount' => array(
                'type' => 'DECIMAL',
                'constraint' => '7,2',
                'default' => '0.00',
                'null' => FALSE
            ),
            'bid_date' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => '0',
                'null' => FALSE
            ),
        );

        ee()->dbforge->add_field($fields);
        ee()->dbforge->add_key('id', TRUE);
        ee()->dbforge->add_key('site_id');
        ee()->dbforge->create_table('auction', TRUE);

        return TRUE;
    }

    /**
     * Uninstall
     *
     * @return  boolean
     */
    public function uninstall()
    {
        ee()->db->where('class', 'Auction')->delete('actions');

        $mod_id = ee()->db->select('module_id')->get_where('modules', array('module_name' => 'Auction'))->row('module_id');
        ee()->db->where('module_id', $mod_id)->delete('module_member_groups');
        ee()->db->where('module_name', 'Auction')->delete('modules');

        ee()->load->dbforge();
        ee()->dbforge->drop_table('auction');

        return TRUE;
    }

    /**
     * Module Updater
     *
     * @return  boolean
     */
    public function update($current = '')
    {
        return TRUE;
    }
}

/* End of file upd.auction.php */