## Laravel 的中间件处理
1、`\Illuminate\Foundation\Http\Kernel.php`文件   
```php
protected function sendRequestThroughRouter($request)
{
    $this->app->instance('request', $request);

    Facade::clearResolvedInstance('request');

    $this->bootstrap();

    //larave的中间件由Pipeline处理
    return (new Pipeline($this->app))
                ->send($request)
                ->through($this->app->shouldSkipMiddleware() ? [] : $this->middleware)
                ->then($this->dispatchToRouter());
}
```
2、`\Illuminate\Pipeline\Pipeline.php`文件   
```php
//重点关注这个then方法
public function then(Closure $destination)
{
    /**
     * $this->pipes 即中间件数组
     * 先反转数组, 则最后的中间件先包装, 最终最外层的闭包就是第一个中间件
     * $this->prepareDestination($destination) 即 array_reduce 的初始参数, 第一个包装则最后执行
     */
    $pipeline = array_reduce(
        array_reverse($this->pipes), $this->carry(), $this->prepareDestination($destination)
    );

    //嵌套闭包从最外层开始执行
    return $pipeline($this->passable);
}

//获取嵌套闭包的最里层闭包(最后执行, 用于进入路由编译和匹配)
protected function prepareDestination(Closure $destination)
{
    return function ($passable) use ($destination) {
        return $destination($passable);
    };
}

//使用闭包包装中间件
protected function carry()
{
    //$stack 里层闭包
    //$pipe 中间件
    return function ($stack, $pipe) {
        //$passable 请求实例 request
        return function ($passable) use ($stack, $pipe) {
            if (is_callable($pipe)) {
                // If the pipe is an instance of a Closure, we will just call it directly but
                // otherwise we'll resolve the pipes out of the container and call it with
                // the appropriate method and arguments, returning the results back out.
                return $pipe($passable, $stack);
            } elseif (! is_object($pipe)) {
                list($name, $parameters) = $this->parsePipeString($pipe);

                // If the pipe is a string we will parse the string and resolve the class out
                // of the dependency injection container. We can then build a callable and
                // execute the pipe function giving in the parameters that are required.
                $pipe = $this->getContainer()->make($name);

                $parameters = array_merge([$passable, $stack], $parameters);
            } else {
                // If the pipe is already an object we'll just make a callable and pass it to
                // the pipe as-is. There is no need to do any extra parsing and formatting
                // since the object we're given was already a fully instantiated object.
                $parameters = [$passable, $stack];
            }

            return method_exists($pipe, $this->method)
                            ? $pipe->{$this->method}(...$parameters)
                            : $pipe(...$parameters);
        };
    };
}
```
