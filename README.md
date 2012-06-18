Frend - a front end editor for static websites
==============================================
Frend is a front end editor for static website that uses the new contenteditable attribute to turn your browser into a full rich text editor.

Demo: [http://frend.bgrout.co.uk](http://frend.bgrout.co.uk)

Features
--------
*	Rich content editing in the front end - what you see is what you actually get
*	Backup everytime you save


System Requirements
-------------------
*	PHP 5.3+
*	jQuery 1.7.2+

Installation
------------
*	Put the frend directory within the web root of your static website or just above and create a symlink, it's up to you.
*	Create a config.php file in the root of frend with the md5 hash of your password. (I know this isn't the most secure way to store a password but frankly, if someone can read the source of your PHP files you've got bigger problems).
*	Include frend.js in your html 
	*		`<script type="text/javascript" src="/frend/frend.js"></script>`
*	Also make sure jQuery is included 
	*		`<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>`
*	Add `class="editable"` to an element to make its child elements editable


License
-------
Copyright (C) 2012 Ben Grout

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
