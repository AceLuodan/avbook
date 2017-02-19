<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(360);
class Jav extends CI_Controller {

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
    public function index()
    {
        $url = 'avbook/index.php/jav/javhome/?';
        Header("Location:$url");
    }
    public function javhome()
    {
        
        $this->load->database();
        $this->load->library('pagination');
        $config['per_page']       = 35; // 每页显示数量
        $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值 
        $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_links'] = 8;$config['num_tag_close'] = '</li>'; 
        $config['attributes'] = array('name' => 'numbar'); 
        $send='?';
        if(isset($_GET['hd'])){
            
            $t=(int)$_GET['hd'];
            $this->db->where('have_hdbtso',$t);
            $send.="&hd=$t";
        }
        if(isset($_GET['mg'])){
            $t=(int)$_GET['mg'];
            $this->db->where('have_mgbtso',$t);
            $send.="&mg=$t";
        }
        if(isset($_GET['hd2'])){
            $t=(int)$_GET['hd2'];
            $this->db->where('have_hd',$t);
            $send.="&hd2=$t";
        }
        if(isset($_GET['mg2'])){
            $t=(int)$_GET['mg2'];
            $this->db->where('have_mg',$t);
            $send.="&mg2=$t";
        }
        $keys=array('Series','Label','Studio','director');
        foreach ($_GET as $key => $value) {
            if (in_array($key, $keys)) {
                $t= $_GET[$key];;
                $this->db->where($key,$t);
                $send.="&$key=$t";
            } 
        }
        if(isset($_GET['cen'])){
            $key = 'cen';
            $t= $_GET[$key];;
            $this->db->like('censored_id',$t);
            $send.="&$key=$t"; 
        }
         
        if(isset($_GET['st0'])){
            $t= $_GET['st0'];
            $this->db->where('JAV_Idols','['.$t.']');
            $send.="&st0=$t";
        }
        if(isset($_GET['file'])){
            $t=(int)$_GET['file'];
            $this->db->where('have_file',$t);
            $send.="&file=$t";
        }
        if(isset($_GET['sub'])){
            $t=(int)$_GET['sub'];
            $this->db->where('have_sub',$t);
            $send.="&sub=$t";
        }
        if(isset($_GET['gc'])){ 
            $key = 'gc';
            $arr_gc=explode(',', $_GET[$key]); 
            foreach ($arr_gc as $genrecode) { 
                $this->db->like('Genre', '['.$genrecode.']'); 
            } 
            $send.="&$key={$_GET[$key]}"; 
        }
        if(isset($_GET['gcde'])){
            $key = 'gcde';
            $arr_gc=explode(',', $_GET[$key]);
            //var_dump($arr_gc);die;
            foreach ($arr_gc as $genrecode) {
                $this->db->not_like('Genre', '['.$genrecode.']');
            }
            $send.="&$key={$_GET[$key]}";
        }
         
        if(isset($_GET['tit'])){
            $key ='tit';
            $t=$_GET[$key]; 
            $send.="&$key=$t";
            
            preg_match_all('/([a-zA-Z]{2,6})[-|_|\s]{0,3}([0-9]{3,4})(.*?)/', $value,$out);
            //var_dump($out);
            foreach ($out[1] as $key => $value) {
                $ak[strtoupper($out[1][$key]).'-'.$out[2][$key]]=1;//."({$out[0][$key]})"
            }
            
            
            if (empty($ak)) {
                $this->db->like('movie_title',  $t );
            }else{
                $ak=array_keys($ak);
                $this->db->where_in('censored_id',  $ak );
            }
            
            //$this->db->like('movie_title',  $t );
        
        }
        
        if(isset($_GET['st'])){
            $starcode=$t=$_GET['st'];
            $likeid='JAV_Idols';
            $send.="&st=$t";
            $this->db->like($likeid, '['.$starcode.']');
        } 
        $config['base_url']       = site_url('jav/'.__FUNCTION__.'/'.$send);
        $config['page_query_string'] = TRUE; 
        $db = clone($this->db);
        $config['total_rows']     =$db->count_all_results('jav_avmoo'); 
        $page =@(int)$_GET['per_page'];
        $page = ($page > ceil($config['total_rows']/$config['per_page']))?0:$page; 
        $offset = $page == false?0:($config['per_page'] * ($page - 1)); 
        
        $this->db->order_by('release_date', 'DESC');
        $this->db->limit($config['per_page'], $offset);  
        $data['list'] = $this->db->get('jav_avmoo')->result_array(); 
        //echo $this->db->last_query();die;
        $this->pagination->initialize($config); 
        $data['page_list'] = $this->pagination->create_links(); 
         
        if (($page==1 ||$page==0) && (!empty($starcode))) {
            $res_star = $this->db->select('*')->where('star_code_36',$starcode)->get('jav_avmoo_star_name')->result_array();
             
            $data['res_star']=$res_star[0];
        }
        $data['send']=$send;
        $this->load->view('javhome' ,$data);
    }
    public function javactresses()
    {
        $this->load->database();
        $this->load->library('pagination');
    
        $config['per_page']       = 30; // 每页显示数量
        $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
    
        $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
    
    
        $config['attributes'] = array('name' => 'numbar');
        //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
    
        // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
        // 执行分页类初始化
    
        $send='?';
        if(isset($_GET['hd'])){
            $t=(int)$_GET['hd'];
            $this->db->where('have_hd',$t);
            $send.="&hd=$t";
        }
        if(isset($_GET['mg'])){
            $t=(int)$_GET['mg'];
            $this->db->where('have_mg',$t);
            $send.="&mg=$t";
        }
        if(isset($_GET['file'])){
            $t=(int)$_GET['file'];
            $this->db->where('have_file',$t);
            $send.="&file=$t";
        }
        if(isset($_GET['sub'])){
            $t=(int)$_GET['sub'];
            $this->db->where('have_sub',$t);
            $send.="&sub=$t";
        }
        if(isset($_GET['gc'])){
            $genrecode=$t=$_GET['gc'];
            if (empty($genrecode)) {
                $genrecode = '4m';
            }
            $send.="&gc=$t";
            $this->db->group_start()->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
            $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
            $this->db->or_like('Genre', ','.$genrecode.',', 'both')->group_end();  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
    
        }
        if(isset($_GET['st'])){
            $starcode=$t=$_GET['st'];
            $likeid='JAV_Idols';
            $send.="&st=$t";
            $this->db->group_start()->like($likeid, ','.$starcode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
            $this->db->or_like($likeid, $starcode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
            $this->db->or_like($likeid, ','.$starcode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
            $this->db->or_where($likeid,$starcode)->group_end();
        }
         
        $config['base_url']       = site_url('jav/'.__FUNCTION__.'/'.$send);
        $config['page_query_string'] = TRUE;
        $page =@(int)$_GET['per_page'];
    
    
    
        // 数据库查询(假设已经装载了数据库类)
        //$page =(int)$this->uri->segment(5); // $this->input->get('cur_page'); // 获取页码
        $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
    
         
        $db = clone($this->db);
        $config['total_rows']     =$db->count_all_results('jav_avmoo_star_name'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
    
        $this->db->order_by('id', 'DESC');
        $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
        $data['list'] = $this->db->get('jav_avmoo_star_name')->result_array(); // 获取数据库里的数据
    
        $this->pagination->initialize($config); 
        $data['page_list'] = $this->pagination->create_links(); 
        if (($page==1 ||$page==0) && (!empty($starcode))) {
            $res_star = $this->db->select('*')->where('star_code_36',$starcode)->get('jav_avmoo_star_name')->result_array();
             
            $data['res_star']=$res_star[0];
        }
         
        $this->load->view(__FUNCTION__,$data);
    }
   
	
	public function javsg()
	{
	    // mkdir('/var/www/test666', 0777, true);die;99
	    $this->load->database();
	    $page =$this->uri->segment(3);//die;
	    if (empty($page)) {
	        $page ='PGD-903';
	    }
	    if (!empty($_GET['star'])) {
	       // $this->db->select('*')->where('censored_id',$page);
	    }
	    $more_where='';
	    $more_wherekey='';
	    if (!empty($_GET['id'])) {
	        //$this->db->where('code_36',$_GET['id']);
	        $res = $this->db->select('*')->where('code_36',$_GET['id'])->order_by('release_date', 'DESC')->get('jav_avmoo')->result_array();
	        $more_where='code_36';
	        $more_wherekey=$_GET['id'];
	         //var_dump($res);die;
	    }else{
	        $res = $this->db->select('*')->where('censored_id',$page)->order_by('release_date', 'DESC')->get('jav_avmoo')->result_array();
	        $more_where='censored_id';
	        $more_wherekey=$page;
	    }
	    if (empty($res)) {
	        die;
	    }
// 	    $countres = count($res);
// 	    if ($countres>1) {
// 	         $info= $res[$countres-1];;
// 	    }else{
// 	        $info= $res[0];
// 	    }
	    $info= $res[0];
	    $find=array('[',']');
	    //$stemp=str_replace('][', ',', $info['JAV_Idols']);
	    $info['JAV_Idols'] = str_replace($find, '',str_replace('][', ',', $info['JAV_Idols']));
	    $arr_star = explode(',', $info['JAV_Idols']); 
	    $res_star = $this->db->select('*')->where_in('star_code_36', $arr_star)->get('jav_avmoo_star_name')->result_array();
	    //var_dump($res_star);die;
	    $info['Genre'] = str_replace($find, '',str_replace('][', ',', $info['Genre']));
	    $arr_genre_code =explode(',', $info['Genre']) ;
	    
	    $res_genre = $this->db->select('*')->where_in('genre_code', $arr_genre_code)->get('jav_avmoo_genre_name')->result_array();
	   // var_dump($res_genre);die;
	    /* $random_keys=array_rand($arr_genre_code,count($arr_genre_code)-2);
	    foreach ($random_keys as $value) {
	          $this->db->like('Genre', '['.$value.']');
	    }
	    $this->db->where($more_where.' !=',$more_wherekey)->order_by('release_date', 'DESC');
	    $this->db->limit(6, 0);
	    $res_more= $this->db->select('*')->get('jav_avmoo')->result_array(); */
		$res_more =array();
	    $gid =   $this->db->select('gid')->where('movie_pic_cover', $res[0]['code_36'] )->get('jav_javbus5_movienew')->result_array(); 
	    $res_more= $this->db->select('Similar')->where('censored_id',$res[0]['censored_id'])->get('jav_javbus5_movienew')->result_array();
		 
	    if (!empty($res_more)) {
	        ;
	        $Similar= explode(',', str_replace($find, '',str_replace('][', ',',$res_more[0]['Similar'])));
	        $res_more = $this->db->select('*')->where_in('censored_id', $Similar)->get('jav_avmoo')->result_array();
	         
	    }
	     
	    //var_dump($res_more[0]['Similar']);die;
	    $data['res_star'] = $res_star;
	    $data['res_genre'] = $res_genre;
	    $data['res_more'] = $res_more;
	    $data['value'] = $res[0];
	    $data['gid'] = @$gid[0] ;
	    $this->load->view('javsg' ,$data);
	}
	public function javsgmg()
	{
	    $data=array();
	    $this->load->view('javsgmg' ,$data);
	}
	
	public function uncledatoolsbyajax()
	{
	    // mkdir('/var/www/test666', 0777, true);die;99
	    $this->load->database();
	    $page =$this->uri->segment(3); 
	    $gidmg=$this->uri->segment(4);
	    $res = $this->db->select('*')->where('gid',$gidmg)->order_by('have_hd', 'DESC')->order_by('magnet_type', 'DESC')->order_by('magnet_date', 'DESC')->get('jav_javbus5_magnet_youma')->result_array();
	    $res2 =array();
	    // $res2 = $this->db->select('*')->where('censored_id',$page)->order_by('have_hd', 'DESC')->order_by('magnet_type', 'DESC')->order_by('magnet_date', 'DESC')->get('jav_byso_youmamg')->result_array();
	     
	    if (empty($res)) {
	       // echo 404;
	      //  die;
	    }
	     
	    $data['res_mg'] = $res;
	     $data['res_mgbtso'] = $res2;
	    $this->load->view('javuncledatoolsbyajax' ,$data);
	}
	public function pag404()
	{
	    $this->load->view('pag404' );
	}
	
	public function uncledatoolsbyajaxlw()
	{
	    // mkdir('/var/www/test666', 0777, true);die;99
	    $this->load->database(); 
	    
	    $res = $this->db->select('*')->where('have_down',3)->order_by('have_hd', 'DESC')->order_by('magnet_type', 'DESC')->order_by('magnet_date', 'DESC')->limit(5)->get('jav_javbus5_magnet_youma')->result_array();
	     
	    $res2 = $this->db->select('*')->where('have_down',3)->order_by('have_hd', 'DESC')->order_by('magnet_type', 'DESC')->order_by('magnet_date', 'DESC')->limit(5)->get('jav_byso_youmamg')->result_array();
	
	    if (empty($res)) {
	        // echo 404;
	        //  die;
	    }
	    $end =array();
	    foreach ($res as $key => $value) {
	        $end[$value['magnet_xt']]=$value;
	    }
	    foreach ($res2 as $key => $value) {
	        $end[$value['magnet_xt']]=$value;
	    }
	    $resall=array();
	    foreach ($end as $key => $value) {
	        $resall[]=$value;
	    }
	
	    $data['res_mg'] = array();
	    $data['res_mgbtso'] = $resall;
	    $this->load->view('javuncledatoolsbyajaxlw' ,$data);
	}
	public function ajaxaddgc()
	{
	    if (empty($_GET['code_36'] ) ||empty( $_GET['Genre'] )) {
	        die;
	    }
	    $this->load->database();
	    $res = $this->db->select('*')->where('code_36',$_GET['code_36'])->get('jav_avmoo')->result_array();
	    $find=array('[',']');
	    $res[0]['Genre'] = str_replace($find, '',str_replace('][', ',', $res[0]['Genre']));
	    $arr = explode(',', $res[0]['Genre']); 
	   
	   //var_dump($arr);die;
	   if (!in_array($_GET['Genre'], $arr)) {
	       $res[0]['Genre']= '['.str_replace(',', '][',  $res[0]['Genre']).']';
	   //if (strpos($res[0]['Genre'], ','.$_GET['Genre']!==false)) {
	       $data = array( 'Genre' => $res[0]['Genre'].'['.$_GET['Genre'] .']' );
	       $this->db->where('code_36',  $res[0]['code_36'] );
	       $this->db->update('jav_avmoo', $data);
	       echo "添加成功";
	   }else{
	       echo '已存在';
	   }
	    
	}
	
	public function ajaxaddallgc()
	{
	   // var_dump($_GET['code_36s']);
	     if (empty($_GET['code_36s'])||empty($_GET['Genre'] )) {
	         die(444);
	     }
	     $this->load->database();
	     foreach ($_GET['code_36s'] as $value) {
	         ;
	         $_GET['code_36']=$value;
	         $res = $this->db->select('*')->where('code_36',$_GET['code_36'])->get('jav_avmoo')->result_array();
	         $find=array('[',']');
	         $res[0]['Genre'] = str_replace($find, '',str_replace('][', ',', $res[0]['Genre']));
	         $arr = explode(',', $res[0]['Genre']);
	         
	         //var_dump($arr);die;
	         if (!in_array($_GET['Genre'], $arr)) {
	             $res[0]['Genre']= '['.str_replace(',', '][',  $res[0]['Genre']).']';
	             //if (strpos($res[0]['Genre'], ','.$_GET['Genre']!==false)) {
	             $data = array( 'Genre' => $res[0]['Genre'].'['.$_GET['Genre'] .']' );
	             $this->db->where('code_36',  $res[0]['code_36'] );
	             $this->db->update('jav_avmoo', $data);
	            // echo "添加成功";
	         }else{
	            // echo '已存在';
	         }
	     }
	     echo 200;
	}
	public function ajaxaddmg()
	{
	    if (empty($_GET['code_36'] ) ||empty( $_GET['magnet_xt'] )) {
	        die;
	    }
	    $this->load->database(); 
	        $data = array( 'have_down' =>$_GET['have_down']  );
	        $this->db->where('magnet_xt', $_GET['magnet_xt'] );
	        $this->db->update('jav_byso_youmamg', $data);
	        
	        $data = array( 'have_down' =>$_GET['have_down']  );
	        $this->db->where('magnet_xt', $_GET['magnet_xt'] );
	        $this->db->update('jav_javbus5_magnet_youma', $data);
	        
	        if ($_GET['have_down']==1) {
	            $file=6;
	        }elseif ($_GET['have_down']==3){
	            $file=8;
	        }else{
	            $file=0;
	        }
	        
	        //$file=$_GET['have_down']==0?0:8;//have_file=1 文件名匹配硬盘。2.3.已下载，有文件 //4.5 
	        //6标志为1，115下载。
	        //.7.缺少资源迅雷慢 
	        //8.已标志have_down为3,优先下载，
	        //9.正在下载
	        $data = array( 'have_file' => $file );
	        $this->db->where('code_36', $_GET['code_36'] );
	        $this->db->update('jav_avmoo', $data);
	        
	        
	        echo 200; 
	     
	}
	
	
	public function ajaxremovemg()
	{
	    if (empty($_GET['code_36']  )||empty(  $_GET['magnet_xt'] )) {
	        die;
	    }
	    $this->load->database();
	    $data = array( 'have_down' =>$_GET['have_down']  );
	    $this->db->where('magnet_xt', $_GET['magnet_xt'] );
	    $this->db->where('have_down', 3 );
	    $this->db->update('jav_byso_youmamg', $data);
	     
	    $data = array( 'have_down' =>$_GET['have_down']  );
	    $this->db->where('magnet_xt', $_GET['magnet_xt'] );
	    $this->db->where('have_down', 3 );
	    $this->db->update('jav_javbus5_magnet_youma', $data);
	     
	    if ($_GET['have_down']==1) {
	        $file=6;
	    }elseif ($_GET['have_down']==3){
	        $file=8;
	    }else{
	        $file=0;
	    }
	     
	    //$file=$_GET['have_down']==0?0:8;//have_file=1 文件名匹配硬盘。2.3.已下载，有文件 //4.5
	    //6标志为1，115下载。
	    //.7.缺少资源迅雷慢
	    //8.已标志have_down为3,优先下载，
	    //9.正在下载
// 	    $data = array( 'have_file' => $file );
// 	    $this->db->where('code_36', $_GET['code_36'] );
// 	    $this->db->update('jav_avmoo', $data);
	     
	     
	    echo 200;
	
	}
	public function home()
	{
	    
	    // mkdir('/var/www/test666', 0777, true);die;1
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    
	    
	    
	    $this->load->library('pagination');
	    
	    // 分页设置
	    $config['base_url']       = site_url('welcome/home'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	     
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	     
	     
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	    
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	    
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(3); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	    //$this->db->like('Genre', '4m');
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	    
	    
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    $arr_pic  = array();
	    foreach ($data['list'] as $key=> $value) {
	        $imgpath = ''.$value['movie_pic_cover'];
	        //$arr_pic[]= $filepath;
	         
	        $t_path = '/var/www/html/jav/jav_star/avmoopic/' ;
	        $filepath = $t_path.$imgpath;
	        if (!is_file($filepath)) {
	            $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$value['censored_id']."'");
	             
	            if (is_file($t_path.$query->row()->movie_pic_cover)) {
	                $data['list'][$key]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	            }else{
	                $arr_pic[]=$imgpath;
	            }
	        }else{
	             
	        }
	    }
	    //$arr_pic = array_filter($arr_pic, "self::delindirfile");
	    //$arr_pic = array_values($arr_pic);
	    
	    $url_host ='https://pics.dmm.co.jp/';
	     
	    $arr_pic_2 = array();
	    //var_dump($arr_pic);
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	    
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    $arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    //var_dump($arr_pic);die;
	     
	    $arr_pic = array();
	    foreach ($arr_pic_2 as $key => $value) {
	        ;
	        // $filepath = '/var/www/html/jav/jav_star/avmoopic/' .$value;
	        foreach ($data['list']  as $keyl => $valuel) {
	            if ($key==$valuel['movie_pic_cover']) {
	                $data['list'][$keyl]['movie_pic_cover'] = $value;
	                 
	                $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$valuel['censored_id']."'");
	                 
	                $data['list'][$keyl]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	                 
	                $filepath=  '/var/www/html/jav/jav_star/avmoopic/' .$query->row()->movie_pic_cover ;
	                // var_dump($row);die;
	                break;
	            }
	        }
	        if (!is_file($filepath)) {
	            $arr_pic[] = $query->row()->movie_pic_cover;
	        }else{
	    
	        }
	    }
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	             
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    //$arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	    
	    //$date['value'] = $res[0];
	   // $this->load->view('ephp' ,$data);
	    $this->load->view('avmoohome' ,$data);
	}
	public function homeonline()
	{
	     
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	     
	     
	     
	    $this->load->library('pagination');
	     
	    // 分页设置
	    $config['base_url']       = site_url('welcome/homeonline/'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	     
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	     
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(3); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	    //$this->db->like('Genre', '4m');
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	     
	     
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	     
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('avmoohomeonline' ,$data);
	}
	public function javol()
	{
	
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	
	
	
	    $this->load->library('pagination');
	
	    // 分页设置
	    $config['base_url']       = site_url('welcome/javol/'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul   class="pagination pagination-lg" >';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    
	    $send='?';
	    if(isset($_GET['hd'])){
	        $t=(int)$_GET['hd'];
	        $this->db->where('have_hd',$t);
	        $send.="hd=$t";
	    }
	    if(isset($_GET['mg'])){
	        $t=(int)$_GET['mg'];
	        $this->db->where('have_mg',$t);
	        $send.="&mg=$t";
	    }
	    if(isset($_GET['file'])){
	        $t=(int)$_GET['file'];
	        $this->db->where('have_file',$t);
	        $send.="&file=$t";
	    }
	    if(isset($_GET['sub'])){
	        $t=(int)$_GET['sub'];
	        $this->db->where('have_sub',$t);
	        $send.="&sub=$t";
	    }
	    $config['base_url']       = site_url('welcome/'.__FUNCTION__.'/'.$send);
	    $config['page_query_string'] = TRUE;
	    $page =@(int)$_GET['per_page'];
	    if ($page>($config['total_rows']/$config['per_page'])) {
	        $page =0;
	    }
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	
	    // 数据库查询(假设已经装载了数据库类)
	    //(int)$this->uri->segment(3); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	    //$this->db->like('Genre', '4m');
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    
	    
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	 
	    $data['page_list'] = $this->pagination->create_links();
	 
	    $this->load->view('javbushomeol' ,$data);
	}
	public function genretm()
	{
	    $this->load->view('genretmjav' ,'');
	}
	public function genretmjav()
	{
	    $this->load->view('genretm' ,'');
	}
	public function homegenreonline()
	{
	
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    $genrecode = $this->uri->segment(3);
	    if (empty($genrecode)) {
	        $genrecode = '4m';
	    }
	    $this->db->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like('Genre', ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	
	    $this->load->library('pagination');
	
	    // 分页设置
	    $config['base_url']       = site_url('welcome/homegenreonline/'.$genrecode.'/page/'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(5); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	
	    $this->db->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like('Genre', ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	     
	     
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	
	
	     
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('avmoohomeonline' ,$data);
	}
	
	public function javgenreol()
	{
	
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    $genrecode = $this->uri->segment(3);
	    if (empty($genrecode)) {
	        $genrecode = '4m';
	    }
	     
	    $this->load->library('pagination');
	
	    // 分页设置
	    $config['base_url']       = site_url('welcome/javgenreol/'.$genrecode.'/page/'); //url地址
	    //$config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    
	    $send='?';
	    if(isset($_GET['hd'])){
	        $t=(int)$_GET['hd'];
	        $this->db->where('have_hd',$t);
	        $send.="hd=$t";
	    }
	    if(isset($_GET['mg'])){
	        $t=(int)$_GET['mg'];
	        $this->db->where('have_mg',$t);
	        $send.="&mg=$t";
	    }
	    if(isset($_GET['file'])){
	        $t=(int)$_GET['file'];
	        $this->db->where('have_file',$t);
	        $send.="&file=$t";
	    }
	    if(isset($_GET['sub'])){
	        $t=(int)$_GET['sub'];
	        $this->db->where('have_sub',$t);
	        $send.="&sub=$t";
	    }
	    $config['base_url']       = site_url('welcome/'.__FUNCTION__.'/'.$genrecode.'/'.$send);
	    $config['page_query_string'] = TRUE;
	    $page =@(int)$_GET['per_page'];
	    
	    
	
	    // 数据库查询(假设已经装载了数据库类)
	    //$page =(int)$this->uri->segment(5); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	
	    $this->db->group_start()->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like('Genre', ','.$genrecode.',', 'both')->group_end();  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	    $db = clone($this->db);
	    $config['total_rows']     =$db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    	  
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	
	    $this->pagination->initialize($config);
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	//var_dump($this->db->last_query());die;
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('javbushomeol' ,$data);
	}
	public function homeonlinestar()
	{
	
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    $genrecode = $this->uri->segment(3);
	    if (empty($genrecode)) {
	        $genrecode = '4m';
	    }
	    $likeid='JAV_Idols';
	    $this->db->like($likeid, ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like($likeid, $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like($likeid, ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	    $this->db->or_where($likeid,$genrecode);
	    $this->load->library('pagination');
	
	    // 分页设置
	    $config['base_url']       = site_url('welcome/homeonlinestar/'.$genrecode.'/page/'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(5); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	
	    $this->db->like($likeid, ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like($likeid, $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like($likeid, ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	    $this->db->or_where($likeid,$genrecode);
	
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	
	    
	     if ($page==1 ||$page==0) {
	         $res_star = $this->db->select('*')->where('star_code_36',$genrecode)->get('jav_avmoo_star_name')->result_array();
	          
	       $data['res_star']=$res_star[0];
	   }
	
	
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('avmoohomeonline' ,$data);
	}
	public function javolstar()
	{
	   // var_dump($_GET);die;
	
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    $genrecode = $this->uri->segment(3);
	    if (empty($genrecode)) {
	        $genrecode = '4m';
	    }
	    $likeid='JAV_Idols';
	    //$this->db->like($likeid, ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    //$this->db->or_like($likeid, $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	   // $this->db->or_like($likeid, ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	   // $this->db->or_where($likeid,$genrecode);
	    
	    $this->load->library('pagination');
	
	    // 分页设置
	    //$config['base_url']       = site_url('welcome/javolstar/'.$genrecode.'/page/'); //url地址
	    //$config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	    $config['num_links'] = 8;
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	
	    
	    $send='?';
	    if(isset($_GET['hd'])){
	        $t=(int)$_GET['hd'];
	        $this->db->where('have_hd',$t);
	        $send.="hd=$t";
	    }
	    if(isset($_GET['mg'])){
	        $t=(int)$_GET['mg'];
	        $this->db->where('have_mg',$t);
	        $send.="&mg=$t";
	    }
	    if(isset($_GET['file'])){
	        $t=(int)$_GET['file'];
	        $this->db->where('have_file',$t);
	        $send.="&file=$t";
	    }
	    if(isset($_GET['sub'])){
	        $t=(int)$_GET['sub'];
	        $this->db->where('have_sub',$t);
	        $send.="&sub=$t";
	    }
	    $config['base_url']       = site_url('welcome/'.__FUNCTION__.'/'.$genrecode.'/'.$send);
	    $config['page_query_string'] = TRUE;
	    $page =@(int)$_GET['per_page'];
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    
	
	    // 数据库查询(假设已经装载了数据库类)
	    //$page =(int)$this->uri->segment(5); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	
	    $this->db->group_start()->like($likeid, ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like($likeid, $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like($likeid, ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	    $this->db->or_where($likeid,$genrecode)->group_end();
	
	    $db = clone($this->db);
	    $config['total_rows']     = $db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    	  
	    
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	
	     
	    if ($page==1 ||$page==0) {
	        $res_star = $this->db->select('*')->where('star_code_36',$genrecode)->get('jav_avmoo_star_name')->result_array();
	         
	        $data['res_star']=$res_star[0];
	    }
	
	    $this->pagination->initialize($config);
	    $data['page_list'] = $this->pagination->create_links();
	
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('javbushomeol' ,$data);
	}
	public function homegenre()
	{
	     
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	    $genrecode = $this->uri->segment(3);
	    if (empty($genrecode)) {
	        $genrecode = '4m';
	    }
	    $this->db->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like('Genre', ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	     
	    $this->load->library('pagination');
	     
	    // 分页设置
	    $config['base_url']       = site_url('welcome/homegenre/'.$genrecode); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	
	
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	     
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	     
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(4); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	     
	    $this->db->like('Genre', ','.$genrecode, 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
	    $this->db->or_like('Genre', $genrecode.',', 'after'); // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
	    $this->db->or_like('Genre', ','.$genrecode.',', 'both');  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
	    
	    
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	     
	     
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    $arr_pic  = array();
	    foreach ($data['list'] as $key=> $value) {
	        $imgpath = ''.$value['movie_pic_cover'];
	        //$arr_pic[]= $filepath;
	
	        $t_path = '/var/www/html/jav/jav_star/avmoopic/' ;
	        $filepath = $t_path.$imgpath;
	        if (!is_file($filepath)) {
	            $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$value['censored_id']."'");
	
	            if (is_file($t_path.$query->row()->movie_pic_cover)) {
	                $data['list'][$key]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	            }else{
	                $arr_pic[]=$imgpath;
	            }
	        }else{
	
	        }
	    }
	    //$arr_pic = array_filter($arr_pic, "self::delindirfile");
	    //$arr_pic = array_values($arr_pic);
	     
	    $url_host ='https://pics.dmm.co.jp/';
	
	    $arr_pic_2 = array();
	    //var_dump($arr_pic);
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	             
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    $arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    //var_dump($arr_pic);die;
	
	    $arr_pic = array();
	    foreach ($arr_pic_2 as $key => $value) {
	        ;
	        // $filepath = '/var/www/html/jav/jav_star/avmoopic/' .$value;
	        foreach ($data['list']  as $keyl => $valuel) {
	            if ($key==$valuel['movie_pic_cover']) {
	                $data['list'][$keyl]['movie_pic_cover'] = $value;
	
	                $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$valuel['censored_id']."'");
	
	                $data['list'][$keyl]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	
	                $filepath=  '/var/www/html/jav/jav_star/avmoopic/' .$query->row()->movie_pic_cover ;
	                // var_dump($row);die;
	                break;
	            }
	        }
	        if (!is_file($filepath)) {
	            $arr_pic[] = $query->row()->movie_pic_cover;
	        }else{
	             
	        }
	    }
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    //$arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	     
	    //$date['value'] = $res[0];
	    // $this->load->view('ephp' ,$data);
	    $this->load->view('avmoohome' ,$data);
	}
	public function indexx()
	{
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    //$res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	     
	     
	     
	    $this->load->library('pagination');
	     
	    // 分页设置
	    $config['base_url']       = site_url('welcome/index'); //url地址
	    $config['total_rows']     = $this->db->like('Genre', '4m')->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 30; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	    
	    $config['full_tag_open'] = '<ul class="pagination pagination-lg mtb-0">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_links'] = 8;$config['num_tag_close'] = '</li>';
	    
	    
	    $config['attributes'] = array('name' => 'numbar');
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	     
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	     
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(3); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	    $this->db->like('Genre', '4m');
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	     
	     
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    $arr_pic  = array();
	    foreach ($data['list'] as $key=> $value) {
	        $imgpath = ''.$value['movie_pic_cover'];
	        //$arr_pic[]= $filepath;
	        
	        $t_path = '/var/www/html/jav/jav_star/avmoopic/' ;
	        $filepath = $t_path.$imgpath;
	        if (!is_file($filepath)) {
	            $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$value['censored_id']."'");
	            
	            if (is_file($t_path.$query->row()->movie_pic_cover)) {
	                $data['list'][$key]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	            }else{
	                $arr_pic[]=$imgpath;
	            } 
	        }else{
	            
	        }
	    }
	    //$arr_pic = array_filter($arr_pic, "self::delindirfile");
	    //$arr_pic = array_values($arr_pic);
	     
	    $url_host ='https://pics.dmm.co.jp/';
	    
	    $arr_pic_2 = array();
	    //var_dump($arr_pic); 
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	             
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    $arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    //var_dump($arr_pic);die;
	    
	    $arr_pic = array();
	    foreach ($arr_pic_2 as $key => $value) {
	        ;
	       // $filepath = '/var/www/html/jav/jav_star/avmoopic/' .$value;
	        foreach ($data['list']  as $keyl => $valuel) {
	            if ($key==$valuel['movie_pic_cover']) {
	                $data['list'][$keyl]['movie_pic_cover'] = $value;
	                
	                $query = $this->db->query("select movie_pic_cover from jav_javlib_movie_new where censored_id = "."'".$valuel['censored_id']."'");
	                
	                $data['list'][$keyl]['movie_pic_cover'] = $query->row()->movie_pic_cover ;
	                
	                $filepath=  '/var/www/html/jav/jav_star/avmoopic/' .$query->row()->movie_pic_cover ;
	               // var_dump($row);die;
	                break;
	            }
	        }
	        if (!is_file($filepath)) {
	            $arr_pic[] = $query->row()->movie_pic_cover;
	        }else{
	             
	        }
	    }
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	    
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    //$arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    // die;999
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	     
	    //$date['value'] = $res[0];
	    $this->load->view('ephp' ,$data);
	}
	
	public static function delindirfile($filepath)
	{
	    // $p_url = parse_url($value);
	    $filepath = '/var/www/html/jav/jav_star/avmoopic/' .$filepath;
	    if (is_file($filepath)) {
	        return false;
	    }
	    return true;
	}
	public static function request_avmo_img( $url)
	{
	    $ch = self::set_imgfile_ch_dmm($url);
	    $tmp_result = curl_exec($ch);
	    //$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    $url_host ='https://pics.dmm.co.jp/';
	    // $tmp_result =curl_multi_getcontent($done['handle']);
	    //$http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	    $info = curl_getinfo($ch);
	    // echo  "code=$http_code*******".str_replace($url_host,'',$info['url'])."\n";
	
	    //echo "\n<br>curl_multi" . '访问 ' . $info['url'] . '--- http_code :' . $http_code . "--\n";
	    //                 $retry = $static_retry;
	    //                 while ($http_code != 200 && $retry --) {
	    //                     $tmp_result = curl_multi_getcontent($done['handle']);
	    //                     $http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	    //                     echo 'FR:'.str_replace($url_host,'',$info['url'])."=$http_code";
	    //                     // echo "\n<br>curl_multi" . '重新访问 ' . $info['url'] . '--- http_code :' . $http_code . "--\n";
	    //                     // echo "\n<br>curl_multi".'重新访问 http_code :'.$http_code."--\n";
	    //                 }
	
	
	
	    $dbimg_path = str_replace($url_host,'',$info['url']);
	    $http_code = $info['http_code'];
	    echo $http_code.'***************5555555-----------'.$info['url'];//https://pics.dmm.co.jp/digital/video/49cadv00443/49cadv00443pl.jpg
	    if ($http_code==200) {
	        //                                      $retry = 6;//$static_retry;
	        //                                      while ( ('ffd9' != bin2hex(substr($tmp_result,-2)) ) && $retry --) {
	        //                                          $tmp_result = request_avmo_img($info['url']) ;//curl_multi_getcontent($done['handle']);
	        //                                          $http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	        //                                          echo  "R:". bin2hex(substr($tmp_result,-2))."=$http_code]";
	        //                                      }
	
	        //                  if (('ffd9' != bin2hex(substr($tmp_result,-2)) )) {
	        //                      $tmp_result =  request_avmo_img($info['url']) ;//curl_multi_getcontent($done['handle']);
	        //                  }
	        if ( 'ffd9' == bin2hex(substr($tmp_result,-2)) ) {
	            ;
	            $filepath = '/var/www/html/jav/jav_star/avmoopic/' . $dbimg_path;
	            $filedir = '/var/www/html/jav/jav_star/avmoopic/' . dirname($dbimg_path);
	            if (! is_dir($filedir)) {
	                mkdir($filedir, 0777, true);
	            }
	            //chmod($filedir, 0777);
	            file_put_contents($filepath, $tmp_result);
	             
	            //$redis->zadd('arldy_fileimgurls', 1,  $dbimg_path);
	            // $redis->zadd('arldy_fileimgurls_temp', 1,  $dbimg_path);
	            echo "成功";// 200 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	            /*
	             if (is_file($filepath)) {
	             $u_i++;
	             $redis->zadd('arldy_fileimgurls', 1,  $dbimg_path);
	             $redis->zadd('arldy_fileimgurls_temp', 1,  $dbimg_path);
	
	             echo " 已存在 成功 200 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	             // $redis->zadd('avmoo_db_img_notin_arldy_fileimgurls', 1, $f_code);
	             }else {
	
	             }*/
	             
	        }else{
	            //$redis->zadd('avmoo_fail_imgurls_200_not_ffd9', 1,$dbimg_path);
	            // $f_i++;
	            // file_put_contents('jpg_fail.txt', $tmp_result);
	            echo "不完整***200--0  ";//@@$i@$len/  %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;;
	            //die;
	        }
	    }//elseif ($http_code==200)
	    curl_close($ch);
	    return  $http_code;
	}
	public static function set_imgfile_ch_dmm($url)
	{
	    $ch = curl_init();
	    $cki ='';// "dtmd=1528429570; back_url=ShNVVxJXDR0VSlVdR1cPW05YGVVZXVkIU1pWBEJRAAMXTg__;  Aff_R=1; cklg=en; ckcy=1; dmm_service=BFsDAx1FWwYCR1xXXVlEDABfBwxLSl4NWEBECUARFQsrWk1KXABbEFsKXFVcWEQMAF8HDEtKXg1YQEQJQBEVCxZbBwNERABcUwxfXxENG0RbUwwUQ1wFSwEKFV1TXwMKHhIKAFwUEldZF1JQQEIUFVoWDAcCA0ZzCyAdAGcWf2UCDm8bXUVbBwJHXVFeXxIVWgwMBQACFwNWWBUQWwBAEl4SCg5cFBFTWw5QX1YUXURbUQwUQ1YWTUBZRFwFXxVCBA9bUAhRQwlFGA__";
	
	    // echo "\ncooki :".$cki."\n";
	    // 设置浏览器的特定header
	
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Host: pics.dmm.co.jp',
	        'User-Agent: Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
	        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
	        'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.6,en;q=0.4,de-DE;q=0.2',
	        'Accept-Encoding: gzip, deflate',
	        //'Cookie: dtmd=1528429570; back_url=ShNVVxJXDR0VSlVdR1cPW05YGVVZXVkIU1pWBEJRAAMXTg__; guest_id=VhtRQFFHAEFIA1oI; Aff_R=1; cklg=en; ckcy=1; dmm_service=BFsDAx1FWwYCR1xXXVlEDABfBwxLSl4NWEBECUARFQsrWk1KXABbEFsKXFVcWEQMAF8HDEtKXg1YQEQJQBEVCxZbBwNERABcUwxfXxENG0RbUwwUQ1wFSwEKFV1TXwMKHhIKAFwUEldZF1JQQEIUFVoWDAcCA0ZzCyAdAGcWf2UCDm8bXUVbBwJHXVFeXxIVWgwMBQACFwNWWBUQWwBAEl4SCg5cFBFTWw5QX1YUXURbUQwUQ1YWTUBZRFwFXxVCBA9bUAhRQwlFGA__',
	        //'Connection: keep-alive',
	        //'If-Modified-Since: Mon, 08 Aug 2016 05:44:00 GMT',
	        //'If-None-Match: "9d7ac2fa-f954-53988e72ce098"',
	        //'Cache-Control: max-age=0'
	    ));
	    curl_setopt($ch, CURLOPT_COOKIE, $cki);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)');
	    // 在HTTP请求头中"Referer: "的内容。
	    curl_setopt($ch, CURLOPT_REFERER, "https://pics.dmm.co.jp");
	    curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 302redirect
	    // 针对https的设置
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	    return $ch;
	}
	public static function getMulti_avmo_img_retryfails($arr_pic)
	{
	     
	    $static_max_size = 8;
	     
	    // $static_retry = 5;//同一个ch重新访问
	     
	    //$static_retry_fail = 4;//重新获取失败列表次数
	     
	    $static_waittime = 120;
	    /*
	     $failurlMap2save404 = 'avmoo_fail_imgurls_404';
	     $failurlMap2save302 = 'avmoo_fail_imgurls_302';
	     $failurlMap2savenot404 = 'avmoo_fail_imgurls_not404'; */
	    //$url_host ='https://jp.netcdn.space/';
	    $url_host ='https://pics.dmm.co.jp/';
	    //$ch_arr = array();
	    //$text = array();
	    //$redis = PRedis::getInstance();
	    //$len = $redis->zCount($failurlMap2get,1, 1);//base_convert('5o0d',36,10);
	    $len = count($arr_pic);
	    if ($len==0) {
	        return  false;
	    }
	    $max_size = ($len > $static_max_size) ? $static_max_size : $len;
	    //$requestMap = array();
	    $u_i = 0;
	    $f_i = 0;
	    $f_404 = 0;
	    $mh = curl_multi_init();
	    $move_i = 0;
	    for ($i =0+ $move_i; $i < $max_size +$move_i; $i ++) {
	        //echo $i;
	
	        $f_code = $arr_pic[$i];
	        $ch = self::set_imgfile_ch_dmm($url_host.$f_code);
	        curl_multi_add_handle($mh, $ch);
	
	    }
	
	    do {
	        while (($cme = curl_multi_exec($mh, $active)) == CURLM_CALL_MULTI_PERFORM);
	
	        if ($cme != CURLM_OK) {
	            //echo "\n".'$cme != CURLM_OK'."\n";
	            break;
	        }
	        while ($done = curl_multi_info_read($mh)) {
	            //$info = curl_getinfo($done['handle']);
	
	            $tmp_result =curl_multi_getcontent($done['handle']);
	            //$http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	            $info = curl_getinfo($done['handle']);
	            // echo  "code=$http_code*******".str_replace($url_host,'',$info['url'])."\n";
	
	            //echo "\n<br>curl_multi" . '访问 ' . $info['url'] . '--- http_code :' . $http_code . "--\n";
	            //                 $retry = $static_retry;
	            //                 while ($http_code != 200 && $retry --) {
	            //                     $tmp_result = curl_multi_getcontent($done['handle']);
	            //                     $http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	            //                     echo 'FR:'.str_replace($url_host,'',$info['url'])."=$http_code";
	            //                     // echo "\n<br>curl_multi" . '重新访问 ' . $info['url'] . '--- http_code :' . $http_code . "--\n";
	            //                     // echo "\n<br>curl_multi".'重新访问 http_code :'.$http_code."--\n";
	            //                 }
	
	
	
	            $dbimg_path = str_replace($url_host,'',$info['url']);
	            $http_code = $info['http_code'];
	            if ($http_code==200) {
	                //                                      $retry = 6;//$static_retry;
	                //                                      while ( ('ffd9' != bin2hex(substr($tmp_result,-2)) ) && $retry --) {
	                //                                          $tmp_result = request_avmo_img($info['url']) ;//curl_multi_getcontent($done['handle']);
	                //                                          $http_code = curl_getinfo($done['handle'], CURLINFO_HTTP_CODE);
	                //                                          echo  "R:". bin2hex(substr($tmp_result,-2))."=$http_code]";
	                //                                      }
	
	                //                  if (('ffd9' != bin2hex(substr($tmp_result,-2)) )) {
	                //                      $tmp_result =  request_avmo_img($info['url']) ;//curl_multi_getcontent($done['handle']);
	                //                  }
	                if ( 'ffd9' == bin2hex(substr($tmp_result,-2)) ) {
	                    ;
	                    $filepath = '/var/www/html/jav/jav_star/avmoopic/' . $dbimg_path;
	                    $filedir = '/var/www/html/jav/jav_star/avmoopic/' . dirname($dbimg_path);
	                    if (! is_dir($filedir)) {
	                        mkdir($filedir, 0777, true);
	                    }
	                    //chmod($filedir, 0777);
	                    file_put_contents($filepath, $tmp_result);
	
	                    $u_i++;
	                    //$redis->zadd('arldy_fileimgurls', 1,  $dbimg_path);
	                    // $redis->zadd('arldy_fileimgurls_temp', 1,  $dbimg_path);
	                    echo "成功 200 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	                    /*
	                     if (is_file($filepath)) {
	                     $u_i++;
	                     $redis->zadd('arldy_fileimgurls', 1,  $dbimg_path);
	                     $redis->zadd('arldy_fileimgurls_temp', 1,  $dbimg_path);
	
	                     echo " 已存在 成功 200 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	                     // $redis->zadd('avmoo_db_img_notin_arldy_fileimgurls', 1, $f_code);
	                     }else {
	
	                     }*/
	                     
	                }else{
	                    //$redis->zadd('avmoo_fail_imgurls_200_not_ffd9', 1,$dbimg_path);
	                    $f_i++;
	                    // file_put_contents('jpg_fail.txt', $tmp_result);
	                    echo "不完整***200--0  @@$i@$len/  %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;;
	                    //die;
	                }
	            }else{
	                 
	                if ($http_code==302) {
	                    //$redis->zadd($failurlMap2save302, 1,$dbimg_path );
	                    //$redis->zadd($failurlMap2save302.'_temp', 1,  $dbimg_path);
	                    $f_404++;
	                    // echo "重定向失败  302 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	                }elseif ($http_code==404) {
	                    // $redis->zadd($failurlMap2save404, 1,$dbimg_path );
	                    $f_404++;
	                    // echo "失败  404 @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	                }else{
	                     
	                    //$redis->zadd($failurlMap2savenot404, 1, str_replace($url_host,'',$info['url']));
	                    $f_i++;
	                    //  echo "失败状态  **000**：$http_code , @@$i@$len/ %u_i:".$u_i.'--$f_i:'.$f_i.'--$f_404:'.$f_404."%******".$dbimg_path;
	                }
	            }
	
	            curl_close($done['handle']);
	            curl_multi_remove_handle($mh, $done['handle']);
	             
	            if ($i < $len) {
	                $f_code = $arr_pic[$i];
	                //$f_code = $redis->zRange($failurlMap2get,$i, $i)[0];
	                $ch = self::set_imgfile_ch_dmm($url_host.$f_code);
	                curl_multi_add_handle($mh, $ch);
	
	                $i++;
	
	            }
	        }
	
	        if ($active)
	            curl_multi_select($mh, $static_waittime);
	    } while ($active);
	    curl_multi_close($mh);
	
	}
	public function index2()
	{
	    // mkdir('/var/www/test666', 0777, true);die;
	    $this->load->database();
	    $res = $this->db->select('*')->where('censored_id','PGD-903')->get('jav_avmoo')->result_array();
	     
	     
	     
	    $this->load->library('pagination');
	     
	    // 分页设置
	    $config['base_url']       = site_url('welcome/index2'); //url地址
	    $config['total_rows']     = $this->db->count_all_results('jav_avmoo'); //总数据量（一般从数据库读取，可以使用$this->db->count_all_results('jav_avmoo');）
	    $config['per_page']       = 10; // 每页显示数量
	    $config['use_page_numbers'] = TRUE; // 使用页码方式而非偏移量方式传值
	     
	    //$config['next_tag_open'] = '<a class = "next_pag">';//下一页链接的起始标签。
	     
	    // $config['next_tag_close'] = '</a>';//下一页链接的结束标签。
	    // 执行分页类初始化
	    $this->pagination->initialize($config);
	     
	    // 数据库查询(假设已经装载了数据库类)
	    $page =(int)$this->uri->segment(3); // $this->input->get('cur_page'); // 获取页码
	    $offset = $page == false?0:($config['per_page'] * ($page - 1)); // 计算偏移量
	    $this->db->like('Genre', '4m');
	    $this->db->order_by('release_date', 'DESC');
	    $this->db->limit($config['per_page'], $offset); // limit(每页显示数量，偏移量)
	    $data['list'] = $this->db->get('jav_avmoo')->result_array(); // 获取数据库里的数据
	     
	     
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    //$movie_pic_covers = array_column($data['list'], 'movie_pic_cover');
	    $arr_pic  = array();
	    foreach ($data['list'] as  $value) {
	        $filepath = ''.$value['movie_pic_cover'];
	        $arr_pic[]= $filepath;
	        if (!empty($value['sample_dmm'])) {
	            $a = explode('@[',  $value['sample_dmm']);
	            foreach ($a as $vimg) {
	                $filepath = 'digital/'.$vimg;
	                $arr_pic[]= $filepath;
	            }
	        }
	         
	    }
	    $arr_pic = array_filter($arr_pic, "self::delindirfile");
	    $arr_pic = array_values($arr_pic);
	    //echo getenv('APACHE_RUN_USER');die;
	    /*   do{
	     self::getMulti_avmo_img_retryfails($arr_pic);
	     $arr_pic = array_filter($arr_pic, "self::delindirfile");
	     $arr_pic = array_values($arr_pic);
	     $tt++;//die;
	     }
	    while (count($arr_pic)>1 && $tt<5)  ; */
	    // 	    var_dump($arr_pic); echo count($arr_pic);
	    // 	    die;
	    $arr_pic_2 = array();
	    $url_host ='https://pics.dmm.co.jp/';
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	             
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    $arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	     
	     
	    // die;
	    //var_dump($arr_pic);
	    //die;
	    //var_dump($data['list']);die;
	    // 生成分页链接
	    $data['page_list'] = $this->pagination->create_links();
	     
	    // 输出模板
	    //  $this->load->view('album_index', $data);
	     
	     
	     
	     
	    //echo getcwd() ;
	    //  var_dump($res);
	    // 		$this->load->view('welcome_message',$res[0]);
	    // 	    $this->load->view('avmoo',$res[0]);
	    /*
	     *
	     *
	     *
	     *   array(1) { [0]=> array(13) {
	     *   ["code_36"]=> string(4) "5o76"
	     *    ["censored_id"]=> string(7)
	     *    "PGD-903"
	     *    ["movie_title"]=>
	     *    string(78) "PGD-903 おチ○ポとろとろノーハンドフェラチオ 佐々木あき" ["movie_pic_cover"]=> string(37) "digital/video/pgd00903/pgd00903pl.jpg"
	     *    ["release_date"]=> string(10) "2016-10-02"
	     *    ["movie_length"]=> string(3) "120"
	     *    ["Director"]=> string(0) ""
	     *    ["Studio"]=> string(2) "i6"
	     *    ["Label"]=> string(3) "1mi"
	     *    ["Series"]=> string(0) ""
	     *    ["Genre"]=> string(21) "f,g,10,1o,29,31,4m,4o"
	     *     ["JAV_Idols"]=> string(3) "p8y"
	    *     ["sample_dmm"]=> string(329) "video/pgd00903/pgd00903jp-1.jpg@[video/pgd00903/pgd00903jp-2.jpg@[video/pgd00903/pgd00903jp-3.jpg@[video/pgd00903/pgd00903jp-4.jpg@[video/pgd00903/pgd00903jp-5.jpg@[video/pgd00903/pgd00903jp-6.jpg@[video/pgd00903/pgd00903jp-7.jpg@[video/pgd00903/pgd00903jp-8.jpg@[video/pgd00903/pgd00903jp-9.jpg@[video/pgd00903/pgd00903jp-10.jpg" } } */
	    $date['value'] = $res[0];
	    $this->load->view('avmoo' ,$data);
	}
	public function avmoosg()
	{
	    // mkdir('/var/www/test666', 0777, true);die;99
	    $this->load->database();
	    $page =$this->uri->segment(3);//die;
	    if (empty($page)) {
	        $page ='PGD-903';
	    }
	    $res = $this->db->select('*')->where('censored_id',$page)->get('jav_avmoo')->result_array();
	    if (empty($res)) {
	        die;
	    }
	    $info= $res[0];
	    $arr_star = explode(',', $info['JAV_Idols']);
	    $res_star = $this->db->select('*')->where_in('star_code_36', $arr_star)->get('jav_avmoo_star_name')->result_array();
	     
	    $arr_genre_code = explode(',', $info['Genre']);
	    $res_genre = $this->db->select('*')->where_in('genre_code', $arr_genre_code)->get('jav_avmoo_genre_name')->result_array();
	     
	    //------------下载图片
	    $value=$res[0];
	    $filepath = ''.$value['movie_pic_cover'];
	    $arr_pic[]= $filepath;
	    if (!empty($value['sample_dmm'])) {
	        $a = explode('@[',  $value['sample_dmm']);
	        foreach ($a as $vimg) {
	            $filepath = 'digital/'.$vimg;
	            $arr_pic[]= $filepath;
	        }
	    }
	     
	    $arr_pic = array_filter($arr_pic, "self::delindirfile");
	    $arr_pic = array_values($arr_pic);
	    $arr_pic_2 = array();
	    $url_host ='https://pics.dmm.co.jp/';
	    if (!empty($arr_pic)) {
	        $tt = 0;
	        do{
	             
	            foreach ($arr_pic as  $key => $value) {
	                $code = self::request_avmo_img($url_host.$value);
	                if ($code==302) {
	                    $arr_pic_2[$value] = str_replace('digital/video', 'mono/movie/adult', $value);
	                    unset($arr_pic[$key]);
	                }
	            }
	            $arr_pic = array_filter($arr_pic, "self::delindirfile");
	            $arr_pic = array_values($arr_pic);
	            $tt++;
	        }
	        while (count($arr_pic)>0 && $tt<5)  ;
	        echo count($arr_pic);
	    }
	    //------------下载图片
	    $data['res_star'] = $res_star;
	    $data['res_genre'] = $res_genre;
	    $data['value'] = $res[0];
	    $this->load->view('avmoosg' ,$data);
	}
	
	public function avmoosgonline()
	{
	    // mkdir('/var/www/test666', 0777, true);die;99
	    $this->load->database();
	    $page =$this->uri->segment(3);//die;
	    if (empty($page)) {
	        $page ='PGD-903';
	    }
	    $res = $this->db->select('*')->where('censored_id',$page)->get('jav_avmoo')->result_array();
	    if (empty($res)) {
	        die;
	    }
	    $info= $res[0];
	    $arr_star = explode(',', $info['JAV_Idols']);
	     
	     
	    $res_star = $this->db->select('*')->where_in('star_code_36', $arr_star)->get('jav_avmoo_star_name')->result_array();
	
	    $arr_genre_code = explode(',', $info['Genre']);
	    $res_genre = $this->db->select('*')->where_in('genre_code', $arr_genre_code)->get('jav_avmoo_genre_name')->result_array();
	
	
	    $data['res_star'] = $res_star;
	    $data['res_genre'] = $res_genre;
	    $data['value'] = $res[0];
	    $this->load->view('avmoosgonline' ,$data);
	}
}
