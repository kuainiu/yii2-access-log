<?php
use yii\db\Migration;

class create_access_log extends Migration
{
    public function safeUp()
    {
        $sql = <<<EOF
CREATE TABLE `access_log` (
    `access_log_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
    `access_log_request_url` VARCHAR(255) NOT NULL COMMENT '请求地址',
    `access_log_request_method` VARCHAR(45) NOT NULL COMMENT '请求方法',
    `access_log_request_params` MEDIUMTEXT NULL COMMENT '请求参数',
    `access_log_server_ip` VARCHAR(45) NOT NULL COMMENT '服务器IP',
    `access_log_client_ip` VARCHAR(45) NOT NULL COMMENT '客户端IP',
    `access_log_user_id` INT NOT NULL COMMENT '用户ID',
    `access_log_user_name` VARCHAR(255) NOT NULL COMMENT '用户名',
    `access_log_access_at` DATETIME NOT NULL COMMENT '访问时间',
    `access_log_create_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `access_log_update_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    PRIMARY KEY (`access_log_id`),
    INDEX `idx_request_url_method` (`access_log_request_url` ASC , `access_log_request_method` ASC),
    INDEX `idx_access_at` (`access_log_access_at` ASC)
)  ENGINE=INNODB DEFAULT CHARACTER SET=UTF8 COMMENT='访问日志';
EOF;
        $this->execute($sql);
    }
    public function safeDown()
    {
        echo "create_access_log cannot be reverted!\n";
        return false;
    }
}