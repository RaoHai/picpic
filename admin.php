<?php
	/*Upload.php*/
	require_once('index.php');
	session_start();
	
	$_SESSION["user"]=2;
	
	/* definition of class*/

	
	$result=$imgView->GetHead();
	/*check imggroup*/
	
	$result.= $imgGroupView->CheckImgGroup('2');
	$result.= "<form action='?action=new' method='post' ><input type='text' name='name' id='name' /><input type='submit' name='ok' id='ok' value='新建' /></form>";
	/*check action*/
	if($_GET["action"]=='new')
	{
		$GroupName=$_POST['name'];
		$time = date("Y-m-d H:i:s");
		$imgGroupView->CreateNewGroup($GroupName,1,$time,0,0);
	}
	$_SESSION['CurrentGroupId']=1;
	$result.=<<<EOD
	<div id="file-uploader1">		
		<noscript>			
			<p>请选择启用JavaScript以上传图片.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
    
    <script src="fileuploader.js" type="text/javascript"></script>
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader1'),
                action: 'upload.php',
                debug: true
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>    
EOD;
	echo $result;
	
?>
