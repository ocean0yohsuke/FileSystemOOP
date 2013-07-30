<?php
/**
 * File System Object Oriented Programming: Method File System
 *
 * @copyright ocean=Yohsuke
 */

class MethodFileSystemConst
{
	const CURRENT_DIR_SYMBOL = '.';
	const MAINMETHOD_NAME 	= 'main';
	const BASECLASS_NAME		= 'base';
}

class MethodFileSystemFile
{
	private $Dir;
	
	function __construct(MethodFileSystem $Source)
	{
		MethodFileSystemUtil::shadowPublicProps($Source, $this);
	}
	
	final function __MethodFileSystemFile_construct(MethodFileSystemDir $Dir) 
	{
		$this->Dir = $Dir;
	}

	/**
	 * @param string $dirname
	 */
	function __invoke($dirname = NULL)
	{
		if (!isset($this->Dir)) {
			throw new MethodFileSystemException("Have not been done make() yet.");
		}

		if (!isset($dirname)) {
			$dirname = MethodFileSystemConst::CURRENT_DIR_SYMBOL;
		}
		return $this->Dir->__MethodFileSystemDir_Dir($dirname);
	}
}
class MethodFileSystem extends MethodFileSystemFile
{
	private $rootDir;
	private $rootNamespace;
	private $cache;
	private $done_make = FALSE;
	
	function __construct($rootDir, $rootNamespace, 
	                     $assertion=TRUE, $namespace=TRUE)
	{
		if ($assertion && $namespace && version_compare(PHP_VERSION, '5.3.0', '<')) {
			throw new MethodFileSystemException("The Parameter namespace must be FALSE because the version of PHP is lower then 5.3.0.");
		}
		$rootDir = rtrim($rootDir, '/');

		if ($assertion && !file_exists($rootDir)) {
			throw new MethodFileSystemException("Wrong root directory was specified: not exist directory at $rootDir.");
		}
		
		$this->rootDir = $rootDir;
		$this->rootNamespace = $rootNamespace;
		
		$this->Global = new MethodFileSystemGlobal();
		$this->Global->setConfig($assertion, $namespace);
	}
	
	function make()
	{
		$this->done_make = TRUE;
		
		if (isset($this->cache))	{
			if (!isset($this->cache['classpathList']) || !isset($this->cache['Dir'])) {
				throw new MethodFileSystemException("Invalide cache.");
			}
			foreach($this->cache['classpathList'] as $classpath)
			{
				include_once $this->rootDir . '/' . $classpath;
			}
			$Dir = unserialize($this->cache['Dir']);
		} else	{
			$Dir = new MethodFileSystemDir($this->rootDir, $this->rootNamespace, $this, $this->Global);
		}
		$this->__MethodFileSystemFile_construct($Dir);
	}
	
	function __invoke($dirname = NULL)
	{
		if (!$this->done_make) {
			throw new MethodFileSystemException("Have not done make() yet.");
		}
		return parent::__invoke($dirname);
	}
	
	function set_cache($cache)
	{
		if (!$this->done_make) {
			throw new MethodFileSystemException("Have not done make() yet.");
		}
		if (!isset($cache['classpathList']) || !isset($cache['Dir'])) {
			throw new MethodFileSystemException("Invalide cache.");
		}
		$this->cache = $cache;
	}
	function get_cache()
	{
		if (!$this->done_make) {
			throw new MethodFileSystemException("Have not done make() yet.");
		}
		
		$classpathList = array();
		$this->get_classpathList($this->rootDir, $classpathList);
		$cache['classpathList'] = $classpathList;
		
		$Dir = new MethodFileSystemDir($this->rootDir, $this->rootNamespace, $this, $this->Global);
		$cache['Dir'] = serialize($Dir);
		
		return $cache;
	}
	private function get_classpathList($dirpath, &$classpathList)
	{
		// base class
		$classpath = $dirpath . '/' . MethodFileSystemConst::BASECLASS_NAME . '.php';
		if (file_exists($classpath)) {
			$classpathList[] = preg_replace("#^{$this->rootDir}/#", '', $classpath);
		}

		foreach( new DirectoryIterator($dirpath) as $iterator )
		{
			if ($iterator->isFile())
			{
				$pathinfo = pathinfo($iterator->getPathname());
				if ($pathinfo['extension'] !== 'php')	{
					continue;
				}
				$basename = basename($iterator->getFilename(), '.php');
				if ($basename === MethodFileSystemConst::BASECLASS_NAME) {
					continue;
				}
				$classpath = $dirpath . '/' . $iterator->getFilename();
				$classpathList[] = preg_replace("#^{$this->rootDir}/#", '', $classpath);
			}
			elseif ($iterator->isDir() && !$iterator->isDot())
			{
				$dirname = $iterator->getFilename();
				$new_dirpath = $dirpath . '/' . $dirname;
				$this->get_classpathList($new_dirpath, $classpathList);
			}
		}		
	}
}

