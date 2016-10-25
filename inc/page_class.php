<?php
class page 
{
 var $page_name="page";
 var $next_page='>';//Next
 var $pre_page='<';//Prev
 var $first_page='<<first';//first
 var $last_page='last>>';//last
 var $pre_bar='<<';//��һ��ҳ��
 var $next_bar='>>';//��һ��ҳ��
 var $format_left='';
 var $format_right='';
 var $page_webmode='';

 /**
  * private
  *
  */ 
 var $pagebarnum=25;//���Ƽ�¼���ĸ�����
 var $totalpage=0;//��ҳ��
 var $nowindex=1;//��ǰҳ
 var $url="";//url��ַͷ
 var $offset=0;
 
 /**
  * constructor���캯��
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
  if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//����pagename
  $this->_set_nowindex($nowindex);//���õ�ǰҳ
  $this->_set_url($url);//�������ӵ�ַ
  $this->totalpage=ceil($total/$perpage);
  $this->total=$total;
  $this->offset=($this->nowindex-1)*$perpage;
 }
 /**
  * �趨����ָ����������ֵ������ı�������������࣬��throwһ��exception
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
  * ��ȡ��ʾ"Next"�Ĵ���
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
  * ��ȡ��ʾ��Prev���Ĵ���
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
  * ��ȡ��ʾ��first���Ĵ���
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
  * ��ȡ��ʾ��last���Ĵ���
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
  * ��ȡ��ʾ��ת��ť�Ĵ���
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
  * ��ȡmysql �����limit��Ҫ��ֵ
  *
  * @return string
  */
 function offset()
 {
  return $this->offset;
 }
 
 /**
  * ���Ʒ�ҳ��ʾ��������������Ӧ�ķ��
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
    return $this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style).'��(current page��<span style="font-size:12pt;">'.$this->nowindex.'</span> total pages��<span style=" font-size:12pt;">'.$this->totalpage.'</span> total records��<span style=" font-size:12pt;">'.$this->total.'</span>����¼)';
    break;
   case '2':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='first';
    $this->last_page='last';
    return $this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style).'����'.$this->select().'ҳ��(current page��<span style=" font-size:12pt;">'.$this->nowindex.'</span> total pages��<span style=" font-size:12pt;">'.$this->totalpage.'</span> total records��<span style=" font-size:12pt;">'.$this->total.'</span>����¼)';
    break;
   case '3':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='first';
    $this->last_page='last';
    return $this->pre_page($style,$nowindex_style)." ".$this->nowbar($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style).'��(��ǰ��<span style=" font-size:12pt;">'.$this->nowindex.'</span>ҳ ��<span style=" font-size:12pt;">'.$this->totalpage.'</span>ҳ <span style=" font-size:12pt;">'.$this->total.'</span>����¼)';
    break;
   case '4':
    $this->next_page='Next';
    $this->pre_page='Prev';
    return $this->pre_page($style,$nowindex_style)." ".$this->nowbar($style,$nowindex_style)." ".$this->next_page($style,$nowindex_style).'����'.$this->select().'ҳ��(��ǰ��<span style=" font-size:12pt;">'.$this->nowindex.'</span>ҳ ��<span style=" font-size:12pt;">'.$this->totalpage.'</span>ҳ <span style=" font-size:12pt;">'.$this->total.'</span>����¼)';
    break;
   case '5':
    $this->next_page='Next';
    $this->pre_page='Prev';
    $this->first_page='First';
    $this->last_page='Last';
    //return "<span style=\"color:#B0F139;\">total records��".$this->total."&nbsp;&nbsp;current page��".$this->nowindex."/".$this->totalpage." ".$this->first_page($style,$nowindex_style)." ".$this->pre_page($style,$nowindex_style)." </span><span style=\"color:white;\">".$this->nowbar($style,$nowindex_style)."</span><span style=\"color:#B0F139;\"> ".$this->next_page($style,$nowindex_style)." ".$this->last_page($style,$nowindex_style)."</span>";
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
/*----------------private function (˽�з���)-----------------------------------------------------------*/
 /**
  * ����urlͷ��ַ
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
      //�ֶ�����
   $this->url=$url.((stristr($url,'?'))?'&':'?').$this->page_name."=";
  }else{
      //�Զ���ȡ
   if(empty($_SERVER['QUERY_STRING'])){
       //������QUERY_STRINGʱ
    $this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
   }else{
       //
    if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
        //��ַ����ҳ�����
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
  * ���õ�ǰҳ��
  *
  */
 function _set_nowindex($nowindex)
 {
  if(empty($nowindex)){
   //ϵͳ��ȡ
   
   if(isset($_GET[$this->page_name])){
    $this->nowindex=intval($_GET[$this->page_name]);
   }
  }else{
      //�ֶ�����
   $this->nowindex=intval($nowindex);
  }
 }
  
 /**
  * Ϊָ����ҳ�淵�ص�ֵַ
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
  * ��ȡ��ҳ��ʾ���֣�����˵Ĭ�������_get_text('<a href="">1</a>')������[<a href="">1</a>]
  *
  * @param String $str
  * @return string $url
  */ 
 function _get_text($str)
 {
  return $this->format_left.$str.$this->format_right;
 }
 
 /**
   * ��ȡ���ӵ�ַ
 */
 function _get_link($url,$text,$style=''){
  $style=(empty($style))?'':'class="'.$style.'"';
   return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
 }
 /**
   * ������ʽ
 */
 function error($function,$errormsg)
 {
     die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
 }
}
?>