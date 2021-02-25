<?php

use Illuminate\Support\Facades\Route;

/**
 * 后台
 */
Route::group(["namespace" => "Admin", "prefix" => "admin"], function () {
    Route::get("index", "UserController@index"); //测试
    Route::post("login", "UserController@login"); //登陆
    Route::post("logout", "UserController@logout")->middleware("check.jwt");//退出登陆
    Route::post("refreshToken", "UserController@refreshToken")->middleware("check.jwt");  //token刷新
});


Route::group(["middleware" => "check.jwt"], function () {
    /**
     * PC端
     */
    Route::group(["namespace" => "Front"], function () {
        /**
         * PC用户
         */
        Route::post("user/get", "UserController@get");
        Route::post("user/edit", "UserController@edit");
        Route::post("user/delete", "UserController@delete");
        Route::post("user/add", "UserController@add");
        Route::post("user/release", "UserController@release");
        Route::post("user/getRelease", "UserController@getRelease");
        Route::post("user/search", "UserController@search");

        /**
         * 文章
         */
        Route::post("article/get", "ArticleController@get");
        Route::post("article/edit", "ArticleController@edit");
        Route::post("article/delete", "ArticleController@delete");
        Route::post("article/add", "ArticleController@add");
        Route::post("article/release", "ArticleController@release");
        Route::post("article/getRelease", "ArticleController@getRelease");
        Route::post("article/search", "ArticleController@search");
        /**
         * 统计
         */
        Route::post("total/get", "TotalController@get");
        Route::post("total/totalNum", "TotalController@totalNum");//数据统计
        Route::post("total/delete", "TotalController@delete");//删除
//    Route::get("total/index", "TotalController@index");
        /**
         * 文章类别
         */
        Route::post("type/get", "TypeArticleController@get");
        Route::post("type/edit", "TypeArticleController@edit");
        Route::post("type/delete", "TypeArticleController@delete");
        Route::post("type/add", "TypeArticleController@add");
        Route::post("type/release", "TypeArticleController@release");
        Route::post("type/getRelease", "TypeArticleController@getRelease");
        /**
         * 日志类别
         */
        Route::post("typeLog/get", "TypeLogController@get");
        Route::post("typeLog/edit", "TypeLogController@edit");
        Route::post("typeLog/delete", "TypeLogController@delete");
        Route::post("typeLog/add", "TypeLogController@add");
        Route::post("typeLog/release", "TypeLogController@release");
        Route::post("typeLog/getRelease", "TypeLogController@getRelease");
        /**
         * 日志
         */
        Route::post("log/get", "LogController@get");
        Route::post("log/edit", "LogController@edit");
        Route::post("log/delete", "LogController@delete");
        Route::post("log/add", "LogController@add");
        Route::post("log/release", "LogController@release");
        Route::post("log/getRelease", "LogController@getRelease");
        /**
         * 链接
         */
        Route::post("link/get", "LinkController@get");
        Route::post("link/edit", "LinkController@edit");
        Route::post("link/delete", "LinkController@delete");
        Route::post("link/add", "LinkController@add");
        Route::post("link/release", "LinkController@release");
        Route::post("link/getRelease", "LinkController@getRelease");
        /**
         * 基本信息
         */
        Route::post("info/get", "InfoController@get");
        Route::post("info/edit", "InfoController@edit");
        Route::post("info/delete", "InfoController@delete");
        Route::post("info/add", "InfoController@add");
        Route::post("info/release", "InfoController@release");
        Route::post("info/getRelease", "InfoController@getRelease");
        /**
         * 留言
         */
        Route::post("msg/get", "MessageController@get");
        Route::post("msg/edit", "MessageController@edit");
        Route::post("msg/delete", "MessageController@delete");
        Route::post("msg/release", "MessageController@release");
        /**
         * 子留言
         */
        Route::post("msgSub/get", "MessageSubController@get");
        Route::post("msgSub/edit", "MessageSubController@edit");
        Route::post("msgSub/delete", "MessageSubController@delete");
        Route::post("msgSub/add", "MessageSubController@add");
        Route::post("msgSub/release", "MessageSubController@release");
        Route::post("msgSub/getRelease", "MessageSubController@getRelease");

        /**
         * 评论
         */
        Route::post("comment/get", "CommentController@get");
        Route::post("comment/edit", "CommentController@edit");
        Route::post("comment/delete", "CommentController@delete");
        Route::post("comment/release", "CommentController@release");
        /**
         * 子评论
         */
        Route::post("commentSub/get", "CommentSubController@get");
        Route::post("commentSub/edit", "CommentSubController@edit");
        Route::post("commentSub/delete", "CommentSubController@delete");
        Route::post("commentSub/add", "CommentSubController@add");
        Route::post("commentSub/release", "CommentSubController@release");
        Route::post("commentSub/getRelease", "CommentSubController@getRelease");


    });
    /**
     * WeChat端
     */
    Route::group(["namespace" => "WeChat", "prefix" => "wechat"], function () {
        Route::post("user/get", "UserController@get");
        Route::post("user/delete", "UserController@delete");
    });
});

