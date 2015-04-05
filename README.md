INTRODUCTION
============

Supreme Library is a library that contains essential functions for C/C++ online judge to compile C/C++ code and checking its result with the correct answer. It is depend on PHP, Apache, G++ and Perl. And all are work under ‘Linux’.

INSTALLATION
============

This library include 3 main files
- `SupremeLibrary.php` => This is a library that contain functions depend on PHP and Apache.
- `check_general.cpp` => This is a checking script. Its function is compare result of your code and correct answer that you have prepared. And it depend on G++ to compile.
- `timeout` => The timeout script is a resource monitoring program for limiting time and memory consumption of black-boxed processes under Linux. You will need latest version of Perl (recommend Perl 5) to run the script. In the library, we call it that 'Limiter'. Thank Pavel Shved for `timeout` script (url: https://github.com/pshved/timeout).
So you have to install PHP, Apache, G++ and Perl in your Linux.

USAGE
=====

#####1. Include the library file and decare variable of this library class on your php script.

    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    ?>

#####2. Prepare important data before call the function in the library.

    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    	
    //the code you want to check it.
    $myJudge->code = 'path/to/your/code.cpp';
    
    //compiled file from code.php
    $myJudge->exct = 'path/to/your/a.out'; 
    
    //input from testdata
    $myJudge->in = 'path/to/your/input.in'; 
    
    //output from user's excuted file [generate by the library]
    $myJudge->ans = 'path/to/your/ans.sol'; 
    
    //correct output from testdata
    $myJudge->key = 'path/to/your/key.sol'; 
    
    //checking code for compare key.sol and ans.sol
    $myJudge->chk = 'path/to/your/check_general.cpp';
    
    //Limiter file (optional: default = 'timeout')
    $myJudge->lim = 'path/to/your/timeout';
    
    //limiting memory (KB)
    $myJudge->lim_mem = 123456;
    
    //limiting time (second)
    $myJudge->lim_time = 1;
    ?>

#####3. Compile your code and checking code.

    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    $myJudge->code = 'path/to/your/code.cpp';
    $myJudge->exct = 'path/to/your/a.out'; 
    $myJudge->in = 'path/to/your/input.in'; 
    $myJudge->ans = 'path/to/your/ans.sol'; 
    $myJudge->key = 'path/to/your/key.sol'; 
    $myJudge->chk = 'path/to/your/check_general.cpp';
    $myJudge->lim = 'path/to/your/timeout';
    $myJudge->lim_mem = 123456;
    $myJudge->lim_time = 1;
    
    //compile codes
    $myJudge->compile();
    ?>

`true` will be returned, if compilation was succeed.You may call `$myJudge->cmp_msg` to see the compile message after call the `compile()` function.

#####4. Execute your compiled file with input file and get time and memory usage if they lower than limited.

    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    $myJudge->code = 'path/to/your/code.cpp';
    $myJudge->exct = 'path/to/your/a.out'; 
    $myJudge->in = 'path/to/your/input.in'; 
    $myJudge->ans = 'path/to/your/ans.sol'; 
    $myJudge->key = 'path/to/your/key.sol'; 
    $myJudge->chk = 'path/to/your/check_general.cpp';
    $myJudge->lim = 'path/to/your/timeout';
    $myJudge->lim_mem = 123456;
    $myJudge->lim_time = 1;
    
    if($myJudge->compile())
    {
    	//Execute and get info
    	$myJudge->execute();
    }
    ?>

`$myJudge->use_time` and `$myJudge->use_mem` will tell you time (second) and memory (KB) usage. After you call the `execute()` function. And function will return
- `F` if execute process is finished.
- `T` if time use is over limiting time.
- `M` if memory usage is over limiting memory.
- `E` if something is error.

#####5: Check the result form excuted file and correct result.

    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    $myJudge->code = 'path/to/your/code.cpp';
    $myJudge->exct = 'path/to/your/a.out'; 
    $myJudge->in = 'path/to/your/input.in'; 
    $myJudge->ans = 'path/to/your/ans.sol'; 
    $myJudge->key = 'path/to/your/key.sol'; 
    $myJudge->chk = 'path/to/your/check_general.cpp';
    $myJudge->lim = 'path/to/your/timeout';
    $myJudge->lim_mem = 123456;
    $myJudge->lim_time = 1;
    
    if($myJudge->compile())
    {
    	if($myJudge->execute() == 'F')
    	{
    		//Compare result and correct result
    		echo 'result = '.$myJudge->check().'<br/>';
    	}
    }
    ?>

The `check()` function will return
- `1` if the result from your code is correct.
- `0` if the result from your code is wrong.
- `-1` if something is error.

#####OPTIONAL: If you need to check more that one testcase. No need to do every steps (1 - 5) again. Just change `$myJudge->in` and `$myJudge->key` (if you want to keep the result from code change `$myJudge->ans`) then do the step 4 and 5 again. Because step 3 has slowly functions and no need to do again.
    
    <?php
    include('path/to/your/SupremeLibrary.php');
    $myJudge = new SupremeClass;
    $myJudge->code = 'path/to/your/code.cpp';
    $myJudge->exct = 'path/to/your/a.out'; 
    $myJudge->ans = 'path/to/your/ans.sol'; 
    $myJudge->chk = 'path/to/your/check_general.cpp';
    $myJudge->lim = 'path/to/your/timeout';
    $myJudge->lim_mem = 123456;
    $myJudge->lim_time = 1;
    
    if($myJudge->compile())
    {
    	for($i = 1; $i <= 10; $i++)
    	{
    
    		$myJudge->in = 'path/to/your/'.$i.'.in'; 
    		$myJudge->key = 'path/to/your/'.$i.'.sol'; 
    
    		if($myJudge->execute() == 'F')
    		{
    			echo 'result #'.$i.' = '.$myJudge->check().'<br/>';
    		}
    	}
    }
    ?>

You may call `$this->log` to see all law output from library and `$this->lst_log` to see latest output from library.

`Supreme Library v1.0 by PanTA`