class MethodFileSystemBase
{
	protected $Global;
	protected function setGlobal($Global)
	{
		$this->Global = $Global;
	}
}
class MethodFileSystemDir extends MethodFileSystemBase
{
	private $DirList = array();
	private $FileList = array();
	private $Source;

	function __construct($dirpath, $namespace, 
	                     MethodFileSystem $Source,
	                     MethodFileSystemGlobal $Global)
	{
		$this->setGlobal($Global);
		$this->Source = $Source;
		$this->setLists($dirpath, $namespace);
	}

	final function __call($methodname, $params)
	{
		$return = call_user_func_array(array($this->File($methodname), MethodFileSystemConst::MAINMETHOD_NAME),
		                               $params);
		if (isset($return)) {
			return $return;
		}
	}

	function __MethodFileSystemDir_Dir($dirname)
	{
		if (!isset($this->DirList[$dirname]))	{
			throw new MethodFileSystemException("Failed to invoke '{$dirname}': wrong name '{$dirname}' was specified.");
		}
		return $this->DirList[$dirname];
	}
	private function File($filename)
	{
		if (!isset($this->FileList[$filename]))	{
			throw new MethodFileSystemException("Failed to call method '{$filename}': wrong name '{$filename}' was specified.");
		}
		return $this->FileList[$filename];
	}

	private function setLists($dirpath, $namespace)
	{
		$this->DirList['.'] = $this;
		
		// base class
		$classpath = $dirpath . '/' . MethodFileSystemConst::BASECLASS_NAME . '.php';
		if (file_exists($classpath))
		{
			$classname = $this->to_classname($namespace, MethodFileSystemConst::BASECLASS_NAME);
			include_once($classpath);
			if ($this->Global->Config()->assertion() && !class_exists($classname)) {
				throw new MethodFileSystemException("Not defined class '{$classname}' in file '{$classpath}'.");
			}
		}
		
		foreach( new DirectoryIterator($dirpath) as $iterator )
		{
			if ($iterator->isFile())
			{
				$pathinfo = pathinfo($iterator->getPathname());
				if ($pathinfo['extension'] !== 'php')	{
					continue;
				}
				$basename = basename($iterator->getFilename(), '.php');
				if ($basename === MethodFileSystemConst::BASECLASS_NAME) {
					continue;
				}
				$classname = $this->to_classname($namespace, $basename);

				include_once($iterator->getPathname());
				if ($this->Global->Config()->assertion() && !class_exists($classname)) {
					throw new MethodFileSystemException("Not defined class '{$classname}' in file '{$iterator->getPathname()}'.");
				}
				if ($this->Global->Config()->assertion() && !method_exists($classname, MethodFileSystemConst::MAINMETHOD_NAME)) {
					throw new MethodFileSystemException("Not defined method '" . MethodFileSystemConst::MAINMETHOD_NAME . "()' in class '{$classname}' in file '{$iterator->getPathname()}'.");
				}
				$this->haveInheritedMFSFile($classname);
								
				$this->FileList[$basename] = new $classname($this->Source);
				$this->FileList[$basename]->__MethodFileSystemFile_construct($this);
			}
		}
		foreach( new DirectoryIterator($dirpath) as $iterator )
		{
			if ($iterator->isDir() && !$iterator->isDot())
			{
				$dirname = $iterator->getFilename();
				$new_dirpath = $dirpath . '/' . $dirname;
				$new_namespace = ($this->Global->Config()->namespace_()) ? 
					$namespace . '\\' . $dirname :
					$namespace . '_' . $dirname;
				$this->DirList[$dirname] = new MethodFileSystemDir($new_dirpath, $new_namespace, $this->Source, $this->Global);
			}
		}
	}
		/* where */ 
		private function to_classname($namespace, $filename)
		{
			$classname = ($this->Global->Config()->namespace_()) ?
				'\\' . $namespace . '\\' . $filename :
				$namespace . '_' . $filename;
			return $classname;
		}
		private function haveInheritedMFSFile($classname)
		{
			$Refl = new ReflectionClass($classname);
			if (isset($Refl->getParentClass()->name)) {
				if ($Refl->getParentClass()->name == 'MethodFileSystemFile') {
					return;
				} else {
					$this->haveInheritedMFSFile($Refl->getParentClass()->name);
				}
			} else {					
				throw new MethodFileSystemException("Class '{$classname}' must have inherited 'MethodFileSystemFile' as one of ancestors.");
			}
		}
}

