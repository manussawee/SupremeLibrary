<?php

/*
Supreme Library v1.0
*/

class SupremeClass {

	public function pushLog($log) {

		$this->lst_log = $log;
		
		if(isset($this->log))
			$this->log .= '<br>'.$log;
		else
			$this->log = $log;

	}

	public function compile() {

		$log_chk = shell_exec('g++ -o check.out '.$this->chk.' 2>&1');

		$this->pushLog($log_chk);

		$log = shell_exec('g++ -o '.$this->exct.' '.$this->code.' 2>&1');

		$this->pushLog($log);
		$this->cmp_msg = $log;

		return ($log == '') and ($log_chk == '');
	}

	public function execute() {

		shell_exec('
				LANG=en_US.UTF-8
				LC_CTYPE="en_US.UTF-8"
				LC_NUMERIC="en_US.UTF-8"
				LC_TIME="en_US.UTF-8"
				LC_COLLATE="en_US.UTF-8"
				LC_MONETARY="en_US.UTF-8"
				LC_MESSAGES="en_US.UTF-8"
				LC_PAPER="en_US.UTF-8"
				LC_NAME="en_US.UTF-8"
				LC_ADDRESS="en_US.UTF-8"
				LC_TELEPHONE="en_US.UTF-8"
				LC_MEASUREMENT="en_US.UTF-8"
				LC_IDENTIFICATION="en_US.UTF-8"
				LC_ALL=
			');	

		if(!isset($this->lim))
			$this->lim = 'timeout';

		$log = shell_exec('./'.$this->lim.' -t '.$this->lim_time.' -m '.$this->lim_mem.' 2>&1 ./'.$this->exct.' < '.$this->in.' > '.$this->ans);

		$this->pushLog($log);

		if(strstr($log, 'FINISHED')) //'F' = 'finished', 'M' = 'over limited memory', 'T' = 'time out', 'E' = 'something is error'
		{
			$tmp = strstr($log, 'MAXMEM');
			
			$idx = 0;
			$this->use_mem = '';
			for($i = 7; $tmp[$i] != ' '; $i++)
			{
				$this->use_mem .= $tmp[$i];
			}

			$this->use_mem = intval($this->use_mem);
			$this->use_time = floatval(substr(strstr($log,'CPU'), 4, 4));

			return 'F';
		}
		else if(strstr($log, 'TIMEOUT'))
		{
			return 'T';
		}
		else if(substr($log, 0, 3)=='MEM')
		{
			return 'M';
		}

		return 'E';

	}

	public function check() {

		$file = fopen('input_file', 'w+');
		fwrite($file, $this->key.' ');
		fwrite($file, $this->ans);
		fclose($file);

		$log = shell_exec('./check.out < input_file 2>&1');

		$this->pushLog($log);

		if(substr($log, 0, 2) == '$#')
			return intval($log[2]); //'1' is correct answer, '0' is incorrect answer

		return -1; //something is error

	}		
}