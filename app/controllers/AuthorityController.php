<?php

class AuthorityController extends Controller
{
    /**
     * @return Response
     */
    public function getSignin()
    {
        return View::make('login.login');
    }
    
    /**
     * @return Response
     */
    public function postSignin()
    {
        // 凭证
        $credentials = array('name'=>Input::get('user'), 'password'=>Input::get('password'));
        // 验证登录
        if (Auth::attempt($credentials)) {
            // 登录成功
            //return View::make('message.users');
            return View::make('message.users');
        } else {
            // 登录失败，跳回
            return Redirect::back()
                ->withInput()
                ->withErrors(array('attempt' => '用户名或密码错误，请重新登录。'));
        }
    }

    /**
     * 动作：退出
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
    
    /**
     * 页面：注册
     * @return Response
     */
    public function getSignup()
    {
        return View::make('login.signup');
    }
    
    /**
     * 动作：注册
     * @return Response
     */
    public function postSignup()
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'name'    => 'required|unique:users',
            'password' => 'required|alpha_dash|between:6,16|confirmed',
        );
        // 自定义验证消息
        $attempt = array(
            'name.unique'        => '此用户名已被使用。',
            'name.required'        => '请输入用户名。',
            'password.required'   => '请输入密码。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。'
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $attempt);
        if ($validator->passes()) {
            // 验证成功,添加
            $user = new User;
            $user->name    = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            if ($user->save()) {
                return Redirect::back()
                ->withErrors(array('attempt' => '注册成功！'));
            } else {
                return Redirect::back()
                ->withErrors(array('attempt' => '注册失败！'));
            }
        } else {
            // 验证失败，跳回
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }
    
 
}
