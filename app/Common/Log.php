<?php
namespace App\Common;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class Log
{
    //define static log instance.
    protected static $_log_instance;
    /**
     * 获取log实例
     *
     * @return obj
     * @author Sphenginx
     **/
    public static function getLogInstance()
    {
        if (static::$_log_instance === null) {
            static::$_log_instance = new Logger('NOTICE');
        }
        return static::$_log_instance;
    }
    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string  $method 可用方法: debug|info|notice|warning|error|critical|alert|emergency 可调用的方法详见 Monolog\Logger 类
     * @param  array   $args 调用参数
     * @return mixed
     * @author Sphenginx
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getLogInstance();
        //组织参数信息
        $message = $args[0];
        //记录上下文日志
        $context = isset($args[1]) ? $args[1] : [];
        //定义记录日志文件
        $path    = isset($args[2]) ? $args[2] : '/notice/';
        //设置日志处理手柄，默认为写入文件（还有mail、console、db、redis等方式，详见Monolog\handler 目录）
        $handler = new StreamHandler(storage_path($path) . date('Y-m-d').'.log', Logger::toMonologLevel($method), $bubble = true, $filePermission = 0777);
        //设置输出格式LineFormatter(Monolog\Formatter\LineFormatter)， ignore context and extra
        $handler->setFormatter(new LineFormatter(null, null, true, true));
        $instance->setHandlers([$handler]);
        $instance->$method($message, $context);
    }
}