<?php

class colsysConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{			
		$this->setWebDir($this->getRootDir().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'colsys');
	}
}
