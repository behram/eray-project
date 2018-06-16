<?php

namespace Notify\Common\Helper;

use APY\DataGridBundle\Grid\Action\RowAction;

/**
 * Class ActionHelper.
 */
class ActionHelper
{
    /**
     * @param $route
     * @param $key
     * @param null $role
     *
     * @return RowAction
     */
    public static function deleteAction($route, $key, $role = null)
    {
        $rowAction = new RowAction('<i class="fa fa-trash-o"></i>', $route);
        $rowAction->setAttributes(['class' => 'btn btn-danger btn-xs ', 'data-toggle' => 'tooltip', 'title' => 'Delete']);
        $rowAction->setRouteParameters($key);
        $rowAction->setConfirm(true);
        $rowAction->setConfirmMessage('Do you want delete this row?');
        if ($role) {
            $rowAction->setRole($role);
        }

        return $rowAction;
    }

    /**
     * @param $route
     * @param $key
     * @param null $role
     *
     * @return RowAction
     */
    public static function showAction($route, $key, $role = null)
    {
        $rowAction = new RowAction('<i class="fa fa-info-circle"></i>', $route);
        $rowAction->setAttributes(['class' => 'btn btn-success btn-xs  ', 'data-toggle' => 'tooltip', 'title' => 'Show']);
        $rowAction->setRouteParameters($key);
        if ($role) {
            $rowAction->setRole($role);
        }

        return $rowAction;
    }

    /**
     * @param $route
     * @param $key
     * @param null $role
     *
     * @return RowAction
     */
    public static function editAction($route, $key, $role = null)
    {
        $rowAction = new RowAction('<i class="fa fa-pencil"></i>', $route);
        $rowAction->setAttributes(['class' => 'btn btn-warning btn-xs  ', 'data-toggle' => 'tooltip', 'title' => 'Edit']);
        $rowAction->setRouteParameters($key);
        if ($role) {
            $rowAction->setRole($role);
        }

        return $rowAction;
    }
}
