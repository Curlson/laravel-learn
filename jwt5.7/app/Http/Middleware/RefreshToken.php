<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

// 注意, 我们要继承的是 jwt 的 BaseMiddleware
class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     * @throws JWTException
     */
    public function handle($request, Closure $next)
    {
        // 第一步. 登录性检查:
        // 检查此次请求中是否带有 token, 如果没有则抛出异常.
        $this->checkForToken($request);

        // 使用 try 包裹, 以捕捉 toke 过期所跑出的 TokenExpiredException 异常
        try {
            // 第二步. 检测登录状态:
            // 2.1 通过  检测用户的登录状态, 如果正常则通过
            if ( $this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            // 2.2 token 过期, 超过 ttl .
            throw new UnauthorizedHttpException('jwt-auth', '未登录: 已过期');
        } catch (TokenExpiredException $exception) {
            // 此处捕获到了 token 过期所跑出的 TokenExpiredException 异常,我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()
                    ->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            } catch (JWTException $exception) {
                // 2.4 refresh_ttl 过期了
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
            }
        }

        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
    }

}