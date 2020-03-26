<?php
    
    //文件上传方法
    function Upload($img){
        //判断过程中是否有错误
        if(request()->file($img)->isValid()){
            //文件上传
            $file = request()->file($img);
            //将图片保存到文件里
            $store_result = $file->store("uploads");
            //将最后的文件信息返回
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    //多文件上传
    function uploads($img){
        //接收多图片信息
        $file = request()->$img;
        //将图片信息循环
        foreach($file as $k=>$v){
            //判断循环后的每个文件过程中是否有错
            if($v->isValid()){
                //将每张图片信息循环得存进新位置
                $store_result[$k] = $v->store("uploads");
            }else{
                //否则办错
                $store_result[$k] = "未获取到上传文件或上传过程出错";
            }
        }
        //将移动的新位置返回
        return $store_result;
    }
    //无限极分类
    function getCateInfo($cate,$pid=0,$level=0){
        // dd($cate);
        //判断接受的分类信息是否为空
        if(!$cate){
            //如为空则停止执行
            return;
        }
        // 3.定义个静态的空数组
        static $cateArray=[];
        //1.循环分类信息
        foreach($cate as $v){
            // dump($v);
            //2.判断循环后的分类信息是否等于定义的pid
            if($v->pid==$pid){
                // dump($v);
                //自定义个level存进$v中
                $v->level = $level;
                //4.将循环后的信息存进数组中
                $cateArray[] = $v;
                //再次调用方法的自己本身
                getCateInfo($cate,$v->cate_id,$level+1);
            }
        }
        //将数组中的信息返回
        return $cateArray;
    }
    // function getCateInfo($cate){

    // }



?>