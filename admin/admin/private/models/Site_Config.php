<?php

class Site_Config extends Util{
    public $id;
    public $image_name;
    public $title;
    public $tag_line;
    public $firebase_auth;
    public $admin_id;

    public function ret_site_config($adminId) {

        $site_config_frm_db = $this->where(["admin_id" => $adminId])->one();

        if(!empty($site_config_frm_db)) {
            return $site_config_frm_db;
        }
        
        return null;
    }
}