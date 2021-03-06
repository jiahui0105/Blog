<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>申请账号 - SYSIT个人博客</title>
	<base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="css/oschina2011.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/osc-popup.css" type="text/css" media="screen">
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,Simsun,sans-serif;}  
  </style>
</head>
<body>
<div id="OSC_Screen">
<div id="OSC_Content" class="CenterDiv"><style>
#OSC_Footer {border:0;}
.MainForm tr.hl th {border:1px solid #C00;border-right:0;background:#FEE;}
.MainForm tr.hl td {border:1px solid #C00;border-left:0;background:#FEE;}
.MainForm td .nodisp {display:none;padding-left:20px;}
.MainForm tr.hl td .nodisp {display:inline;color:#C00;font-size:11pt;}
#OSChinaLoginTip {font-size:10.5pt;padding:0 0 20px 10px;color:#060;}
#OSChinaLoginTip ul {margin:10px 0 0 0;}
#OSChinaLoginTip ul li {float:left; width:90px;margin-right:30px;}
#OSChinaLoginTip ul li#openid_gmail img {margin-top:8px;}
#OSChinaLoginTip ul li#openid_yahoo img {margin-top:15px;}
#OSChinaLoginTip ul li#openid_msn img {}
#OSChinaLoginTip ul li a {display:block;height:40px;}
#OSChinaLoginTip ul li a {border:1px solid #fff;padding:2px;}
#OSChinaLoginTip ul li a:hover {border:1px solid #40AA53;background:#cfc;}
</style>

<div class="MainForm" id="reg_page">
<!--    onsubmit="return false"  不允许提交  默认为true-->
<form id="frm_reg" action="" method="POST" style="float:left; width:620px;" onsubmit="return false;">
    <h2>申请<span style="color: #006600;"> SYSIT Blog</span> 账号，已经申请的请点击<a href="welcome/login">这里</a>登录</h2>
    <div id="error_msg" class="error_msg" style="display:none"></div>
	<table cellpadding="0" cellspacing="0">
    	<tbody><tr id="tr_email">
    		<th nowrap="nowrap">电子邮箱：</th>
    		<td>
				<input name="email" id="f_email" class="TEXT" style="width: 200px;" type="text">
				<span id="email_tip" class="nodisp"></span>
			</td>    			
    	</tr>
    	<tr>
    		<th>姓名：</th>		
    		<td><input name="name" id="f_name" maxlength="20" class="TEXT" style="width: 150px;" type="text">
				<span id="name_msg">不能超过10个字</span>
			</td>
    	</tr>
    	<tr>
    		<th>登录密码：</th>
    		<td><input name="pwd" id="f_pwd" class="TEXT" style="width: 150px;" type="password">
				<span id="password_msg">至少四位</span>		
			</td>    		
    	</tr>
    	<tr>
    		<th>密码确认：</th>		
    		<td><input name="pwd2" id="f_pwd2" class="TEXT" style="width: 150px;" type="password"></td>
    	</tr>
    	<tr id="tr_gender">
        	<th>性别：</th>		
    		<td>
				<input name="gender" value="1" id="gender_1" type="radio"><label for="gender_1">男</label>&nbsp;&nbsp;&nbsp;
				<input name="gender" value="2" id="gender_2" type="radio"><label for="gender_2">女</label>
				<span class="nodisp" id="sex_msg">请选择性别</span>
			</td>	
        </tr>
    	<tr id="tr_area">
    		<th>居住地区：</th>		
    		<td><select onchange="showcity(this.value, document.getElementById('userCity'));" name="province" id="userProvince">
	<option selected="selected" value="">--请选择省份--</option>
	<option value="北京">北京</option> 
	<option value="上海">上海</option> 
	<option value="广东">广东</option> 
	<option value="江苏">江苏</option> 
	<option value="浙江">浙江</option> 
	<option value="重庆">重庆</option> 
	<option value="安徽">安徽</option> 
	<option value="福建">福建</option> 
	<option value="甘肃">甘肃</option> 
	<option value="广西">广西</option> 
	<option value="贵州">贵州</option> 
	<option value="海南">海南</option> 
	<option value="河北">河北</option> 
	<option value="黑龙江">黑龙江</option> 
	<option value="河南">河南</option> 
	<option value="湖北">湖北</option> 
	<option value="湖南">湖南</option> 
	<option value="江西">江西</option> 
	<option value="吉林">吉林</option> 
	<option value="辽宁">辽宁</option> 
	<option value="内蒙古">内蒙古</option> 
	<option value="宁夏">宁夏</option> 
	<option value="青海">青海</option> 
	<option value="山东">山东</option> 
	<option value="山西">山西</option> 
	<option value="陕西">陕西</option> 
	<option value="四川">四川</option> 
	<option value="天津">天津</option> 
	<option value="新疆">新疆</option> 
	<option value="西藏">西藏</option> 
	<option value="云南">云南</option> 
	<option value="香港">香港特别行政区</option> 
	<option value="澳门">澳门特别行政区</option>
	<option value="台湾">台湾</option> 
	<option value="海外">海外</option>
</select>
<select name="city" id="userCity"></select>
<script src="js/getcity.js"></script><span class="nodisp">请选择您所在的地区</span></td>
    	</tr>
    	<tr>
    		<th>验证码：</th>		
    		<td><input id="f_vcode" name="verifyCode" size="6" class="TEXT" type="text">
			<span><a href="javascript:;" id="change_img">换另外一个图</a></span>
			</td>
    	</tr>
		<tr>
    		<th>&nbsp;</th>		
			<td id="captcha_img">
				<?php echo $captcha;?>
			</td>
			<span id="code_msg"> </span>
		</tr>
    	<tr class="buttons">
    		<th>&nbsp;</th>		
			<td style="padding: 20px 0pt;">
    		<input value=" 注册新用户 " class="BUTTON SUBMIT" type="submit">
			</td>
    	</tr>
	</tbody></table>
</form>
<div id="reg_tip" class="tipbox" style="float:right;width:300px;">
	<h3>为什么要注册？</h3>
	<ol>
		<li>发布博客</li>
		<li>参与博客的讨论和评论</li>
		<li>认识更多朋友</li>
	</ol>
	<h3 style="margin-top:20px;">为什么总提示验证码错误？</h3>
	<ol>
		<li>首先请确定浏览器已经启用Cookie</li>
		<li>实在不行，邮件给我们 admin@sysit.org</li>
	</ol>
</div>
<div class="clear"></div>
</div>
</div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
<script src="js/jquery-1.12.4.js"></script>
<script>

//    绑定事件 焦点离开就进行验证
	$('#f_email').on('blur',function(){
		// console.log($(this).val());
//        不用跳转到新的页面 所以用ajax操作即可 动态的在某个位置添加信息
		$.get('welcome/check_email',{
			email:$(this).val()
		},function(data){
            //data是请求的地址返回来的值  fail/success
			console.log(data);
			if(data =='fail'){
				$('#email_tip').html('邮箱已存在');
				$('#email_tip').show();
			}else{
				$('#email_tip').html('√');
			}
		},'text')


	});
	//更换验证码图片
	$('#change_img').on('click',function(){
		$.get('welcome/get_captcha',function(data){
			$('#captcha_img').html(data);
		},'text');
	});


    //获取注册新用户的按钮
	$('.SUBMIT').on('click',function(){
		var name = $('#f_name').val();
		var pwd = $('#f_pwd').val();
		var flag = true;
		if(name == '') {
			$('#name_msg').html('姓名不能为空');
			flag = false;
		}
		if(pwd == ''){
			$('#password_msg').html('密码不能为空');
			flag = false;
		}

		//flag为真 则姓名和密码填写正确 可以注册
		if(flag){
			var email = $('#f_email').val();
			var sex = $('[name=gender]:checked').val();  //选择器的属性:表单
			var code = $('#f_vcode').val();   //用户输入的验证码  要和生成的进行校验
			$.get('welcome/save',{
				email:email,
				name:name,
				pwd:pwd,
				sex:sex,
				code:code
			},function (data) {
				if(data == 'success'){
					window.location.href = 'welcome/login';
				}else if(data == 'code_error'){
					$('#code_msg').html('验证码错误');
				}else if(data=='sex_error'){
					$('#sex_msg').html('请选择性别');
					$('#sex_msg').show();
				}
			},'text');
		}

	});

    ////光标点击输入框时 '姓名不能为空'取消
	$('#f_name').on('focus',function(){
		$('#name_msg').html('');
	});
    $('#f_pwd').on('focus',function(){
        $('#password_msg').html('');
    });





</script>
</body></html>