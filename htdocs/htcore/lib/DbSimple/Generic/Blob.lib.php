<?
/**
 * Database BLOB.
 * Can read blob chunk by chunk, write data to BLOB.
 */
class DbSimple_Generic_Blob extends DbSimple_Generic_LastError
{
    /**
     * string read(int $length)
     * Returns following $length bytes from the blob.
     */
    function read($len)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * string write($data)
     * Appends data to blob.
     */
    function write($data)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * int length()
     * Returns length of the blob.
     */
    function length()
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * blobid close()
     * Closes the blob. Return its ID. No other way to obtain this ID!
     */
    function close()
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
}
?>