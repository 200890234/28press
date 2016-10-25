<?php
class page 
{
 var $page_name="page";
 var $next_page='>';//Next
 var $pre_page='<';//Prev
 var $first_page='<<first';//first
 var $last_page='last>>';//last
 var $pre_bar='<<';//上一分页条
 var $next_bar='>>';//下一分页条
 var $format_left='';
 var $format_right='';
 var $page_webmode='';

 /**
  * private
  *
  */ 
 var $pagebarnum=25;//控制记录条的个数。
 var $totalpage=0;//总页数
 var $nowindex=1;//当前页
 var $url="";//url地址头
 var $offset=0;
 
 /**
  * constructor构造函数
  *
  * @param array $array['total'],$array['perpage'],$array['nowindex'],$array['url'],$array['ajax']...
  */
 function page($array)
 {
  if(is_array($array)){
     if(!array_key_exists('total',$array))$this->error(__FUNCTION__,'need a param of total');
     $total=intval($array['total']);
     $perpage=(array_key_exists('perpage',$array))?intval($array['perpage']):10;
     $nowindex=(array_key_exists('nowindex',$array))?intval($array['nowindex']):'';
     $url=(array_key_exists('url',$array))?$array['url']:'';
  }else{
     $total=$array;
     $perpage=10;
     $nowindex='';
     $url='';
  }
  if((!is_int($total))||($total<0))$this->error(__FUNCTION__,$total.' is not a positive integer!');
  if((!is_int($perpage))||($perpage<=0))$this->error(__FUNCTION__,$perpage.' is not a positive integer!');
  if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//设置pagename
  $this->_set_nowindex($nowindex);//设置当前页
  $this->_set_url($url);//设置链接地址
  $this->totalpage=ceil($total/$perpage);
  $this->total=$total;
  $this->offset=($this->nowindex-1)*$perpage;
 }
 /**
  * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
  *
  * @param string $var
  * @param string $value
  */
 function set($var,$value)
 {
  if(in_array($var,get_object_vars($this)))
     $this->$var=$value;
  else {
   $this->error(__FUNCTION__,$var." does not belong to PB_Page!");
  }
  
 }
 /**
  * 获取显示"Next"的代码
  * 
  * @param string $style
  * @return string
  */
 function next_page($style='',$nowindex_style='')
 {
  if($this->nowindex<$this->totalpage){
   return $this->_get_link($this->_get_url($this->nowindex+1),$this->next_page,$style);
  }
  return '<span class="'.$nowindex_style.'">'.$this->next_page.'</span>';
 }
 
 /**
  * 获取显示“Prev”的代码
  *
  * @param string $style
  * @return string
  */
 function pre_page($style='',$nowindex_style='')
 {
  if($this->nowindex>1){
   return $this->_get_link($this->_get_url($this->nowindex-1),$this->pre_page,$style);
  }
  return '<span class="'.$nowindex_style.'">'.$this->pre_page.'</span>';
 }
 
 /**
  * 获取显示“first”的代码
  *
  * @return string
  */
 function first_page($style='',$nowindex_style='')
 {
  if($this->nowindex==1){
      return '<span class="'.$nowindex_style.'">'.$this->first_page.'</span>';
  }
  return $this->_get_link($this->_get_url(1),$this->first_page,$style);
 }
 
 /**
  * 获取显示“last”的代码
  *
  * @return string
  */
 function last_page($style='',$nowindex_style='')
 {
  if($this->nowindex==$this->totalpage || $this->totalpage==0){
      return '<span class="'.$nowindex_style.'">'.$this->last_page.'</span>';
  }
  return $this->_get_link($this->_get_url($this->totalpage),$this->last_page,$style);
 }
 
 function nowbar($style='',$nowindex_style='')
 {
  $plus=ceil($this->pagebarnum/2);
  if($this->pagebarnum-$plus+$this->nowindex>$this->totalpage)$plus=($this->pagebarnum-$this->totalpage+$this->nowindex);
  $begin=$this->nowindex-$plus+1;
  $begin=($begin>=1)?$begin:1;
  $return='';
  for($i=$begin;$i<$begin+$this->pagebarnum;$i++)
  {
   if($i<=$this->totalpage){
    if($i!=$this->nowindex)
        $return.=$this->_get_text($this->_get_link($this->_get_url($i),$i,$style));
    else 
        $return.=$this->_get_text('<span class="'.$nowindex_style.'">'.$i.'</span>');
   }else{
    break;
   }
   $return.="\n";
  }
  unset($begin);
  return $return;
 }
 /**
  * 获取显示跳转按钮的代码
  *
  * @return string
  */
 function select()
 {
  $return='<select name="PB_Page_Select" onchange="self.location.href=\''.$this->url.'\'+this.options[this.selectedIndex].value ">';
  for($i=1;$i<=$this->totalpage;$i++)
  {
   if($i==$this->nowindex){
    $return.='<option value="'.$i.'" selected>'.$i.'</option>';
   }else{
    $return.='<option value="'.$i.'">'.$i.'</option>';
   }
  }
  unset($i);
  $return.='</select>';
  return $return;
 }
 
 /**
  * 获取mysql 语句中limit需要的值
  *
  * @return string
  */
 function offset()
 {
  return $this->offset;
 }
 
