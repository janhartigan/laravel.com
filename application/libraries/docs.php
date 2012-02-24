<?php
/**
 * Docs library
 *
 * This is a simple helper for the documentation area.
 *
 * @license     http://www.opensource.org/licenses/mit MIT License
 * @copyright   Laravel
 * @author      Laravel Dev Team
 * @link        http://laravel.com/docs
 * @package     Laravel
 * @subpackage  Libraries
 * @filesource
 */
class Docs {

	/**
	 * Title
	 *
	 * Generate a title from the markdown file
	 *
	 * @param  string $content
	 * @return string
	 */
	public static function title($content)
	{
		if ($title = static::text_between_tag($content))
		{
			return $title[0];
		}
		return null;
	}

	/**
	 * Text Between Tag
	 *
	 * Parse a string and return the text inside an html tag
	 *
	 * @param  string $string
	 * @param  string $tag
	 * @return string
	 */
	protected static function text_between_tag($string, $tag = 'h1')
	{
		$pattern = "/<$tag>(.*?)<\/$tag>/";
		preg_match_all($pattern, $string, $matches);
		return $matches[1];
	}

	/**
	 * Content
	 *
	 * Load the content based on the section and page in the uri.
	 *
	 * @param  string $section
	 * @param  string $page
	 * @return string
	 */
	public static function content($section = null, $page = null)
	{
		if ( ! $section)
		{
			$markdown_file = 'docs/home';
		}
		else
		{
			$file = 'docs/'.$section.'/'.$page;
			$markdown_file = rtrim($file, '/');
		}

		if ($contents = Cache::get(str_replace('/', '_', $markdown_file)))
		{
			return $contents;
		}

		if ( ! is_file(path('storage').$markdown_file.'.md'))
		{
			// Check for a home file
			if (is_file(path('storage').$markdown_file.'/home.md'))
			{
				$markdown_file .= '/home';
			}
			else
			{
				return null;
			}
		}

		$contents = MarkdownExtended(File::get(path('storage').$markdown_file.'.md'));
		Cache::put(str_replace('/', '_', $markdown_file), $contents, 60);
		return $contents;
	}
}
