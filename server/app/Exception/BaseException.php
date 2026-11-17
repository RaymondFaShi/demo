<?php

namespace App\Exceptions;

use Exception;

/**
 * 基础异常处理类
 */
abstract class BaseException extends Exception {
    /**
     * 用户错误码
     */
    protected readonly string $userCode;

    /**
     * 初始化异常
     * @param string $message 错误信息
     * @param string $code 错误码
     */
    public function __construct( string $message, string $code ) {
        // 用户错误码
        $this->userCode = $code;
        
        // 父类初始化
        parent::__construct( $message, 256 );
    }

    /**
     * 获取用户错误码
     */
    final public function getUserCode(): string {
        return $this->userCode;
    }
}
