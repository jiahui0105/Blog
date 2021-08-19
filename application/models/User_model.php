<?php

//连接数据库  需要配置config里的database 数据库信息和autoload的61行
class User_model extends CI_Model
{
//    可以查看CI的用户手册  生成构造器类-插入数据
    public function save($email,$name,$pwd,$sex){
        $data = array(
            'name' => $name,
            'password' => $pwd,
            'email'=>$email,
            'sex'=>$sex
        );
        //把数据data插入到数据库表t_user里
        $query = $this->db->insert('t_user', $data);
        return $query;   //返回rows行数
    }


    public function get_user_by_email($email){

        $query = $this->db->get_where('t_user',array(
            'email'=>$email
        ));
//         返回查询到的数组  根据数组长度来验证邮箱是否已经注册过
        return $query->result();
    }


    public function check_login($email,$pwd){

        $query = $this->db->get_where('t_user',array(
            'email'=>$email,
            'password'=>$pwd
        ));
        return $query->row();      //row返回对象 只有一个
    }




}