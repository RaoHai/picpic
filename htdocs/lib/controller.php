<?php
class ControllerBase
{
	var $model;
	var $view;
	function ControllerBase()
	{
	}
	function & getview()
	{
	return $this->view;
	}
}
class ImgController extends ControllerBase
{
	
	function ImgController(& $dao)
	{
		$this->model = & new Imgs($dao);
		$this->view =& new ImgView($this->model);
	
	}
		

}
class ImgGroupCtrl extends ControllerBase
{
	function ImgGroupCtrl(& $dao)
	{
		$this->model = & new ImgGroup($dao);
		$this->view = & new ImgGroupView($this->model);
	}
}
?>
