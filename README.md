# Usage

php php-class-splitter.php FILE DEST 

Splits a file containing multiple PHP classes up into multiple files with 
one class per file. Overwrites any existing files in the destination path 
with the same name, useful for handling redundant class definitions 
across multiple files. Requires the tokenizer extension.

* FILE - path to a single PHP file containing multiple class definitions 
* DEST - path to a directory to contain the new class files

# License

[MIT License](http://opensource.org/licenses/MIT)
