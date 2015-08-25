<?php
class EMarkdownParser extends CMarkdownParser {

	public function stripLinkDefinitions($text) {
	#
	# Strips link definitions from text, stores the URLs and titles in
	# hash references.
	#
		$less_than_tab = $this->tab_width - 1;

		# Link defs are in the form: ^[id]: url "optional title"
		$text = preg_replace_callback('{
							^[ ]{0,'.$less_than_tab.'}\[(.+)\][ ]?:	# id = $1
							  [ ]*
							  \n?				# maybe *one* newline
							  [ ]*
							<?(\S+?)>?			# url = $2
							  [ ]*
							  \n?				# maybe one newline
							  [ ]*
							(?:
								(?<=\s)			# lookbehind for whitespace
								["(]
								([^"(]*?)			# title = $3
								[")]
								[ ]*
							)?	# title is optional
							(?:
								(?<=\s)			# lookbehind for whitespace
								["(]
								(.*?)			# signature = $4
								[")]
								[ ]*
							)?	# signature is optional
							(?:\n+|\Z)
			}xm',
			array(&$this, '_stripLinkDefinitions_callback'),
			$text);
		return $text;
	}

	public function _stripLinkDefinitions_callback($matches) {
		$link_id = strtolower($matches[1]);
		$this->urls[$link_id] = $matches[2];
		$this->titles[$link_id] =& $matches[3];
		$this->signatures[$link_id] =& $matches[4];
		return ''; # String that will replace the block
	}
	
	public function doImages($text) {

	#
	# Turn Markdown image shortcuts into <img> tags.
	#
		#
		# First, handle reference-style labeled images: ![alt text][id]
		#
		$text = preg_replace_callback('{
			(				# wrap whole match in $1
			  !\[
				('.$this->nested_brackets_re.')		# alt text = $2
			  \]

			  [ ]?				# one optional space
			  (?:\n[ ]*)?		# one optional newline followed by spaces

			  \[
				(.*?)		# id = $3
			  \]

			)
			}xs',
			array(&$this, '_doImages_reference_callback'), $text);

		#
		# Next, handle inline images:  ![alt text](url "optional title")
		# Don't forget: encode * and _
		#
		$text = preg_replace_callback('{
			(				# wrap whole match in $1
			  !\[
				('.$this->nested_brackets_re.')		# alt text = $2
			  \]
			  \s?			# One optional whitespace character
			  \(			# literal paren
				[ ]*
				(?:
					<(\S*)>	# src url = $3
				|
					('.$this->nested_url_parenthesis_re.')	# src url = $4
				)
				[ ]*
				(			# $5
				  ([\'"])	# quote char = $6
				  ([^\6]*?)		# title = $7
				  \6		# matching quote
				  [ ]*
				  ([\'"])	# quote char = $8
				  ([^\8]*?)		# signature = $9
				  \8		# matching quote
				)?			# title is optional
			  \)
			)
			}xs',
			array(&$this, '_doImages_inline_callback'), $text);

		return $text;
	}

	public function _doImages_reference_callback($matches) {
		$whole_match = $matches[1];
		$alt_text    = $matches[2];
		$link_id     = strtolower($matches[3]);

		if ($link_id == "") {
			$link_id = strtolower($alt_text); # for shortcut links like ![this][].
		}

		$alt_text = $this->encodeAttribute($alt_text);
		if (isset($this->urls[$link_id])) {
			$url = $this->encodeAttribute($this->urls[$link_id]);
			$result = "<img src=\"$url\" alt=\"$alt_text\"";
			if (isset($this->titles[$link_id])) {
				$title = $this->titles[$link_id];
				$title = $this->encodeAttribute($title);
				$result .=  " title=\"$title\"";
			}
			$result .= $this->empty_element_suffix;
			if (isset($this->signatures[$link_id])){
				$signature_text = $this->signatures[$link_id];
				if(!empty($signature_text))
					$result .= "<span class='signature'>$signature_text</span>";
			}
			$result = $this->hashPart($result);
		}
		else {
			# If there's no such link ID, leave intact:
			$result = $whole_match;
		}

		return $result;
	}

	public function _doImages_inline_callback($matches) {
		$whole_match	= $matches[1];
		$alt_text		= $matches[2];
		$url			= $matches[3] == '' ? $matches[4] : $matches[3];
		$title			=& $matches[7];
		$signature_text =& $matches[9];

		$alt_text = $this->encodeAttribute($alt_text);
		$url = $this->encodeAttribute($url);
		$result = "<img src=\"$url\" alt=\"$alt_text\"";
		if (isset($title)) {
			$title = $this->encodeAttribute($title);
			$result .=  " title=\"$title\""; # $title already quoted
		}
		$result .= $this->empty_element_suffix;
		if(!empty($signature_text))
			$result .= "<span class='signature'>$signature_text</span>";

		return $this->hashPart($result);
	}
}
?>