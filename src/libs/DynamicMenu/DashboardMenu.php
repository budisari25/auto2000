<?php

namespace Racik\DynamicMenu;

class DashboardMenu
{
    protected $podb;
    /**
     * Constructor. Initialize database connection
    */
    public function __construct()
    {
        $this->pdo = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASS);
        $this->podb = new \FluentPDO($this->pdo);
    }

    /**
     * Get menu from database, and generate html nested list
     *
     * @param int $group_id
     * @param string $attr, $attrs, $attrss
     * @return string
    */
    public function menu($group_id, $attr = '', $attrs = '', $attrss = '')
    {
        $tree = new Tree;
        $menu = $this->podb->from('menu')
            ->where('group_id', $group_id)
            ->where('active', 'Y')
            ->orderBy(array('parent_id ASC', 'position ASC'))
            ->fetchAll();
        foreach ($menu as $row) {
            if ($row['parent_id'] == 0) {
                $label = '<a href="' .BASE_URL. $row['url'] . '">';
            } else {
                $label = '<a href="' .BASE_URL. $row['url'] . '">';
            }
            if ($row['class'] != '') {
                $label .= '<i class="fa '.$row['class'].' fa-fw"></i> <span>'.($row['title']).'</span>';
            } else {
                $label .= '<span>'.($row['title']).'</span>';
            }
            $label .= '</a>';
            $li_attr = '';
            $tree->add_row($row['id'], $row['parent_id'], $li_attr, $label);
        }
        $menu = $tree->generate_list($attr, $attrs, $attrss);
        return $menu;
    }

}