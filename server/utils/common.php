<?php
/**
 * 公共函数
 */
declare( strict_types = 1 );

use function Hyperf\Support\env;

/**
 * 打印日志(开发模式下)
 * @param mixed $contents 日志数据
 */
function devLog( mixed ...$contents ): void {
    // 开发模式下
    if( env( 'APP_ENV' ) !== 'dev' ) return ;

    // 打印内容
    foreach( $contents as $content ) {
        var_dump( $content );
    }
}

/**
 * object转成array
 * @param object $obj object
 */
function objectToArray( object $obj ): array {
    return json_decode(
        json_encode( $obj, JSON_UNESCAPED_UNICODE ),
        true
    );
}

/**
 * array转object
 */
function arrayToObject( array $arr ): object {
    return json_decode( json_encode( $arr, JSON_UNESCAPED_UNICODE ) );
}

/**
 * 数组指定位置插入数组
 * @param array $originArr 原始数组
 * @param string $afterKeyName 在之后插入的键名
 * @param array $insertArr 需要插入的数组
 */
function arrayInsertAfter( array $originArr, string $afterKeyName, array $insertArr ): array {
    // 返回数据
    $result = [];

    foreach( $originArr as $originKey => $originValue ) {
        $result[ $originKey ] = $originValue;
        
        if( $originKey === $afterKeyName ) {
            foreach( $insertArr as $insertKey => $insertValue ) {
                $result[ $insertKey ] = $insertValue;
            }
        }
    }

    return $result;
}

/**
 * 构建树结构
 * @param array $items 明细列表
 * @param int $parentId 开始的父id
 * @param string $primaryKey 主键
 * @param string $foreginKey 外键
 * @param string $childrenKey 子节点字段
 * @param array $fields 提取字段 
 * @param object $callback 回调操作
 */
function buildTreeStruct( array $items, int $parentId = 0, string $primaryKey = 'id', string $foreginKey = 'parentId', string $childrenKey = 'children', ?array $fields = null, ?object $callback = null ): array {
    // 初始化返回数据
    $result = [];
    
    // 递归处理数据
    foreach( $items as $item ) {
        // 初始化数据
        $data = [];
        
        // 如果主键和父id一致
        if( $item[ $foreginKey ] === $parentId ) {
            
            // 如果要指定输出字段
            if( $fields !== null ) {
                $data = array_filter( $item, static fn ( $key ) => in_array( $key, $fields, true ), ARRAY_FILTER_USE_KEY );
            }

            // 否则全部赋值输出
            else {
                $data = $item;
            }

            // 构建子结构数据
            $data[ $childrenKey ] = buildTreeStruct( $items, $item[ $primaryKey ], $primaryKey, $foreginKey, $childrenKey, $fields, $callback );
            
            $result[] = $data;
        }
    }

    return $result;
}