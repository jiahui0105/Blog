<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//MVC模式 model-view-control  在这三个文件夹中进行编程
//model是进行数据库  view显示的页面 control控制访问的页面
//views中写静态页面 css样式需要加base_url->控制器中进行加载页面->model中进行数据获取

//  访问
//   http://localhost/myci/welcome/login
//   http://localhost/项目名/控制器名/方法名

//访问control的方法之前要先改基础路径，默认的端口为80，apache服务器端口是8081
//在config.php第28行改基础路径 $config['base_url'] = 'http://localhost:8081/myci/';

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
//  每次进入welcome都会自动调用该函数 调用数据库
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->model('User_model');
    }

	//	访问首页
	public function index()
	{

        $blog_list = $this->Blog_model->get_blog_list();
        $catalog_list = $this->Blog_model->get_catalog_list();

        $this->load->view('index',array(
            'list'=>$blog_list,
            'catalog_list'=>$catalog_list,
        ));
	}

//	获取验证码   CI自带函数captcha
    public function captcha(){

        $this->load->helper('captcha');
        $word = rand(1000,9999);
//        把随机生成的验证码记录在session里 和用户输入的数字进行验证
        $this->session->set_userdata('captcha',$word);
//        验证码辅助函数
        $vals = array(
            'word'      => $word,
            'img_path'  => './captcha/',
            'img_url'   => 'http://localhost:8081/myblog/captcha/',
            'font_path' => './path/to/fonts/texb.ttf',
            'img_width' => '100',
            'img_height'    => 30,
            'word_length'   => 8,
            'font_size' => 16,
            'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'    => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $img = $cap['image'];
        return $img;
    }
//  点击更换条形码时先获取一个新的验证码 此时不用更新页面，所以用ajax把图片传过去给data
    public function get_captcha(){
        $img = $this->captcha();
        echo $img;
    }

//	注册页面
    public function reg()
    {
//        $this->load->view('reg');
//        进入注册页面就先获取验证码   通过加载页面的方式把图片传过去 然后输出到页面
        $img = $this->captcha();
        $this->load->view('reg',array(
            'captcha'=>$img
        ));
    }

//    注册信息的邮箱验证
    public function check_email(){

        $email = $this->input->get('email');  //接收输入的email
        $rows = $this->User_model->get_user_by_email($email);  //传到model中进行查询
//        查询到的数据返回给rows 判断rows长度 大于0则邮箱已经存在
        if(count($rows) >0){
//            只要是ajax请求调用的 不论什么语言都要有输出语句
            echo 'fail';
        }else{
            echo 'success';
        }
    }

//保存注册信息
    public function save(){
        $email = $this->input->get('email');
        $name = $this->input->get('name');
        $pwd = $this->input->get('pwd');
        $sex = $this->input->get('sex');
        $code = $this->input->get('code');
        $captcha = $this->session->userdata('captcha');

        if($sex == ''){
            echo 'sex_error';
        }elseif($code != $captcha){
            echo 'code_error';
        }else{
            $rows = $this->User_model->save($email,$name,$pwd,$sex);

            if($rows>0){
                echo 'success';
            }else{
                echo 'fail';
            }

        }

    }
//  登录页面
    public function login(){
        $this->load->view('login');
    }
//    登录账号验证
    public function check_login(){
        $email = $this->input->post('email');
        $pwd = $this->input->post('pwd');
        $user = $this->User_model->check_login($email,$pwd);

        if($user){
            $this->session->set_userdata('user',$user);
            redirect('welcome/blog_list');
        }
//        //通过查询id来获取该用户的博客列表
//        $id = $user->id;
//        //查数据库 调用model
//        $blogs = $this->Blog_model->get_blog_list_by_id($id);
//
//        $this->load->view('index_logined',array(
//            'blogs'=>$blogs,
//        ));
    }

//    点击文章标题时 获取该文章的详细内容如评价等
    public function blog_detail($blog_id){

        $my_blogs = $this->get_blog_list();  //我的所有文章列表

        $blog = $this->Blog_model->get_blog_by_id($blog_id);  //当前点击进来的那个文章

        $comments = $this->Blog_model->get_comment_by_blog_id($blog_id);//该文章的评价

        //把文章详情页的post_time(数据库中的值)用time_tran函数转换一下  变成多少时间以前
        $blog->post_time = $this->time_tran($blog->post_time);

        $next = null;
        $prev = null;

//        如果所有文章列表my_blogs中有任何一个和当前点击进来的文章blog相等，则指向当前文章的上一篇和下一篇
//        index为当前博客的索引
        foreach ($my_blogs as $index=>$my_blog){
            if($my_blog->blog_id == $blog->blog_id){
                if($index > 0){     //不是第一篇
                    $prev = $my_blogs[$index - 1];
                }
                if($index < count($my_blogs)-1){       //不是最后一篇
                    $next = $my_blogs[$index + 1];
                }
            }
        }

        $this->load->view('viewPost_comment',array(
            'blog'=>$blog,
            'prev'=>$prev,
            'next'=>$next,
            'comments'=>$comments,
        ));

    }


//    谁调用这个函数就返回该用户的博客列表
    private function get_blog_list(){
//        $id = $this->input->post('id');//第一种方式 从前端页面中传一个id 用post方式接收
        $id = $this->session->userdata('user')->id;//第二种方式 从session里取id   当前登录人的id最好用session
        //查数据库 调用model
        $blogs = $this->Blog_model->get_blog_list_by_id($id);
        return $blogs;
    }


//    当点击用户图像时获取该用户博客列表 跳转到该用户的主页
    public function blog_list(){

        $blogs = $this->get_blog_list();
        $this->load->view('index_logined',array(
            'blogs'=>$blogs,
        ));
    }


//退出登录
    public function logout(){

        $this->session->unset_userdata('user');
        redirect('welcome/login');  //想要页面和地址对应 用重定向
//        $this->load->view('login');
    }


//    获取多少秒前 多少小时前 多少天前
    public function time_tran($the_time)
    {
        $now_time = date("Y-m-d H:i:s", time() + 8 * 60 * 60);
        $now_time = strtotime($now_time);
        $show_time = strtotime($the_time);
        $dur = $now_time - $show_time;
        if ($dur < 0) {
            return $the_time;
        } else {
            if ($dur < 60) {
                return $dur . '秒前';
            } else {
                if ($dur < 3600) {
                    return floor($dur / 60) . '分钟前';
                } else {
                    if ($dur < 86400) {
                        return floor($dur / 3600) . '小时前';
                    } else {
                        if ($dur < 259200) {//3天内
                            return floor($dur / 86400) . '天前';
                        } else {
                            return $the_time;
                        }
                    }
                }
            }
        }
    }



}
