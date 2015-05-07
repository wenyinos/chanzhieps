<?php
/**
 * The model file of address module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     address
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class addressModel extends model
{
    /**
     * create an address. 
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $product = new stdclass();
        $address = fixer::input('post')->add('account', $this->app->user->account)->get();
        $this->dao->insert(TABLE_ADDRESS)
            ->data($address)
            ->batchCheck($this->config->address->require->create, 'notempty')
            ->exec();
        return !dao::isError();
    }

    /**
     * update an address. 
     * 
     * @param  int    $id 
     * @access public
     * @return void
     */
    public function update($id)
    {
        $product = new stdclass();
        $address = fixer::input('post')->add('account', $this->app->user->account)->get();
        $this->dao->update(TABLE_ADDRESS)
            ->data($address)
            ->where('id')->eq($id)
            ->batchCheck($this->config->address->require->edit, 'notempty')
            ->exec();

        return !dao::isError();
    }

    /**
     * Get address list in address of an account.
     * 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function getListByAccount($account = '')
    {
        return $this->dao->select('*')->from(TABLE_ADDRESS)->where('account')->eq($account)->fetchAll();
    }
}
