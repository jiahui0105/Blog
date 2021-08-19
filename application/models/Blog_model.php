<?php

//连接数据库  需要配置config里的database 数据库信息和autoload的61行
class Blog_model extends CI_Model
{
//    可以查看CI的用户手册  生成构造器类-插入数据
//获得博客列表
    public function get_blog_list(){

//第一种方式
//        //把数据data插入到数据库表t_user里
//        $query = $this->db->get('t_blog');  //get()  select * from table
//
////        关联两张表
//        $this->db->select('*');
//        $this->db->from('t_blog b');   //t_blog as b
//        $this->db->join('t_blog_catalog c', 'b.catalog_id = c.catalog_id');
////        模糊查询 把发表的文章按发布时间排序  desc降序 asc升序
//        $this->db->order_by('b.post_time','desc');
//
//        $query = $this->db->get();
//        return $query->result();


//第二种方式 sql语句 比较方便
        $sql = "select *,
(select count(*) from t_comment tc where tc.blog_id = b.blog_id) num
 from t_blog b,t_blog_catalog c
where b.catalog_id = c.catalog_id
order by b.post_time desc";

        $query = $this->db->query($sql);
        return  $query->result();
    }

    public function get_catalog_list(){

        $query = $this->db->get('t_blog_catalog');
        return $query->result();
    }

    public function get_blog_list_by_id($id){

        $sql = "select *,
(select count(*) from t_comment tc where tc.blog_id = b.blog_id) num
 from t_blog b,t_blog_catalog c
where b.catalog_id = c.catalog_id and b.user_id = $id
order by b.post_time desc";

        $query = $this->db->query($sql);
        return  $query->result();
    }

    public function get_blog_by_id($blog_id){

//        return $this->db->get_where('t_blog',array(
//            'blog_id'=>$blog_id
//        ))->row();

        $sql = "select *,(select count(*) from t_comment c where c.blog_id = b.blog_id) num,
        (select count(*) from t_collect tc where tc.blog_id = b.blog_id) cnum
                from t_blog b where b.blog_id = $blog_id";

        $query = $this->db->query($sql);
        return  $query->row();
    }


    public function get_comment_by_blog_id($blog_id){

//        return $this->db->get_where('t_comment',array(
//            'blog_id'=>$blog_id
//        ))->result();

        $this->db->select('*');
        $this->db->from('t_comment c');//从哪个表查
        $this->db->join('t_user u','c.user_id=u.id');//让这个表关联另一个表
        $this->db->where('c.blog_id',$blog_id);
        return $this->db->get()->result();

//        $sql = "select * from t_comment c,t_user u where c.user_id=u.id and c.blog_id =1";

//        $sql = "select * from t_comment c left join t_user on c.user_id=u.id  where c.blog_id =1";

    }


}