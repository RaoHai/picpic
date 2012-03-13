<?php

	require_once("controller.base.class.php");
	class message extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
            
		}
		
		public function _index()//自定义你的action方法
		{
           $this->_takemessage(23,4,'1234567','wwww');
		    //var_dump($;this->_showinformation($_SESSION['USERID']));	
		}		
		
		//发消息
		public function _takemessage($senderID,$reciverID,$messageText,$title)
		{
			$this->model->New(array($senderID,$reciverID,$messageText,0,0,$title,0,time()));
		}
	    public function _send()
        {
            $reciver = $_POST["reciverid"];
            $sendTo = new user();
            $sendTo->model->Get_NickName_By_NickName($reciver);
            $send = $sendTo->model->getresult();
            $sendToid=0;
            foreach($send as $id)
            {
                $sendToid = $id->UserId;
            }
            $this->_takemessage($_SESSION['USERID'],$sendToid,$_POST['msgcontext'],$_POST['msgtitle']);
            //var_dump($sendTo->model->getresult());
            //echo $reciver;
        }
		//浏览消息
		//返回所有message表中所有信息，readmark为1时为已读
		public function _getmessages($page=0)
		{
            $to = $_SESSION['USERID'];
			//$this->model->Get_By_reciverID($to);
            $this->model->Get('all',array("reciverid={$to}"),array($page*30,($page+1)*30),'MessageId DESC');
			$re=$this->model->getresult();
            $msgs="";
            foreach($re as $r)
            {   
                if($r->reciverDel==0)
                $msgs[] = $r;
            }
            echo json_encode($msgs);
			//return $re;
		
        }
        public function _delbyreciver($msgid)
        {
            $id = $_SESSION['USERID'];
           // $this->model->Del(array("MessageId={$msgid}","reciverId={$id}"));
            $this->model->Set(array("reciverDel"=>1),array("MessageId={$msgid}","reciverId={$id}"));
            header("Location:"."/user/message");

        }
        public function _getsendbox($page=0)
        {
           $to = $_SESSION['USERID'];
           $this->model->Get('all',array("senderId={$to}"),array($page*30,($page+1)*30));
           $re = $this->model->getresult();
           $msgs = "";
           foreach($re as $r)
           {
               $msgs[] = $r;
           }
            echo json_encode($msgs);
           //return $re;

        }
        public function _getunread()
        {
            $id = $_SESSION['USERID'];
            $timestap = $_SESSION['TIME'];
            //echo time()-$timestap;
            $re="";
            if(time()-$timestap>50)
            {
                $this->model->Get('count',array("reciverId={$id}","readMark=0"),array(0,100));
                $_SESSION['TIME']=time();
                $re  = $this->model->getresult();
                $_SESSION['UNREAD']=$re;
            }
            else $re = $_SESSION['UNREAD'];
            echo $re;
            return   $re;
                       //$this->model->Get
        }
	    public function _readmark($id)
        {
            $this->model->Set_readmark_By_MessageId($id,1);
        }
		//对消息的处理
		//当take=0时为删除发件的，take=1时已读标记,take=2时删除收件
		public function _take($take)
		{
			if($take==0)
			$this->model->Set_senderDel_By_senderID($_SESSION["USERID"],1);
			if($take==1)
			$this->model->Set_readmark_By_reciverID($_SESSION["USERID"],1);
			if($take==2)
			$this->model->Set_reciverDel_By_reciverID($_SESSION["USERID"],1);
		}
		
		//回复，输入邮件ID，返回发信人ID
		public function _recive($ID)
		{
			$this->model->Get_By_reciverID($to);
			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$reciver=$r->reciverID;
			}
			return $reciver;
		}
	}
?>
