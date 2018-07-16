<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $this->display("Index/index");
    }
    //设置是否图片上串
     public function add(){
          //实例化数据库
       $mod = new \Think\Model("shop");
       $mod->create();
       $id = $mod->add();
       //调用图片上传
       $image = $this->myupload($_FILES);

       if(!empty($image)){
        $cc = M("shopimg");
        $data = [];//用于批量添加的数据
        foreach ($image as $k=> $v) {
            if($k ==0){
               $data[$k]['start']=1; 
            }else{
                $data[$k]['start']=0; 
            }
           $data[$k]['imgpath'] = $v;
           $data[$k]['sid'] = $id;
        }
        //执行批量添加
         $a = $cc->addAll($data);
           if($a){
            $this->success("添加商品名称与图片成功",U("Index/show"));
            exit;
        }else{
            $this->error("添加商品名称与图片成功失败了");
            exit;
        }
       }
     if($id){
        $this->success("添加商品名称成功",U("Index/show"));
        exit;
     }else{
        $this->error("添加商品失败了");
            exit;
     }
      
    }
        public function show()
        {
           $mod = M("shop");
           // $res = $mod->query("select * from shop left join shopimg on shop.id=shopimg.sid and shopimg.start=1 order by shop.id");
           // as 起别名 保证数据不冲突
           // $res = $mod
           // ->field("shop.id as aid,shop.shopname,shopimg.id,shopimg.imgpath")
           // ->join("left join shopimg on shop.id = shopimg.sid and shopimage.start = 1")
           // ->order("shop.id")
           // ->select();
           // 
           $mod = M();
           $res =$mod->table("shop s")
           ->field("s.id as aid,s.shopname as nm,m.id,m.imgpath")
           ->join("left join shopimg as m on s.id=m.sid and m.start = 1")
           ->order("s.id")
           ->select();
           // dump($res);

            $a = "游客";
            $this->assign("a",$a);
           $this->assign("res",$res);
           $this->display("Index/show");

        }

        public function myupload(){
            $upload = new \Think\Upload();// 实例化上传类   
            $upload->maxSize  = 0 ;// 设置附件上传大小   
            $upload->exts    = array('jpg', 'gif', 'png', 'jpeg');//设置附件上传类型 
            // 图片保存更目录
            $upload->rootPath="./img/Public";
            $upload->savePath  = '/Uploads/'; // 设置附件上传目录    // 上传文件  
            //设置是否开启日期目录
            $upload->autoSub  = false;//默认为true
            // $info  =  $upload->uploadOne($_FILES['pic']);  //单图片一维数组
            
            //实例化图片缩放
             $aa = new \Think\Image();

            $info  =  $upload->upload();  //多图片
            // dump($info);
            //定义空数组
            $image=[];
            if($info){
            	foreach ($info as $file) {
            		  $image[] =  $file['savepath'].$file['savename'];
              //通过完整路径打开上传后 的图片
                // $img=$aa->open("./img/Public".$file['savepath'].$file['savename']);
             //图片缩放方法 thumb 设置缩放的宽高  save图片存放位置
             // $img->thumb(50, 50)->save("./Img/Public".$file['savepath']."s_".$file['savename']);

             //设置图片水印
              $aa->open("./Img/Public".$file['savepath'].$file['savename'])->water("./Img/Public/Uploads/11.jpg",\Think\Image::IMAGE_WATER_CENTER)->save("./Img/Public/".$file['savepath'].$file['savename']); 
               dump($aa);
             exit;
             
            }
            return $aa;
          }
    	}

}
?>