class MethodFileSystemGlobal
{
	private $Config;

	function setConfig($assertion, $namespace)
	{
		$this->Config = new MethodFileSystemGlobalConfig($assertion, $namespace);
	}
	function Config()
	{
		return $this->Config;
	}
}

class MethodFileSystemGlobalConfig
{
	private $assertion;
	private $namespace;

	function __construct($assertion, $namespace)
	{
		$this->assertion = $assertion;
		$this->namespace = $namespace;
	}
	function assertion()
	{
		return $this->assertion;
	}
	function namespace_()
	{
		return $this->namespace;
	}
}

class MethodFileSystemUtil
{
	static function shadowPublicProps($from, $to)
	{
		$RefObj = array(
			'from'	=> new ReflectionObject($from),
			'to' 	=> new ReflectionObject($to),
		);
		$props = $RefObj['from']->getProperties(ReflectionProperty::IS_PUBLIC);
		foreach($props as $prop)
		{
			$prop_name = $prop->getName();
			if ($RefObj['to']->hasProperty($prop_name))
			{
				$to_prop = $RefObj['to']->getProperty($prop_name);
				if ($to_prop->isPublic())
				{
					$to_value = $to_prop->getValue($to);
					if (!isset($to_value))
					{
						$isStaticProp = array(
						'to' 	=> $to_prop->isStatic(),
						'from'	=> $prop->isStatic(),
						);
						if (!$isStaticProp['to'] && !$isStaticProp['from'])
						{
							$from_value = $prop->getValue($from);
							if (is_object($from_value) || is_resource($from_value)) {
								$to->{$prop_name} = $from->{$prop_name};
							} else {
								$to->{$prop_name} =& $from->{$prop_name};
							}
						}
						/* The version of PHP must be 5.3.0 or higher 
						elseif ($isStaticProp['to'] && $isStaticProp['from'])
						{
							if (is_object($prop->getValue($from))) {
								$to::${$prop_name} = $from::${$prop_name};
							} else {
								$to::${$prop_name} =& $from::${$prop_name};
							}
						}
						*/
					}
				}
			}
		}
	}
}

class MethodFileSystemException extends Exception
{
	function getException()
	{
		if (isset($this->xdebug_message) && $this->xdebug_message)
		{
			die('<table>' . $this->xdebug_message . '</table>');
		}
		else
		{
			$message = '[MethodFileSystem Error] ';
			$message .= $this->getMessage() . "<br />\n<br />\n";

			$TraceArray = explode("\n", $this->getTraceAsString());
			foreach($TraceArray as $key => $value)
			{
				if (!preg_match('/^#[0-9]+ .*\\MethodFileSystem\.php\([0-9]+\): /i', $value))
				{
					$TraceArray[$key] = '<span style="color: blue;"><b>' . $TraceArray[$key] . '</b></span>';
				}
			}
			$TraceString = implode("<br />\n", $TraceArray);

			$message .= $TraceString . "<br />\n";

			die($message);
		}
	}
}
