### 1、添加路由
载入路由定义文件, 逐条解析转化成Route实例, Route实例包含该条路由的uri, middleware, domain, prefix等等属性,   
然后将Route实例添加到RouteCollection中, 即RouteCollection的routes属性数组包含所有路由Route实例   

### 2、公共中间件处理
`app\Http\Kernel.php`中定义了所有http请求都必须经过的中间件数组middleware,   
先将中间件数组倒序, 然后逐层使用闭包包装中间件得到一个大的闭包, 然后把request传入这个大的闭包层层处理   

### 3、在RouteCollection中为request实例寻找正确的Route
遍历RouteCollection, 把每个Route实例的uri进行正则编译得到正则表达式   
然后使用四个验证器进行校验, 示例Url如 {Method} {Scheme}://{Host}/{Uri}:   
>MethodValidator 检查request的请求方法是否匹配   
>SchemeValidator 检查request的请求协议http或https是否匹配   
>HostValidator 检查request的域名是否匹配, 如果Route并没有限定域名, 则此验证器不执行   
>UriValidator 检查request的uri是否匹配当前Route的正则表达式   

一旦四个验证器都通过则说明Route匹配, 可以将request交给该Route处理. 然后使用Route的正则表达式取request的uri中的参数保存到Route的parameters属性数组中   

### 4、独有中间件处理
找到正确的Route实例后, 开始收集该Route经过的中间件, 包括middlewareGroups和routeMiddleware中定义的, 然后对这些中间件进行排序, 最后执行这些中间件对request进行处理   

### 5、数据库模型转化
独有中间件执行时, 如果在路由闭包或控制器方法中如果定义了数据库模型类型的参数, 此时需要使用SubstituteBindings中间件将路由参数转成数据库模型对象, 参数的值作为模型的主键进行查询   

### 6、执行控制器方法
反射获取方法的参数, 如果参数是一个类实例, 先检查是否在Route的parameters数组中, 如果不存在则从容器中解析, 然后插入到parameters数组中. 解析完方法参数后, 调用callAction方法执行控制器方法或执行闭包   