 /**
  * 控制分页显示风格（你可以增加相应的风格）
  *
  * @param int $mode
  * @return string
  */
 function show($mode=1,$style='',$nowindex_style='')
 {
  switch ($mode)
  {
   case '1':
    $this->next_page='Next';
    $this->pre_page='Prev';
	$this->first_page='first';
    $this->last_page='last';
    return $this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style).'　(current page：<span style="font-size:12pt;">'.$this->nowindex.'</span> total pages：<span style=" font-size:12pt;">'.$this->totalpage.'</span> total records：<span style=" font-size:12pt;">'.$this->total.'</span>条记录)';
    break;
   case '2':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='first';
    $this->last_page='last';
    return $this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style).'　第'.$this->select().'页　(current page：<span style=" font-size:12pt;">'.$this->nowindex.'</span> total pages：<span style=" font-size:12pt;">'.$this->totalpage.'</span> total records：<span style=" font-size:12pt;">'.$this->total.'</span>条记录)';
    break;
   case '3':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='first';
    $this->last_page='last';
    return $this->pre_page($style,$nowindex_style)." ".$this->nowbar($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style).'　(当前第<span style=" font-size:12pt;">'.$this->nowindex.'</span>页 共<span style=" font-size:12pt;">'.$this->totalpage.'</span>页 <span style=" font-size:12pt;">'.$this->total.'</span>条记录)';
    break;
   case '4':
    $this->next_page='Next';
    $this->pre_page='Prev';
    return $this->pre_page($style,$nowindex_style)." ".$this->nowbar($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style).'　第'.$this->select().'页　(当前第<span style=" font-size:12pt;">'.$this->nowindex.'</span>页 共<span style=" font-size:12pt;">'.$this->totalpage.'</span>页 <span style=" font-size:12pt;">'.$this->total.'</span>条记录)';
    break;
   case '5':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='First';
    $this->last_page='Last';
    //return "<span style=\"color:#B0F139;\">total records：".$this->total."&nbsp;&nbsp;current page：".$this->nowindex."/".$this->totalpage." ".$this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." </span><span style=\"color:white;\">".$this->nowbar($style,$nowindex_style)."</span><span style=\"color:#B0F139;\"> ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style)."</span>";
    return "<span style=\"color:#B0F139;\">".$this->first_page($style,$nowindex_style)."&nbsp;&nbsp;&nbsp; ".$this->pre_page($style,$nowindex_style)." </span>&nbsp;&nbsp;&nbsp;<span style=\"color:white;\">".$this->nowbar($style,$nowindex_style)."</span>&nbsp;&nbsp;<span style=\"color:#B0F139;\"> ".$this->next_page($style,$nowindex_style)." &nbsp;&nbsp;&nbsp;".$this->last_page($style,$nowindex_style)."</span>";
    break;
   case '6':
    $this->next_page='>';
    $this->pre_page='<';
    $this->first_page='<<';
    $this->last_page='>>';
    return $this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." ".$this->nowbar($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style);
    break;
  }
 }
/*----------------private function (私有方法)-----------------------------------------------------------*/
 /**
  * 设置url头地址
  * @param: String $url
  * @return boolean
  */
 function _set_url($url="")
 {
 if($this->page_webmode!="php"&&$url!=""){
 $this->url=$url;
 }
 else{
  if(!empty($url)){
      //手动设置
   $this->url=$url.((stristr($url,'?'))?'&':'?').$this->page_name."=";
  }else{
      //自动获取
   if(empty($_SERVER['QUERY_STRING'])){
       //不存在QUERY_STRING时
    $this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
   }else{
       //
    if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
        //地址存在页面参数
     $this->url=str_replace($this->page_name.'='.$this->nowindex,'',$_SERVER['REQUEST_URI']);
     $last=$this->url[strlen($this->url)-1];
     if($last=='?'||$last=='&'){
         $this->url.=$this->page_name."=";
     }else{
         $this->url.='&'.$this->page_name."=";
     }
    }else{
        //
     $this->url=$_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';
    }//end if    
   }//end if
  }//end if
 }
}
 
 /**
  * 设置当前页面
  *
  */
 function _set_nowindex($nowindex)
 {
  if(empty($nowindex)){
   //系统获取
   
   if(isset($_GET[$this->page_name])){
    $this->nowindex=intval($_GET[$this->page_name]);
   }
  }else{
      //手动设置
   $this->nowindex=intval($nowindex);
  }
 }
  
 /**
  * 为指定的页面返回地址值
  *
  * @param int $pageno
  * @return string $url
  */
 function _get_url($pageno=1)
 {
 if($this->page_webmode=="php"||$this->page_webmode==""){
  return $this->url.$pageno;
  }
 else{
  return $this->url.(($pageno==1)?"":"_".$pageno).".".$this->page_webmode;
  }
 }
 
 /**
  * 获取分页显示文字，比如说默认情况下_get_text('<a href="">1</a>')将返回[<a href="">1</a>]
  *
  * @param String $str
  * @return string $url
  */ 
 function _get_text($str)
 {
  return $this->format_left.$str.$this->format_right;
 }
 
 /**
   * 获取链接地址
 */
 function _get_link($url,$text,$style=''){
  $style=(empty($style))?'':'class="'.$style.'"';
   return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
 }
 /**
   * 出错处理方式
 */
 function error($function,$errormsg)
 {
     die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
 }
}
?>