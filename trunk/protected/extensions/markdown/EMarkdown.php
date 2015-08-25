<?php
class EMarkdown extends CMarkdown {

	private $_parser;
	var $purifyOutput = false;
	
	/**
	 * Returns the markdown parser instance.
	 * This method calls {@link createMarkdownParser} to create the parser instance.
	 * Call this method multipe times will only return the same instance.
	 * @param CMarkdownParser the parser instance
	 * @since 1.0.1
	 */
	public function getMarkdownParser()
	{
		if($this->_parser===null)
			$this->_parser=$this->createMarkdownParser();
		return $this->_parser;
	}

	/**
	 * Creates a markdown parser.
	 * By default, this method creates a {@link CMarkdownParser} instance.
	 * @return CMarkdownParser the markdown parser.
	 */
	protected function createMarkdownParser()
	{
		return new EMarkdownParser;
	}
}
?>