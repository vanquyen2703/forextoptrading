<?php

class ZwpDashboard
{
    private $pageinfo;
    private $pages;
    private $content;

    public function __construct()
    {
        if (basename($_SERVER["SCRIPT_NAME"]) == basename(__FILE__)) {
            exit;
        }

        $this->pageinfo = array(
            'page' => 'zwp-cpanel',
            'title' => 'WordPress Hosting'
        );

        $this->pages = array(
            array('page' => 'zwp-cpanel', 'title' => 'WordPress Hosting'),
        );

        add_action('admin_menu', array(&$this, 'add_menu'));

        add_action('admin_enqueue_scripts', array(&$this, 'add_admin_style'));

        add_action('admin_menu', array(&$this, 'add_separator'));

        add_filter('custom_menu_order', array(&$this, 'custom_menu_order'));
        add_filter('menu_order', array(&$this, 'custom_menu_order'));
    }

    public function add_menu()
    {
        $page = add_menu_page($this->pageinfo['title'], $this->pageinfo['title'], 'administrator',
            $this->pageinfo['page'], array(&$this, 'read_page_content'), ' ');
        $this->create_submenu_page();
    }

    public function add_admin_style()
    {
        wp_enqueue_style('zwp_admin_menu', ZWP_PLUGIN_URL . '/css/common/admin-menu.css', array(), ZWP_PLUGIN_VERSION);
    }

    private function create_submenu_page()
    {
        foreach ($this->pages as $line) {
            $page = add_submenu_page($this->pageinfo['page'], $line['title'], $line['title'], 'administrator',
                $line['page'], array(&$this, 'read_page_content'));
        }
    }

    public function add_style()
    {
        wp_enqueue_style('zwp_common_style', ZWP_PLUGIN_URL . '/css/common/common.css', array(), ZWP_PLUGIN_VERSION);
    }

    public function read_page_content()
    {
        global $plugin_page;
        require_once plugin_dir_path(__FILE__) . 'pages/' . $plugin_page . '.php';
    }

    public function add_separator()
    {
        global $menu;
        $menu[] = array('', 'read', 'separator-gmo', '', 'wp-menu-separator');
    }

    public function custom_menu_order($menu)
    {
        if (!$menu) {
            return true;
        }

        $menu = $this->menu_move_first('separator-gmo', $menu);
        $menu = $this->menu_move_first($this->pageinfo['page'], $menu);

        return $menu;
    }

    private function menu_move_first($name, $menu)
    {
        $num = array_search($name, $menu);
        array_splice($menu, $num, 1);
        array_unshift($menu, $name);

        return $menu;
    }
}
