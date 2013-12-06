<?php
/**
* File System Object Oriented Programming: Object File System
*
* @copyright ocean=Yohsuke
*/
class ObjectFileSystemConst {
	const CONSTRUCTMETHOD_NAME = 'construct';
	const MAINMETHOD_NAME = 'main';
	const BASECLASS_NAME = 'Base';
}
class ObjectFileSystemBase {
	protected $Global;
	protected function setGlobal($Global) {
		$this->Global = $Global;
	}
}
class ObjectFileSystemFile extends ObjectFileSystemBase {
	private $FileList;
	private $dirpath;
	private $namespace;
	function __call($objectname, $params) {
		if (! isset ( $this->FileList [$objectname] )) {
			throw new ObjectFileSystemException ( "Failed to call method '{$objectname}' on namespace '{$this->namespace}'." );
		}
		
		$return = call_user_func_array ( array (
				$this->FileList [$objectname],
				ObjectFileSystemConst::MAINMETHOD_NAME 
		), $params );
		if (isset ( $return )) {
			throw new ObjectFileSystemException ( "Returned something from '" . ObjectFileSystemConst::MAINMETHOD_NAME . "' method in '{$this->dirpath}/{$objectname}.php'." );
		}
		return $this->FileList [$objectname];
	}
	final function __ObjectFileSystemFile_construct($dirpath, $namespace, ObjectFileSystemGlobal $Global) {
		$this->setGlobal ( $Global );
		$this->dirpath = $dirpath;
		$this->namespace = $namespace;
	}
	final function __ObjectFileSystemFile_make($FileList = NULL) {
		if (! isset ( $FileList )) {
			$FileList = $this->__ObjectFileSystemFile_FileList ( $this->dirpath, $this->namespace );
		}
		$this->FileList = $FileList;
	}
	final protected function __ObjectFileSystemFile_File($objectname) {
		return $this->FileList [$objectname];
	}
	final protected function __ObjectFileSystemFile_FileList($dirpath, $namespace) {
		if (! file_exists ( $dirpath )) {
			return;
		}
		
		// base class
		$classpath = $dirpath . '/' . ObjectFileSystemConst::BASECLASS_NAME . '.php';
		if (file_exists ( $classpath )) {
			$classname = $this->to_classname ( $namespace, ObjectFileSystemConst::BASECLASS_NAME );
			include_once ($classpath);
			if ($this->Global->Config ()->assertion_flag () && ! class_exists ( $classname )) {
				throw new ObjectFileSystemException ( "Not defined class '{$classname}' in file '{$classpath}'." );
			}
		}
		
		$FileList = array ();
		foreach ( new DirectoryIterator ( $dirpath ) as $iterator ) {
			if ($iterator->isFile ()) {
				$pathinfo = pathinfo ( $iterator->getPathname () );
				if ($pathinfo ['extension'] !== 'php') {
					continue;
				}
				$filename = $iterator->getFilename ();
				$basename = basename ( $filename, '.php' );
				if ($basename === ObjectFileSystemConst::BASECLASS_NAME) {
					continue;
				}
				$classname = $this->to_classname ( $namespace, $basename );
				
				include_once ($iterator->getPathname ());
				if ($this->Global->Config ()->assertion_flag () && ! class_exists ( $classname )) {
					throw new ObjectFileSystemException ( "Not defined class '{$classname}' in file '{$iterator->getPathname()}'." );
				}
				if ($this->Global->Config ()->assertion_flag () && ! method_exists ( $classname, ObjectFileSystemConst::MAINMETHOD_NAME )) {
					throw new ObjectFileSystemException ( "Not defined method '" . ObjectFileSystemConst::MAINMETHOD_NAME . "()' in class '{$classname}' in file '{$iterator->getPathname()}'." );
				}
				$this->check_haveInheritedOFSFile ( $classname );
				
				$FileList [$basename] = $this->File ( $dirpath, $namespace, $basename, $classname );
			}
		}
		return $FileList;
	}
	/* where */
	private function to_classname($namespace, $name) {
		$classname = ($this->Global->Config ()->namespace_flag ()) ? '\\' . $namespace . '\\' . $name : $namespace . '_' . $name;
		return $classname;
	}
	private function check_haveInheritedOFSFile($classname) {
		$Refl = new ReflectionClass ( $classname );
		if (isset ( $Refl->getParentClass ()->name )) {
			if ($Refl->getParentClass ()->name == 'ObjectFileSystemFile') {
				return;
			} else {
				$this->check_haveInheritedOFSFile ( $Refl->getParentClass ()->name );
			}
		} else {
			throw new ObjectFileSystemException ( "Class '{$classname}' must have inherited 'ObjectFileSystemFile' as one of ancestors." );
		}
	}
	private function File($dirpath, $namespace, $basename, $classname) {
		$File = new $classname ();
		$new_dirpath = $dirpath . '/' . $basename;
		$new_namespace = ($this->Global->Config ()->namespace_flag ()) ? $namespace . '\\' . $basename : $namespace . '_' . $basename;
		$File->__ObjectFileSystemFile_construct ( $new_dirpath, $new_namespace, $this->Global );
		ObjectFileSystemUtil::shadowPublicProps ( $this, $File );
		if (method_exists ( $classname, ObjectFileSystemConst::CONSTRUCTMETHOD_NAME )) {
			$File->{ObjectFileSystemConst::CONSTRUCTMETHOD_NAME} ();
		}
		$File->__ObjectFileSystemFile_make ();
		return $File;
	}
}
class ObjectFileSystem extends ObjectFileSystemFile {
	private $rootDir;
	private $rootNamespace;
	private $cache;
	private $done_make = FALSE;
	function __construct($rootDir, $rootNamespace, $assertion = TRUE, $namespace = TRUE) {
		if ($assertion && $namespace && version_compare ( PHP_VERSION, '5.3.0', '<' )) {
			throw new ObjectFileSystemException ( "The Parameter namespace must be FALSE because the version of PHP is lower then 5.3.0." );
		}
		$rootDir = rtrim ( $rootDir, '/' );
		
		if ($assertion && ! file_exists ( $rootDir )) {
			throw new ObjectFileSystemException ( "Wrong root directory was specified: not exist directory at $rootDir." );
		}
		
		$this->rootDir = $rootDir;
		$this->rootNamespace = $rootNamespace;
		
		$this->Global = new ObjectFileSystemGlobal ();
		$this->Global->setConfig ( $assertion, $namespace );
		
		$this->__ObjectFileSystemFile_construct ( $rootDir, $rootNamespace, $this->Global );
	}
	function __call($objectname, $params) {
		if (! $this->done_make) {
			throw new ObjectFileSystemException ( "Must have done make() before __call() on $this->rootDir." );
		}
		return parent::__call ( $objectname, $params );
	}
	function make() {
		$this->done_make = True;
		
		if (isset ( $this->cache )) {
			if (! isset ( $this->cache ['classpathList'] ) || ! isset ( $this->cache ['FileList'] )) {
				throw new ObjectFileSystemException ( "Invalide cache." );
			}
			foreach ( $this->cache ['classpathList'] as $classpath ) {
				include_once $this->rootDir . '/' . $classpath;
			}
			$FileList = unserialize ( $this->cache ['FileList'] );
		} else {
			$FileList = NULL;
		}
		
		parent::__ObjectFileSystemFile_make ( $FileList );
	}
	function set_cache($cache) {
		if (! $this->done_make) {
			throw new ObjectFileSystemException ( "Must have done make() before set_cache() on $this->rootDir." );
		}
		if (! isset ( $cache ['classpathList'] ) || ! isset ( $cache ['FileList'] )) {
			throw new ObjectFileSystemException ( "Invalide cache." );
		}
		$this->cache = $cache;
	}
	function get_cache() {
		if (! $this->done_make) {
			throw new ObjectFileSystemException ( "Must have done make() before get_cache() on $this->rootDir." );
		}
		
		$classpathList = array ();
		$this->get_classpathList ( $this->rootDir, $classpathList );
		$cache ['classpathList'] = $classpathList;
		
		$FileList = parent::__ObjectFileSystemFile_FileList ( $this->rootDir, $this->rootNamespace );
		$cache ['FileList'] = serialize ( $FileList );
		
		return $cache;
	}
	/* where */
	private function get_classpathList($dirpath, &$classpathList) {
		// base class
		$classpath = $dirpath . '/' . ObjectFileSystemConst::BASECLASS_NAME . '.php';
		if (file_exists ( $classpath )) {
			$classpathList [] = preg_replace ( "#^{$this->rootDir}/#", '', $classpath );
		}
		
		foreach ( new DirectoryIterator ( $dirpath ) as $iterator ) {
			if ($iterator->isFile ()) {
				$pathinfo = pathinfo ( $iterator->getPathname () );
				if ($pathinfo ['extension'] !== 'php') {
					continue;
				}
				$basename = basename ( $iterator->getFilename (), '.php' );
				if ($basename === ObjectFileSystemConst::BASECLASS_NAME) {
					continue;
				}
				$classpath = $dirpath . '/' . $iterator->getFilename ();
				$classpathList [] = preg_replace ( "#^{$this->rootDir}/#", '', $classpath );
			}
		}
		foreach ( new DirectoryIterator ( $dirpath ) as $iterator ) {
			if ($iterator->isDir () && ! $iterator->isDot ()) {
				$dirname = $iterator->getFilename ();
				$new_dirpath = $dirpath . '/' . $dirname;
				$this->get_classpathList ( $new_dirpath, $classpathList );
			}
		}
	}
}
class ObjectFileSystemGlobal {
	private $Config;
	function setConfig($assertion, $namespace) {
		$this->Config = new ObjectFileSystemGlobalConfig ( $assertion, $namespace );
	}
	function Config() {
		return $this->Config;
	}
}
class ObjectFileSystemGlobalConfig {
	private $assertion_flag;
	private $namespace_flag;
	function __construct($assertion, $namespace) {
		$this->assertion_flag = $assertion;
		$this->namespace = $namespace;
	}
	function assertion_flag() {
		return $this->assertion_flag;
	}
	function namespace_flag() {
		return $this->namespace;
	}
}
class ObjectFileSystemUtil {
	static function shadowPublicProps($from, $to) {
		$RefObj = array (
				'from' => new ReflectionObject ( $from ),
				'to' => new ReflectionObject ( $to ) 
		);
		$props = $RefObj ['from']->getProperties ( ReflectionProperty::IS_PUBLIC );
		foreach ( $props as $prop ) {
			$prop_name = $prop->getName ();
			if ($RefObj ['to']->hasProperty ( $prop_name )) {
				$to_prop = $RefObj ['to']->getProperty ( $prop_name );
				if ($to_prop->isPublic ()) {
					$to_value = $to_prop->getValue ( $to );
					if (! isset ( $to_value )) {
						$isStaticProp = array (
								'to' => $to_prop->isStatic (),
								'from' => $prop->isStatic () 
						);
						if (! $isStaticProp ['to'] && ! $isStaticProp ['from']) {
							$from_value = $prop->getValue ( $from );
							if (is_object ( $from_value ) || is_resource ( $from_value )) {
								$to->{$prop_name} = $from->{$prop_name};
							} else {
								$to->{$prop_name} = & $from->{$prop_name};
							}
						}
						/*
						 * The version of PHP must be 5.3.0 or higher elseif ($isStaticProp['to'] && $isStaticProp['from']) { if (is_object($prop->getValue($from))) { $to::${$prop_name} = $from::${$prop_name}; } else { $to::${$prop_name} =& $from::${$prop_name}; } }
						 */
					}
				}
			}
		}
	}
}
class ObjectFileSystemException extends Exception {
	function getException() {
		if (isset ( $this->xdebug_message ) && $this->xdebug_message) {
			die ( '<table>' . $this->xdebug_message . '</table>' );
		} else {
			$message = '[ObjectFileSystem Error] ';
			$message .= $this->getMessage () . "<br />\n<br />\n";
			
			$TraceArray = explode ( "\n", $this->getTraceAsString () );
			foreach ( $TraceArray as $key => $value ) {
				if (! preg_match ( '/ObjectFileSystem/i', $value )) {
					$TraceArray [$key] = '<span style="color: blue;"><b>' . $TraceArray [$key] . '</b></span>';
				}
			}
			$TraceString = implode ( "<br />\n", $TraceArray );
			
			$message .= $TraceString . "<br />\n";
			
			die ( $message );
		}
	}
}