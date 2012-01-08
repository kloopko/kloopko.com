<?php defined('SYSPATH') or die('No direct script access.');

class File extends Kohana_File {
	
	/**
	 * Removes a file or array of files recursively
	 * 
	 * @param	mixed	path to file or array of paths
	 * @return	mixed	status or array of statuses, depending on input
	 */
	public static function delete($file)
	{
		// Remove arrays of files recursively
		if (is_array($file))
		{
			$result = array();
			
			foreach ($file as $key => $path)
			{
				$result[$key] = File::delete($path);
			}
			
			return $result;
		}
		
		try
		{
			$result = unlink($file);
		}
		catch (Exception $e)
		{
			// Fail gracefully but do log the error 
			$result = FALSE;
			
			if ( ! file_exists($file))
			{
				Kohana::$log->add(Log::ERROR, 'Nonexisting file: :file',
					array(':file' => $file));
			}
			else
			{
				Kohana::$log->add(Log::ERROR, 'Can`t remove :file (:error)',
					array(':file' => $file, ':error' => $e->getMessage()));
			}
		}
		
		return $result;
	}

}
