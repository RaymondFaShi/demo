<?php
/**
 * 助手函数
 */
declare( strict_types = 1 );

use App\Service\Customer\SettingsService;

/**
 * 备注格式化
 * @param array $comment
 */
function commentFormat( array $comment ): string {
    // 初始化返回字符串
    $result = '';

    foreach( $comment as $key => $value ) {
        $result .= $key. '-'. $value. ' ';
    }

    return $result;
}

/**
 * 获取站点配置
 * @param string $name 配置名
 * @param mixed $default 默认值
 */
function siteConfig( $name, mixed $default = null ) {
    return app( SettingsService::class )->find( $name, $default );
}

/**
 * 格式化金额，加逗号
 */
function formatAmount( int|float|string $amount, int $decimals = 0 ): string {
    return number_format( ( float ) $amount, $decimals, '.', ',' );
}