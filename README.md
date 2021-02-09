# 个人博客1.x版本安装部署说明

## 前台(front)

**静态页面:** Vue2.9.6+Vuex+ElementUI+SCSS+WebSocket

**相关配置:** 修改main.js和api.js文件里面的接口地址

**效果预览:**[前台效果预览](https://www.lpyhutu.cn/)

## 后台(admin)

**静态页面:** Vue2.9.6+Vuex+ElementUI+SCSS+WebSocket

**相关配置:** 修改main.js和api.js文件里面的接口地址

**效果预览:**[后台效果预览](https://adm.lpyhutu.cn/)

## 小程序(WeChat)

**静态页面:** WXML+WXSS+JavaScript+WeUI

**相关配置:** 修改api.js文件里面的接口地址

**效果预览:** ![小程序](https://www.lpyhutu.cn/img/WeChat.0f48788d.jpg)

## Socket服务(wss)

在该目录下使用`php artisan workman start --d`命令启动服务

## API(api)

修改.env里面数据库的账号和密码



