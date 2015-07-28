<?php
    class classAjax{
        private $action = '';
        public function __construct($action){
            header("Content-type: text/html; charset=utf-8");
            $this->action = $action;
        }
        public function getAction(){ return $this->action; }
        public function usersChangeAccess($arr){
            global $Db;
            extract($arr, EXTR_OVERWRITE);
            $sql    = $Db->query("SELECT `access` FROM `mod_users_items` WHERE `id` = '$id'");
            $row    = $sql->fetch();
            $access = $row['access'] == 1 ? 0 : 1;
            $Db->query("UPDATE `mod_users_items` SET `access` = '$access' WHERE `id` = '$id'");
            return $access;
        }
        public function usersDelItem($arr){
            global $Db;
            extract($arr, EXTR_OVERWRITE);
            $Db->query("DELETE FROM `mod_users_items` WHERE `id` = '$id'");
            return true;
        }
        public function __destruct(){}
    }





    $ROOT_DIR = $_SERVER['SCRIPT_FILENAME'];
    $ROOT_DIR = substr($ROOT_DIR, 0, strlen($ROOT_DIR)-9).'/../../';
    if (!include_once "{$ROOT_DIR}kernel/wwcms.php") exit('Не могу подключить ядро "/kernel/wwcms.php"');
    $WWcms   = new classWWcms();
    $Db      = $WWcms->initClass('Db');
    $Session = $WWcms->initClass('Session');
    $Request = $WWcms->initClass('Request');
    $act     = $Request->get('action');
    $Ajax    = new classAjax($act);
    $result  = $Ajax->$act($Request->get());
    if ($result !== true) echo $result;
    $Db = NULL;
?>