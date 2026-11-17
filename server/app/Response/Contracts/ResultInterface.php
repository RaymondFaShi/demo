<?php
declare( strict_types = 1 );
namespace App\Response\Contracts;

/**
 * 响应数据结构
 */
interface ResultInterface {
    /**
     * 成功
     */
    public function ok(): static;

    /**
     * 失败
     */
    public function fail(): static;
}